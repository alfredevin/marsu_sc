<?php
namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\Validator;
use Core\View;
use Core\Logger;

class AuthController {
    public function showLogin(): void {
        if (Auth::check()) {
            redirect(url('dashboard'));
        }
        View::render('auth/login', [
            'title' => 'Sign In'
        ], 'auth');
    }

    public function login(): void {
        $validator = Validator::make($_POST, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Session::setOldInput($_POST);
            Session::flash('error', $validator->firstError());
            redirect(url('login'));
        }

        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']);

        if (Auth::attempt($username, $password, $remember)) {
            Session::flash('success', 'Welcome back, ' . (Auth::user()['first_name'] ?? 'User') . '!');
            redirect(url('dashboard'));
        } else {
            Session::setOldInput($_POST);
            if (!Session::hasFlash('error')) {
                Session::flash('error', 'Invalid username/email or password.');
            }
            redirect(url('login'));
        }
    }

    public function logout(): void {
        Auth::logout();
        Session::flash('success', 'You have been safely signed out.');
        redirect(url('login'));
    }

    public function showForgotPassword(): void {
        View::render('auth/forgot-password', [
            'title' => 'Forgot Password'
        ], 'auth');
    }

    public function sendResetLink(): void {
        $validator = Validator::make($_POST, ['email' => 'required|email']);
        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('forgot-password'));
        }

        $email = trim($_POST['email']);
        $user = Database::fetchOne("SELECT id FROM users WHERE email = :email AND deleted_at IS NULL", ['email' => $email]);
        
        if ($user) {
            $token = bin2hex(random_bytes(32));
            Database::insert('password_resets', [
                'email'      => $email,
                'token'      => $token,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            // For local demonstration / offline XAMPP, provide the reset link in flash message
            $resetUrl = url('reset-password', ['token' => $token, 'email' => $email]);
            Session::flash('success', "Password reset simulated. <a href='{$resetUrl}' class='alert-link fw-bold'>Click here to reset your password</a>.");
        } else {
            Session::flash('info', 'If that email exists in our records, a reset link has been dispatched.');
        }

        redirect(url('forgot-password'));
    }

    public function showResetPassword(): void {
        $token = $_GET['token'] ?? '';
        $email = $_GET['email'] ?? '';

        View::render('auth/reset-password', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => $email
        ], 'auth');
    }

    public function resetPassword(): void {
        $validator = Validator::make($_POST, [
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('reset-password', ['token' => $_POST['token'] ?? '', 'email' => $_POST['email'] ?? '']));
        }

        $token = $_POST['token'];
        $email = $_POST['email'];
        $newPass = $_POST['password'];

        $record = Database::fetchOne(
            "SELECT * FROM password_resets WHERE email = :email AND token = :token ORDER BY created_at DESC LIMIT 1",
            ['email' => $email, 'token' => $token]
        );

        if (!$record) {
            Session::flash('error', 'Invalid or expired password reset token.');
            redirect(url('forgot-password'));
        }

        // Update password
        $hashed = password_hash($newPass, PASSWORD_BCRYPT, ['cost' => 12]);
        Database::update('users', ['password' => $hashed, 'updated_at' => date('Y-m-d H:i:s')], 'email = :email', ['email' => $email]);
        Database::delete('password_resets', 'email = :email', ['email' => $email]);

        Logger::audit('auth.password_reset', 'users', null, ['email' => $email]);
        Session::flash('success', 'Your password has been successfully updated. You may now sign in.');
        redirect(url('login'));
    }

    public function profile(): void {
        $user = Auth::user();
        View::render('auth/profile', [
            'title'  => 'My Profile',
            'user'   => $user,
            'crumbs' => ['Account Profile' => '']
        ]);
    }

    public function updateProfile(): void {
        $user = Auth::user();
        $validator = Validator::make($_POST, [
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'email'      => 'required|email'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('profile'));
        }

        Database::update('users', [
            'first_name' => trim($_POST['first_name']),
            'last_name'  => trim($_POST['last_name']),
            'email'      => trim($_POST['email']),
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $user['id']]);

        Logger::audit('profile.update', 'users', $user['id'], ['email' => trim($_POST['email'])]);
        Session::flash('success', 'Your profile details have been saved.');
        redirect(url('profile'));
    }

    public function changePassword(): void {
        $user = Auth::user();
        $validator = Validator::make($_POST, [
            'current_password'      => 'required',
            'new_password'          => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('profile'));
        }

        // Verify current password
        $dbUser = Database::fetchOne("SELECT password FROM users WHERE id = :id", ['id' => $user['id']]);
        if (!password_verify($_POST['current_password'], $dbUser['password'])) {
            Session::flash('error', 'Your current password is incorrect.');
            redirect(url('profile'));
        }

        $hashed = password_hash($_POST['new_password'], PASSWORD_BCRYPT, ['cost' => 12]);
        Database::update('users', ['password' => $hashed, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $user['id']]);

        Logger::audit('profile.password_change', 'users', $user['id'], []);
        Session::flash('success', 'Your password has been changed successfully.');
        redirect(url('profile'));
    }
}
