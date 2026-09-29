<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\Section;
use App\Models\Program;

class AcademicController {
    public function index(): void {
        $academicYears = AcademicYear::all();
        $semesters = Semester::all();
        $sections = Section::all();
        $programs = Program::all();

        View::render('academics/index', [
            'title'         => 'Academic Calendar & Sections',
            'academicYears' => $academicYears,
            'semesters'     => $semesters,
            'sections'      => $sections,
            'programs'      => $programs,
            'crumbs'        => ['Master Data' => '', 'Academic Calendar' => '']
        ]);
    }

    public function storeYear(): void {
        $validator = Validator::make($_POST, [
            'code'       => 'required|max:32|unique:academic_years,code',
            'label'      => 'required|max:64',
            'start_date' => 'required|date',
            'end_date'   => 'required|date'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('academics'));
        }

        $id = AcademicYear::create([
            'code'       => trim($_POST['code']),
            'label'      => trim($_POST['label']),
            'start_date' => $_POST['start_date'],
            'end_date'   => $_POST['end_date'],
            'is_active'  => 0
        ]);

        Logger::audit('academic_year.create', 'academic_years', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Academic Year '{$_POST['label']}' added.");
        redirect(url('academics'));
    }

    public function activateYear(): void {
        $id = (int)($_POST['id'] ?? 0);
        AcademicYear::setActive($id);
        Logger::audit('academic_year.activate', 'academic_years', $id, []);
        Session::flash('success', "Active academic year updated.");
        redirect(url('academics'));
    }

    public function activateSemester(): void {
        $id = (int)($_POST['id'] ?? 0);
        Semester::setActive($id);
        Logger::audit('semester.activate', 'semesters', $id, []);
        Session::flash('success', "Active semester updated.");
        redirect(url('academics'));
    }

    public function storeSection(): void {
        $validator = Validator::make($_POST, [
            'name'             => 'required|max:64',
            'program_id'       => 'required|integer',
            'academic_year_id' => 'required|integer',
            'year_level'       => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('academics'));
        }

        $id = Section::create([
            'name'             => trim($_POST['name']),
            'program_id'       => (int)$_POST['program_id'],
            'academic_year_id' => (int)$_POST['academic_year_id'],
            'year_level'       => (int)$_POST['year_level']
        ]);

        Logger::audit('section.create', 'sections', $id, ['name' => $_POST['name']]);
        Session::flash('success', "Section '{$_POST['name']}' created.");
        redirect(url('academics'));
    }

    public function deleteSection(): void {
        $id = (int)($_POST['id'] ?? 0);
        Section::softDelete($id);
        Logger::audit('section.delete', 'sections', $id, []);
        Session::flash('success', "Section archived.");
        redirect(url('academics'));
    }
}
