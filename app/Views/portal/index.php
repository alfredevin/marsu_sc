<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Official MarSU Student Portal - University Online Services, Clearance, Medical Clinic, and Student Welfare">
    <meta name="author" content="Marinduque State University - College of Information and Computing Sciences">

    <title><?= e($title ?? 'MarSU Student Portal | Official University Services') ?></title>

    <!-- MarSU Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('assets/img/marsu-sm.png') ?>">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit (Zero Browser Default Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Offline Vendor Stylesheets -->
    <link href="<?= asset('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= asset('assets/vendor/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

    <style>
        /* ==========================================================================
           MARSU PUBLIC STUDENT PORTAL DESIGN SYSTEM & PALETTE TOKENS
           ========================================================================== */
        :root {
            --marsu-burgundy: #800020;
            --marsu-burgundy-dark: #4f0013;
            --marsu-burgundy-light: #a31238;
            --marsu-gold: #d4af37;
            --marsu-gold-hover: #f1c40f;
            --marsu-gold-glow: rgba(212, 175, 55, 0.35);
            --portal-bg: #0b0e14;
            --portal-surface: #121722;
            --portal-card: #182030;
            --portal-card-hover: #1f293d;
            --portal-border: rgba(255, 255, 255, 0.08);
            --portal-border-gold: rgba(212, 175, 55, 0.35);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            background-color: var(--portal-bg);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .brand-font, .portal-heading {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }

        /* Ambient Glow & University Atmosphere */
        .ambient-glow-top {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 1200px;
            height: 380px;
            background: radial-gradient(ellipse at top, rgba(128, 0, 32, 0.35) 0%, rgba(212, 175, 55, 0.08) 45%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Public Navigation Header */
        .portal-navbar {
            background: rgba(14, 18, 27, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--portal-border);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: all 0.25s ease;
        }

        .portal-brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid var(--marsu-gold);
            padding: 2px;
            background: #ffffff;
            object-fit: contain;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.25);
            transition: transform 0.25s ease;
        }

        .portal-brand:hover .portal-brand-logo {
            transform: scale(1.06) rotate(3deg);
        }

        .portal-brand-text {
            line-height: 1.15;
        }

        .portal-brand-title {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: -0.2px;
            color: #ffffff;
            margin: 0;
        }

        .portal-brand-subtitle {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--marsu-gold);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .nav-link-portal {
            color: #cbd5e1;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link-portal:hover, .nav-link-portal.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link-portal.active {
            color: var(--marsu-gold);
            background: rgba(212, 175, 55, 0.1);
        }

        .btn-portal-burgundy {
            background: linear-gradient(135deg, var(--marsu-burgundy) 0%, var(--marsu-burgundy-dark) 100%);
            border: 1px solid rgba(212, 175, 55, 0.4);
            color: #ffffff;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            font-size: 0.84rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(128, 0, 32, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-portal-burgundy:hover {
            color: #ffffff;
            background: linear-gradient(135deg, var(--marsu-burgundy-light) 0%, var(--marsu-burgundy) 100%);
            border-color: var(--marsu-gold);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 0, 32, 0.45);
        }

        .btn-portal-gold {
            background: linear-gradient(135deg, #d4af37 0%, #b89728 100%);
            color: #1a080c;
            border: none;
            font-weight: 700;
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            font-size: 0.84rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-portal-gold:hover {
            background: linear-gradient(135deg, #f1c40f 0%, #d4af37 100%);
            color: #0b0204;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        /* Hero Banner */
        .portal-hero {
            position: relative;
            z-index: 1;
            padding: 2.5rem 0 1.5rem;
        }

        .hero-student-card {
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.85) 0%, rgba(24, 32, 48, 0.95) 100%);
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: 24px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5), 0 0 30px rgba(128, 0, 32, 0.2);
        }

        .hero-student-card::before {
            content: '';
            position: absolute;
            right: -30px;
            bottom: -30px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        .student-avatar-ring {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid var(--marsu-gold);
            padding: 3px;
            background: #182030;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .student-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .status-dot-active {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            background: #10b981;
            border: 2px solid #182030;
            border-radius: 50%;
        }

        /* Real-time Search Box */
        .portal-search-wrap {
            position: relative;
            margin-top: 1.25rem;
        }

        .portal-search-input {
            width: 100%;
            background: rgba(14, 18, 27, 0.85);
            border: 1px solid var(--portal-border-gold);
            border-radius: 50px;
            padding: 0.85rem 1.5rem 0.85rem 3rem;
            color: #ffffff;
            font-size: 0.92rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
            transition: all 0.25s ease;
        }

        .portal-search-input:focus {
            background: rgba(18, 24, 36, 0.95);
            border-color: var(--marsu-gold);
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.25);
            outline: none;
            color: #ffffff;
        }

        .portal-search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--marsu-gold);
            font-size: 1.15rem;
            pointer-events: none;
        }

        /* Quick Action Chips */
        .quick-chips-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 6px;
            margin-top: 1rem;
            scrollbar-width: none;
        }
        .quick-chips-row::-webkit-scrollbar { display: none; }

        .chip-pill {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 30px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .chip-pill:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--marsu-gold);
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Category Filter Buttons */
        .filter-btn-group {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }
        .filter-btn-group::-webkit-scrollbar { display: none; }

        .btn-filter-service {
            background: var(--portal-surface);
            border: 1px solid var(--portal-border);
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 30px;
            white-space: nowrap;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-filter-service:hover {
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-filter-service.active {
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.8) 0%, rgba(212, 175, 55, 0.35) 100%);
            border-color: var(--marsu-gold);
            color: #ffd700;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
        }

        /* 11 Services Cards Grid */
        .service-card {
            background: var(--portal-card);
            border: 1px solid var(--portal-border);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .service-card:hover {
            background: var(--portal-card-hover);
            border-color: var(--portal-border-gold);
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5), 0 0 25px rgba(212, 175, 55, 0.15);
        }

        .service-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            margin-bottom: 1rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
            transition: transform 0.25s ease;
        }

        .service-card:hover .service-icon-box {
            transform: scale(1.1);
        }

        .service-title {
            font-size: 1.02rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .service-desc {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 1.25rem;
            flex-grow: 1;
        }

        .service-tag {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 30px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .btn-service-action {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
        }

        .service-card:hover .btn-service-action {
            background: linear-gradient(135deg, var(--marsu-burgundy) 0%, rgba(212, 175, 55, 0.4) 100%);
            border-color: var(--marsu-gold);
            color: #ffffff;
        }

        /* Clearance Progress Card */
        .clearance-banner-card {
            background: linear-gradient(135deg, #141b27 0%, #1a2233 100%);
            border: 1px solid var(--portal-border-gold);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .clearance-station-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .clearance-station-item:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(212, 175, 55, 0.25);
        }

        /* Digital ID Modal Mockup */
        .digital-id-surface {
            background: linear-gradient(145deg, #800020 0%, #400010 60%, #1a0208 100%);
            border: 2px solid var(--marsu-gold);
            border-radius: 22px;
            padding: 1.75rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7), 0 0 35px rgba(212, 175, 55, 0.25);
        }

        .digital-id-surface::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Mobile Phone Simulator Shell Mode */
        .simulator-active-body {
            background: #05070a !important;
        }

        .simulator-wrapper {
            display: none;
            justify-content: center;
            padding: 1.5rem 0 3rem;
        }

        .simulator-active .simulator-wrapper {
            display: flex;
        }

        .simulator-active .portal-website-view {
            display: none;
        }

        .phone-shell {
            width: 100%;
            max-width: 440px;
            background: #0f131c;
            border-radius: 44px;
            border: 8px solid #232a38;
            box-shadow: 0 25px 70px -10px rgba(0, 0, 0, 0.85), 0 0 35px rgba(128, 0, 32, 0.35);
            min-height: 860px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* Floating Bottom Nav for Mobile / Simulator */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 28px);
            max-width: 460px;
            background: rgba(18, 23, 34, 0.94);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 30px;
            padding: 6px 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 1040;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.75), 0 0 20px rgba(128, 0, 32, 0.25);
            display: none;
        }

        @media (max-width: 991.98px) {
            .mobile-bottom-nav {
                display: flex;
            }
            body {
                padding-bottom: 80px;
            }
        }

        .simulator-active .mobile-bottom-nav {
            position: absolute;
            bottom: 12px;
            left: 12px;
            right: 12px;
            transform: none;
            width: auto;
            max-width: none;
            display: flex;
        }

        .bottom-nav-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            padding: 6px 12px;
            border-radius: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 0.65rem;
            font-weight: 600;
        }

        .bottom-nav-btn i {
            font-size: 1.18rem;
            transition: transform 0.2s ease;
        }

        .bottom-nav-btn:hover, .bottom-nav-btn.active {
            color: #ffd700;
        }

        .bottom-nav-btn.active i {
            transform: translateY(-2px);
            color: #ffd700;
        }

        /* Interactive Drawer (Offcanvas) */
        .offcanvas-portal {
            background: #111723;
            border-left: 1px solid rgba(212, 175, 55, 0.3);
            color: #ffffff;
        }

        .portal-footer {
            background: #090c12;
            border-top: 1px solid var(--portal-border);
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }
    </style>
</head>
<body id="portalBody">

    <!-- Ambient Gradient Atmosphere -->
    <div class="ambient-glow-top"></div>

    <!-- =======================================================================
         VIEWPORT 1: FULL UNIVERSITY STUDENT PORTAL WEBSITE (DEFAULT)
         ======================================================================= -->
    <div class="portal-website-view" id="websiteView">
        
        <!-- Public Website Header Navigation -->
        <header class="portal-navbar">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- University Brand Lockup -->
                <a href="#home" class="portal-brand d-flex align-items-center gap-3 text-decoration-none">
                    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" class="portal-brand-logo">
                    <div class="portal-brand-text">
                        <div class="portal-brand-subtitle">MARINDUQUE STATE UNIVERSITY</div>
                        <h1 class="portal-brand-title">Student Services Portal</h1>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="d-none d-lg-flex align-items-center gap-2">
                    <a href="#home" class="nav-link-portal active"><i class="bi bi-house-door"></i> Home</a>
                    <a href="#servicesSection" class="nav-link-portal"><i class="bi bi-grid-fill"></i> Services (11)</a>
                    <a href="#clearanceSection" class="nav-link-portal"><i class="bi bi-clipboard-check"></i> Online Clearance</a>
                    <a href="#bulletinsSection" class="nav-link-portal"><i class="bi bi-megaphone-fill"></i> Bulletins</a>
                    <button type="button" class="nav-link-portal border-0 bg-transparent" onclick="openDigitalIdModal()">
                        <i class="bi bi-person-badge-fill text-warning"></i> Digital ID Pass
                    </button>
                </nav>

                <!-- Right Action Buttons -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Toggle Mobile Phone View Simulator -->
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 d-inline-flex align-items-center gap-2" id="toggleSimulatorBtn" onclick="toggleMobileSimulator()" title="Toggle Mobile App Simulator View">
                        <i class="bi bi-phone text-warning"></i> <span class="d-none d-sm-inline" id="simulatorBtnText">Mobile App Mode</span>
                    </button>

                    <!-- Core Admin ERP Login Outbound Link (Clean separation) -->
                    <a href="<?= url('login') ?>" class="btn-portal-burgundy text-decoration-none" title="Staff, Faculty & Super Admin ERP System">
                        <i class="bi bi-box-arrow-in-right"></i> <span class="d-none d-sm-inline">Admin / Faculty ERP Login</span><span class="d-sm-none">ERP</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="container">
            
            <!-- Hero Banner & Student Status Summary -->
            <section class="portal-hero" id="home">
                <div class="hero-student-card">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="student-avatar-ring">
                                    <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                                         alt="Student Avatar" class="student-avatar-img">
                                    <span class="status-dot-active" title="Status: Online & Enrolled"></span>
                                </div>
                                <div>
                                    <div class="text-white-50 small fw-semibold">MARSU STUDENT IDENTITY VERIFIED</div>
                                    <h2 class="text-white mb-0 fw-bold"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></h2>
                                    <div class="text-warning small fw-semibold d-flex flex-wrap align-items-center gap-2 mt-1">
                                        <span><i class="bi bi-person-vcard me-1"></i><?= e($student['student_number'] ?? '26S0227') ?></span>
                                        <span>&bull;</span>
                                        <span><?= e($student['program_code'] ?? 'BSIS') ?> 3-A</span>
                                        <span>&bull;</span>
                                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">AY 2026-2027 ENROLLED</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white-50 mb-0" style="font-size: 0.88rem; max-width: 620px;">
                                Welcome to your centralized university portal. Select from <strong>11 integrated digital campus services</strong>, schedule health consultations, verify boarding house listings, borrow lab equipment, and track your graduation clearance.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-lg-end">
                                <button type="button" class="btn-portal-gold text-center justify-content-center" onclick="openDigitalIdModal()">
                                    <i class="bi bi-qr-code-scan"></i> Show Digital ID Pass
                                </button>
                                <a href="#clearanceSection" class="btn btn-outline-light rounded-pill px-4 py-2 small fw-semibold text-decoration-none text-center">
                                    <i class="bi bi-clipboard-check me-1"></i> Track Clearance (80%)
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Instant Interactive Services Search -->
                    <div class="portal-search-wrap">
                        <i class="bi bi-search portal-search-icon"></i>
                        <input type="text" id="serviceSearchInput" class="portal-search-input" 
                               placeholder="Search across 11 university services (e.g. procurement, clinic, housing, counseling, laptop, scholarship, dues)..." 
                               onkeyup="filterServicesRealtime(this.value)">
                    </div>

                    <!-- Quick Navigation Chips -->
                    <div class="quick-chips-row">
                        <span class="text-white-50 small align-self-center me-1" style="font-size: 0.74rem;">Popular:</span>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('procurement')"><i class="bi bi-cart-check text-success"></i> Supplies Requisition</a>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('clinic')"><i class="bi bi-heart-pulse text-danger"></i> Medical Clinic</a>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('housing')"><i class="bi bi-house-door text-info"></i> Boarding Houses</a>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('guidance')"><i class="bi bi-chat-heart text-warning"></i> Guidance Intake</a>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('scholarship')"><i class="bi bi-award text-gold"></i> UniFAST Welfare</a>
                        <a href="javascript:void(0)" class="chip-pill" onclick="quickFilterKeyword('laptop')"><i class="bi bi-laptop text-primary"></i> Lab Computer Pass</a>
                    </div>
                </div>
            </section>

            <!-- ===================================================================
                 SERVICES DIRECTORY SECTION (11 INTEGRATED ERP SUB-MODULES)
                 =================================================================== -->
            <section class="mt-4 pt-3" id="servicesSection">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <div class="text-warning small fw-bold text-uppercase" style="letter-spacing: 0.8px;">
                            <i class="bi bi-grid-3x3-gap-fill me-1"></i> UNIVERSITY SERVICE DIRECTORY
                        </div>
                        <h2 class="portal-heading text-white fw-bold mb-1">Select a Campus Service</h2>
                        <p class="text-white-50 small mb-0">Browse and submit requisitions to any of the 11 integrated modules.</p>
                    </div>

                    <!-- Category Filter Buttons -->
                    <div class="filter-btn-group" id="categoryFilterContainer">
                        <button type="button" class="btn-filter-service active" onclick="filterCategory('all', this)">All Services (11)</button>
                        <button type="button" class="btn-filter-service" onclick="filterCategory('living', this)">Campus &amp; Living</button>
                        <button type="button" class="btn-filter-service" onclick="filterCategory('health', this)">Health &amp; Guidance</button>
                        <button type="button" class="btn-filter-service" onclick="filterCategory('welfare', this)">Financial &amp; Welfare</button>
                        <button type="button" class="btn-filter-service" onclick="filterCategory('orgs', this)">Orgs &amp; Leadership</button>
                        <button type="button" class="btn-filter-service" onclick="filterCategory('academic', this)">Academic &amp; IT</button>
                    </div>
                </div>

                <!-- Results Counter -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-white-50 small" id="serviceResultCount">Showing 11 active campus services</span>
                    <button type="button" class="btn btn-link btn-sm text-decoration-none text-white-50 p-0" onclick="resetAllFilters()">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                    </button>
                </div>

                <!-- 11 Services Grid -->
                <div class="row g-4" id="servicesGrid">

                    <!-- 1. Procurement (prc_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="academic" data-keywords="procurement prc supplies equipment requisition purchase order lab student organization">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                        <i class="bi bi-cart-check-fill"></i>
                                    </div>
                                    <span class="service-tag bg-success bg-opacity-25 text-success border border-success border-opacity-50">prc_</span>
                                </div>
                                <h3 class="service-title">Procurement &amp; Supplies Requisition</h3>
                                <p class="service-desc">
                                    Submit student organization logistics requisitions, laboratory consumables, and track authorized purchase order fulfillment.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('procurement')">
                                    <span>Request Supplies / Equipment</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Housing (hsg_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="living" data-keywords="housing hsg boarding house dorm dormitory room bed landlord rent directory">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(6, 182, 212, 0.15); color: #06b6d4; border: 1px solid rgba(6, 182, 212, 0.3);">
                                        <i class="bi bi-house-door-fill"></i>
                                    </div>
                                    <span class="service-tag bg-info bg-opacity-25 text-info border border-info border-opacity-50">hsg_</span>
                                </div>
                                <h3 class="service-title">Accredited Boarding House Directory</h3>
                                <p class="service-desc">
                                    Locate CHED-inspected safe boarding houses, student dorms, and check verified room vacancies near Boac &amp; Santa Cruz campuses.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('housing')">
                                    <span>Browse Housing &amp; Reserve Room</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Health & Clinic (hth_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="health" data-keywords="clinic hth health medical dental doctor consultation medicine prescription appointment checkup">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(244, 63, 94, 0.15); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.3);">
                                        <i class="bi bi-heart-pulse-fill"></i>
                                    </div>
                                    <span class="service-tag bg-danger bg-opacity-25 text-danger border border-danger border-opacity-50">hth_</span>
                                </div>
                                <h3 class="service-title">Medical &amp; Dental Consultation Clinic</h3>
                                <p class="service-desc">
                                    Book university clinic consultations, dental cleaning appointments, and request official medical clearance certificates.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('health')">
                                    <span>Schedule Health Consultation</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Guidance (gdc_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="health" data-keywords="guidance gdc mental health counseling psychological counselor emotional stress intake privacy confidential">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(168, 85, 247, 0.15); color: #a855f7; border: 1px solid rgba(168, 85, 247, 0.3);">
                                        <i class="bi bi-chat-heart-fill"></i>
                                    </div>
                                    <span class="service-tag bg-primary bg-opacity-25 text-primary border border-primary border-opacity-50">gdc_</span>
                                </div>
                                <h3 class="service-title">Guidance &amp; Psychological Counseling</h3>
                                <p class="service-desc">
                                    Confidential 1-on-1 counseling, mental health intake, career guidance, and student psychological support (RA 10173 compliant).
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('guidance')">
                                    <span>Confidential Counseling Intake</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Welfare & Scholarships (wlf_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="welfare" data-keywords="welfare wlf scholarship grant unifast financial assistance emergency loan subsidy aid">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3);">
                                        <i class="bi bi-award-fill"></i>
                                    </div>
                                    <span class="service-tag bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50">wlf_</span>
                                </div>
                                <h3 class="service-title">Student Welfare &amp; Scholarships (OSAS)</h3>
                                <p class="service-desc">
                                    Apply for CHED UniFAST grants, university educational aid, student assistantships, and emergency financial assistance.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('welfare')">
                                    <span>Apply for Grant / Welfare</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Expense 4Ps (exp_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="welfare" data-keywords="expense exp 4ps dswd pantawid pamilya allowance stipend compliance beneficiary financial tracker">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(234, 179, 8, 0.15); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.3);">
                                        <i class="bi bi-wallet2"></i>
                                    </div>
                                    <span class="service-tag bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50">exp_</span>
                                </div>
                                <h3 class="service-title">DSWD 4Ps Beneficiary Support</h3>
                                <p class="service-desc">
                                    Submit monthly educational compliance slips, track cash allowance releases, and manage student educational expenditures.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('expense4ps')">
                                    <span>Submit 4Ps Compliance Report</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Leadership (sld_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="orgs" data-keywords="leadership sld ssc supreme student council officers election accreditation campus organization permit">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(99, 102, 241, 0.15); color: #6366f1; border: 1px solid rgba(99, 102, 241, 0.3);">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <span class="service-tag bg-primary bg-opacity-25 text-primary border border-primary border-opacity-50">sld_</span>
                                </div>
                                <h3 class="service-title">Student Leadership &amp; Council Portal</h3>
                                <p class="service-desc">
                                    Supreme Student Council officer verification, organization accreditation certificates, and student activity permits.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('leadership')">
                                    <span>File Activity Permit / Org Info</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Org Finance (orf_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="orgs" data-keywords="finance orf dues fees liquidation treasury payment receipt clearance organization financial statement">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(20, 184, 166, 0.15); color: #14b8a6; border: 1px solid rgba(20, 184, 166, 0.3);">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <span class="service-tag bg-info bg-opacity-25 text-info border border-info border-opacity-50">orf_</span>
                                </div>
                                <h3 class="service-title">Student Organization Finance &amp; Dues</h3>
                                <p class="service-desc">
                                    Review semester membership dues payment receipts, transparent organization balance sheets, and get treasury clearances.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('orgfinance')">
                                    <span>Verify Dues &amp; Request Clearance</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 9. IT Assets (ast_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="academic" data-keywords="assets ast laptop computer lab equipment projector reservation borrowing workstation pass">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(59, 130, 246, 0.15); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3);">
                                        <i class="bi bi-laptop-fill"></i>
                                    </div>
                                    <span class="service-tag bg-primary bg-opacity-25 text-primary border border-primary border-opacity-50">ast_</span>
                                </div>
                                <h3 class="service-title">IT Equipment &amp; Lab Reservation</h3>
                                <p class="service-desc">
                                    Reserve computer lab programming workstations, borrow campus audiovisual projectors, and request hardware passes.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('assets')">
                                    <span>Reserve Computer / Equipment</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 10. KMS & Publications (kmp_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="academic" data-keywords="kms kmp repository research capstone thesis publications archive journal irim">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(139, 92, 246, 0.15); color: #8b5cf6; border: 1px solid rgba(139, 92, 246, 0.3);">
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </div>
                                    <span class="service-tag bg-secondary bg-opacity-25 text-light border border-secondary border-opacity-50">kmp_</span>
                                </div>
                                <h3 class="service-title">IRIM KMS Capstone &amp; Research Archive</h3>
                                <p class="service-desc">
                                    Search MarSU published research papers, undergraduate thesis archives, capstone artifacts, and patent disclosures.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('kms')">
                                    <span>Browse Research Repository</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Retention (ret_) -->
                    <div class="col-md-6 col-lg-4 service-col" data-category="academic" data-keywords="retention ret academic tutoring advising grades early warning mentor intervention advisor">
                        <div class="service-card">
                            <div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="service-icon-box" style="background: rgba(14, 165, 233, 0.15); color: #0ea5e9; border: 1px solid rgba(14, 165, 233, 0.3);">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </div>
                                    <span class="service-tag bg-info bg-opacity-25 text-info border border-info border-opacity-50">ret_</span>
                                </div>
                                <h3 class="service-title">Academic Retention &amp; Peer Tutoring</h3>
                                <p class="service-desc">
                                    Academic performance monitoring, early subject warnings, and connect with volunteer peer tutors for exam preparation.
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-service-action" onclick="openServiceDrawer('retention')">
                                    <span>Request Peer Tutorial Help</span> <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ===================================================================
                 ONLINE CLEARANCE TRACKER SECTION
                 =================================================================== -->
            <section class="mt-5 pt-3" id="clearanceSection">
                <div class="clearance-banner-card">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div>
                            <div class="text-warning small fw-bold text-uppercase">
                                <i class="bi bi-clipboard-check-fill me-1"></i> GRADUATION &amp; SEMESTER CLEARANCE
                            </div>
                            <h2 class="portal-heading text-white fw-bold mb-1">Clearance Progress Tracker</h2>
                            <p class="text-white-50 small mb-0">AY 2026-2027 First Semester &bull; 8 of 10 Required Sign-offs Completed</p>
                        </div>
                        <div>
                            <button type="button" class="btn-portal-gold" onclick="simulateClearanceDownload()">
                                <i class="bi bi-file-earmark-pdf-fill"></i> View Clearance Certificate
                            </button>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between text-white-50 small mb-1">
                            <span>Clearance Completion</span>
                            <span class="text-warning fw-bold">80% Approved</span>
                        </div>
                        <div class="progress" style="height: 10px; background-color: rgba(255, 255, 255, 0.08); border-radius: 10px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                                 style="width: 80%; background: linear-gradient(90deg, #800020 0%, #d4af37 100%); border-radius: 10px;"></div>
                        </div>
                    </div>

                    <!-- 10 Clearance Stations List -->
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-book text-success me-2"></i>1. College Library</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-heart-pulse text-success me-2"></i>2. University Clinic</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-chat-heart text-success me-2"></i>3. Guidance Office</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-award text-success me-2"></i>4. Student Affairs (OSAS)</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-people text-success me-2"></i>5. Supreme Student Council</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-cash-stack text-success me-2"></i>6. Accounting &amp; Cashier</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-box-seam text-warning me-2"></i>7. Property Custodian</span>
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50">PENDING RETURN</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-card-checklist text-success me-2"></i>8. Office of the Registrar</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-shield-check text-success me-2"></i>9. Campus Security &amp; ID</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50">CLEARED</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clearance-station-item">
                                <span class="small fw-semibold"><i class="bi bi-person-workspace text-warning me-2"></i>10. College Dean's Office</span>
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50">FINAL REVIEW</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ===================================================================
                 CAMPUS BULLETINS & ADVISORIES SECTION
                 =================================================================== -->
            <section class="mt-4 pt-3" id="bulletinsSection">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="text-warning small fw-bold text-uppercase">
                            <i class="bi bi-megaphone-fill me-1"></i> OFFICIAL ADVISORIES
                        </div>
                        <h2 class="portal-heading text-white fw-bold mb-1">Campus Bulletins</h2>
                    </div>
                    <span class="badge bg-secondary bg-opacity-25 text-white-50 border border-secondary border-opacity-25">Updated Today</span>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 h-100" style="background: var(--portal-card); border: 1px solid var(--portal-border);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-50 small">ACADEMICS</span>
                                <span class="text-white-50 small" style="font-size: 0.72rem;">Oct 12, 2026</span>
                            </div>
                            <h4 class="text-white fs-6 fw-bold mb-2">Midterm Examination Schedule Released</h4>
                            <p class="text-white-50 small mb-0">Examination permits must be stamped by the department cashier before entry to testing centers.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 h-100" style="background: var(--portal-card); border: 1px solid var(--portal-border);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50 small">WELFARE &amp; 4PS</span>
                                <span class="text-white-50 small" style="font-size: 0.72rem;">Oct 10, 2026</span>
                            </div>
                            <h4 class="text-white fs-6 fw-bold mb-2">DSWD 4Ps &amp; UniFAST Grant Payroll</h4>
                            <p class="text-white-50 small mb-0">Eligible grantees are invited to verify their beneficiary records online in the portal prior to payout date.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 h-100" style="background: var(--portal-card); border: 1px solid var(--portal-border);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info bg-opacity-25 text-info border border-info border-opacity-50 small">CAMPUS LIFE</span>
                                <span class="text-white-50 small" style="font-size: 0.72rem;">Oct 08, 2026</span>
                            </div>
                            <h4 class="text-white fs-6 fw-bold mb-2">Accredited Boarding House Inspection List</h4>
                            <p class="text-white-50 small mb-0">OSAS has published the updated directory of CHED-certified student dorms around Boac campus.</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Public Portal Footer -->
        <footer class="portal-footer">
            <div class="container">
                <div class="row g-4 align-items-center justify-content-between">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU" width="36" height="36" class="rounded-circle border border-warning">
                            <div>
                                <h5 class="text-white mb-0 fw-bold fs-6">Marinduque State University</h5>
                                <div class="text-warning small" style="font-size: 0.72rem;">College of Information and Computing Sciences (CICS)</div>
                            </div>
                        </div>
                        <p class="text-white-50 small mb-0" style="max-width: 480px;">
                            Official Student Portal &bull; Panay, Boac, Marinduque &bull; RA 10173 Data Privacy Act Protected.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="mb-2">
                            <a href="<?= url('login') ?>" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 small">
                                <i class="bi bi-shield-lock-fill me-1 text-gold"></i> Core ERP Admin Login
                            </a>
                        </div>
                        <div class="text-white-50 small" style="font-size: 0.72rem;">
                            &copy; <?= date('Y') ?> MarSU ERP Ecosystem &bull; Student Sub-Service Web Edition
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- =======================================================================
         VIEWPORT 2: MOBILE APP SIMULATOR (EXPANDABLE / TOGGLEABLE)
         ======================================================================= -->
    <div class="simulator-wrapper" id="simulatorView">
        <div class="phone-shell">
            <!-- Simulated Device Status Bar -->
            <div class="d-flex justify-content-between align-items-center px-4 py-2 text-white-50 small" style="background: #090c12; font-size: 0.74rem;">
                <span id="simulatorClock">9:41</span>
                <div class="badge rounded-pill bg-dark border border-secondary px-3 py-1 text-warning" style="font-size: 0.65rem;">
                    <i class="bi bi-shield-check me-1"></i> MarSU ID
                </div>
                <div class="d-flex gap-1 text-white">
                    <i class="bi bi-reception-4"></i>
                    <i class="bi bi-wifi"></i>
                    <i class="bi bi-battery-full text-success"></i>
                </div>
            </div>

            <!-- Simulated Mobile App Header -->
            <div class="p-3 d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25" style="background: #111723;">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU" width="34" height="34" class="rounded-circle border border-warning">
                    <div>
                        <div class="fw-bold text-white fs-6 lh-1">MarSU App</div>
                        <div class="text-warning small" style="font-size: 0.65rem;">STUDENT DIGITAL PASS</div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle p-2" onclick="toggleMobileSimulator()" title="Exit Simulator">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Simulator Scroll Body -->
            <div class="p-3" style="overflow-y: auto; flex: 1; padding-bottom: 90px !important;">
                <!-- Mobile Student Card -->
                <div class="p-3 rounded-4 mb-3 text-white" style="background: linear-gradient(135deg, #800020 0%, #30030c 100%); border: 1px solid rgba(212, 175, 55, 0.4);">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                             alt="Avatar" width="46" height="46" class="rounded-circle border border-warning">
                        <div>
                            <div class="fw-bold fs-6 lh-1"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></div>
                            <div class="text-warning small" style="font-size: 0.72rem;"><?= e($student['student_number'] ?? '26S0227') ?> &bull; <?= e($student['program_code'] ?? 'BSIS') ?> 3-A</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top border-white border-opacity-10 small">
                        <span class="text-white-50">Clearance Status:</span>
                        <span class="badge bg-success bg-opacity-50 text-warning">80% Approved</span>
                    </div>
                </div>

                <!-- Quick Action Buttons in App -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <button type="button" class="btn btn-dark border border-secondary w-100 p-2 text-start rounded-3" onclick="openDigitalIdModal()">
                            <i class="bi bi-qr-code text-warning fs-5 d-block mb-1"></i>
                            <div class="fw-bold small text-white">Digital ID</div>
                            <div class="text-white-50" style="font-size: 0.65rem;">Tap to display</div>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-dark border border-secondary w-100 p-2 text-start rounded-3" onclick="openServiceDrawer('health')">
                            <i class="bi bi-heart-pulse text-danger fs-5 d-block mb-1"></i>
                            <div class="fw-bold small text-white">Clinic Visit</div>
                            <div class="text-white-50" style="font-size: 0.65rem;">Book doctor slot</div>
                        </button>
                    </div>
                </div>

                <!-- 11 Services List in App -->
                <div class="fw-bold text-white small mb-2 d-flex justify-content-between align-items-center">
                    <span>UNIVERSITY SERVICES</span>
                    <span class="badge bg-secondary bg-opacity-25 text-warning">11 ACTIVE</span>
                </div>

                <div class="d-flex flex-column gap-2 mb-4">
                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('procurement')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-success bg-success bg-opacity-10"><i class="bi bi-cart-check"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Procurement Supplies</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Org requisitions &amp; supplies</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('housing')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-info bg-info bg-opacity-10"><i class="bi bi-house-door"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Housing &amp; Dorms</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Accredited boarding houses</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('health')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-danger bg-danger bg-opacity-10"><i class="bi bi-heart-pulse"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Clinic Consultation</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Medical &amp; dental checks</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('guidance')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-primary bg-primary bg-opacity-10"><i class="bi bi-chat-heart"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Guidance Counseling</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Confidential mental intake</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('welfare')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-warning bg-warning bg-opacity-10"><i class="bi bi-award"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Scholarships &amp; Welfare</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">UniFAST &amp; student grants</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('expense4ps')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-warning bg-warning bg-opacity-10"><i class="bi bi-wallet2"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">DSWD 4Ps Grants</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Compliance &amp; allowances</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('leadership')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-primary bg-primary bg-opacity-10"><i class="bi bi-people"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Leadership &amp; Council</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Permits &amp; org accreditation</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('orgfinance')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-info bg-info bg-opacity-10"><i class="bi bi-cash-stack"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Org Finance &amp; Dues</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Receipts &amp; treasury clearance</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('assets')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-primary bg-primary bg-opacity-10"><i class="bi bi-laptop"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">IT Equipment Pass</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Lab terminals &amp; projectors</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('kms')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-secondary bg-secondary bg-opacity-10"><i class="bi bi-journal-bookmark"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">KMS Research Repository</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Theses &amp; publications</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>

                    <div class="p-2 rounded-3 d-flex align-items-center justify-content-between" style="background: #182030; border: 1px solid var(--portal-border);" onclick="openServiceDrawer('retention')">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 text-info bg-info bg-opacity-10"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <div class="text-white fw-semibold small lh-1">Retention &amp; Tutorials</div>
                                <div class="text-white-50" style="font-size: 0.65rem;">Peer academic assistance</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-white-50"></i>
                    </div>
                </div>
            </div>

            <!-- Mobile Simulator Bottom Nav Bar -->
            <div class="mobile-bottom-nav">
                <button type="button" class="bottom-nav-btn active" onclick="switchSimulatorTab('home')">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Home</span>
                </button>
                <button type="button" class="bottom-nav-btn" onclick="switchSimulatorTab('services')">
                    <i class="bi bi-grid-fill"></i>
                    <span>Services</span>
                </button>
                <button type="button" class="bottom-nav-btn" onclick="simulateClearanceDownload()">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Clearance</span>
                </button>
                <button type="button" class="bottom-nav-btn" onclick="openDigitalIdModal()">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>My ID</span>
                </button>
                <a href="<?= url('login') ?>" class="bottom-nav-btn text-decoration-none">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- =======================================================================
         FLOATING MOBILE BOTTOM NAVIGATION BAR (FOR REAL PHONES / RESPONSIVE)
         ======================================================================= -->
    <nav class="mobile-bottom-nav d-lg-none" id="realMobileBottomNav">
        <a href="#home" class="bottom-nav-btn active">
            <i class="bi bi-house-door-fill"></i>
            <span>Home</span>
        </a>
        <a href="#servicesSection" class="bottom-nav-btn">
            <i class="bi bi-grid-fill"></i>
            <span>Services</span>
        </a>
        <a href="#clearanceSection" class="bottom-nav-btn">
            <i class="bi bi-clipboard-check-fill"></i>
            <span>Clearance</span>
        </a>
        <button type="button" class="bottom-nav-btn border-0 bg-transparent" onclick="openDigitalIdModal()">
            <i class="bi bi-person-badge-fill"></i>
            <span>ID Pass</span>
        </button>
        <a href="<?= url('login') ?>" class="bottom-nav-btn text-decoration-none">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>ERP</span>
        </a>
    </nav>

    <!-- =======================================================================
         INTERACTIVE SERVICE ACTION DRAWER (OFFCANVAS)
         ======================================================================= -->
    <div class="offcanvas offcanvas-end offcanvas-portal" tabindex="-1" id="serviceDrawer" aria-labelledby="serviceDrawerLabel" style="width: 440px;">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25 py-3">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" id="drawerIconBox" style="background: rgba(212, 175, 55, 0.15); color: #ffd700;">
                    <i class="bi bi-box-seam fs-5" id="drawerIcon"></i>
                </div>
                <div>
                    <h5 class="offcanvas-title text-white fw-bold fs-6 mb-0" id="drawerTitle">Service Requisition</h5>
                    <div class="text-warning small" style="font-size: 0.7rem;" id="drawerModuleCode">prc_ PROCUREMENT</div>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-4">
            <!-- Statutory Data Privacy Warning (RA 10173 Compliance) -->
            <div class="p-2 px-3 rounded-3 mb-3 small d-flex align-items-center gap-2" style="background: rgba(212, 175, 55, 0.1); border: 1px solid rgba(212, 175, 55, 0.25); font-size: 0.72rem; color: #ffd700;">
                <i class="bi bi-shield-lock-fill fs-6"></i>
                <span>Protected under Republic Act 10173 (Data Privacy Act of 2012). Your submission is securely encrypted.</span>
            </div>

            <!-- Dynamic Form for Simulated Submission -->
            <form id="serviceRequestForm" onsubmit="handleServiceFormSubmit(event)">
                <!-- Student Auto-filled Info -->
                <div class="mb-3">
                    <label class="form-label text-white-50 small mb-1">STUDENT APPLICANT</label>
                    <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" 
                           value="<?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?> (<?= e($student['student_number'] ?? '26S0227') ?> - <?= e($student['program_code'] ?? 'BSIS') ?> 3-A)" readonly>
                </div>

                <!-- Specific Item / Subject Selection -->
                <div class="mb-3">
                    <label for="requestTypeSelect" class="form-label text-white-50 small mb-1" id="requestTypeLabel">REQUEST TYPE / CATEGORY</label>
                    <select class="form-select form-select-sm bg-dark text-white border-secondary" id="requestTypeSelect" required>
                        <option value="" selected disabled>-- Select Option --</option>
                    </select>
                </div>

                <!-- Target Schedule / Needed Date -->
                <div class="mb-3">
                    <label for="requestDateInput" class="form-label text-white-50 small mb-1">TARGET SCHEDULE / DATE NEEDED</label>
                    <input type="date" class="form-control form-control-sm bg-dark text-white border-secondary" id="requestDateInput" required value="<?= date('Y-m-d', strtotime('+2 days')) ?>">
                </div>

                <!-- Purpose / Remarks -->
                <div class="mb-3">
                    <label for="requestRemarks" class="form-label text-white-50 small mb-1">PURPOSE &amp; JUSTIFICATION</label>
                    <textarea class="form-control form-control-sm bg-dark text-white border-secondary" id="requestRemarks" rows="3" 
                              placeholder="Describe your purpose, event details, or specific symptoms / subject..." required></textarea>
                </div>

                <!-- Attachment Simulation -->
                <div class="mb-4">
                    <label class="form-label text-white-50 small mb-1">SUPPORTING DOCUMENTS (OPTIONAL)</label>
                    <div class="p-3 rounded-3 text-center border border-dashed border-secondary text-white-50 small" style="cursor: pointer;" onclick="document.getElementById('fileUploadSim').click()">
                        <i class="bi bi-cloud-arrow-up fs-4 d-block mb-1 text-gold"></i>
                        <span>Click to attach endorsement slip or ID scan</span>
                        <input type="file" id="fileUploadSim" class="d-none">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-portal-gold w-100 py-2 fw-bold text-center justify-content-center" id="submitRequestBtn">
                    <i class="bi bi-send-fill"></i> Submit Service Requisition
                </button>
            </form>

            <!-- Simulated Workflow Activity Log -->
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                <div class="text-white-50 small fw-semibold mb-2">RECENT DISPATCH LOGS:</div>
                <div class="p-2 rounded-3 bg-dark border border-secondary border-opacity-25 small text-white-50" style="font-size: 0.72rem;">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-white">Ref #REQ-2026-8812</span>
                        <span class="badge bg-success bg-opacity-25 text-success">DISPATCHED</span>
                    </div>
                    <div>Health Consultation Slot booked for Dr. Mendoza (Oct 14)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- =======================================================================
         DIGITAL STUDENT ID PASS MODAL
         ======================================================================= -->
    <div class="modal fade" id="digitalIdModal" tabindex="-1" aria-labelledby="digitalIdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content border-0 bg-transparent">
                <div class="digital-id-surface">
                    <!-- ID Card Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" width="42" height="42" class="rounded-circle border border-warning" style="background:#fff; padding: 2px;">
                            <div>
                                <div class="text-warning fw-bold small lh-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">REPUBLIC OF THE PHILIPPINES</div>
                                <div class="fw-bolder fs-6 text-white lh-1">MARINDUQUE STATE UNIVERSITY</div>
                                <div class="text-white-50" style="font-size: 0.62rem;">OFFICIAL STUDENT DIGITAL IDENTIFICATION CARD</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- ID Card Center Info -->
                    <div class="row align-items-center g-3 my-2">
                        <div class="col-4 text-center">
                            <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                                 alt="Student Photo" width="95" height="110" class="rounded-3 border border-warning shadow-sm" style="object-fit: cover;">
                            <span class="badge bg-success w-100 mt-2" style="font-size: 0.6rem;">VALID AY 26-27</span>
                        </div>
                        <div class="col-8">
                            <div class="text-warning small fw-bold lh-1 mb-1" style="font-size: 0.65rem;">STUDENT NAME</div>
                            <h4 class="text-white fw-bold mb-2 fs-5 text-uppercase"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></h4>

                            <div class="text-white-50 small lh-1 mb-1" style="font-size: 0.65rem;">STUDENT NUMBER</div>
                            <div class="text-warning fw-bolder fs-6 mb-2" style="letter-spacing: 1px;"><?= e($student['student_number'] ?? '26S0227') ?></div>

                            <div class="text-white-50 small lh-1 mb-1" style="font-size: 0.65rem;">PROGRAM &amp; YEAR</div>
                            <div class="text-white small fw-bold"><?= e($student['program_code'] ?? 'BSIS') ?> &bull; 3rd Year (Sec 3-A)</div>
                        </div>
                    </div>

                    <!-- Simulated Barcode & QR Block -->
                    <div class="p-2 rounded-3 bg-white text-dark mt-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column align-items-start">
                            <i class="bi bi-upc-scan fs-3 text-dark"></i>
                            <span class="text-muted fw-bold" style="font-size: 0.58rem; letter-spacing: 2px;">*26S0227-MARSU-CICS*</span>
                        </div>
                        <div class="text-end">
                            <i class="bi bi-qr-code fs-1 text-dark"></i>
                        </div>
                    </div>

                    <div class="text-center text-white-50 mt-2" style="font-size: 0.65rem;">
                        This digital pass serves as authenticated electronic verification for all MarSU campus entry points and library borrow desks.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Scripts (100% Offline, Zero External CDN) -->
    <script src="<?= asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset('assets/vendor/sweetalert2/sweetalert2.min.js') ?>"></script>

    <!-- Client-Side Interactive Engine (Zero jQuery, Zero Emojis) -->
    <script>
        // 1. Service Meta Specifications Dictionary
        const serviceMetaDictionary = {
            'procurement': {
                code: 'prc_ PROCUREMENT',
                title: 'Student Org Supplies & Equipment Requisition',
                icon: 'bi-cart-check-fill',
                color: '#10b981',
                options: [
                    'Event Logistics & Sound System Requisition',
                    'Laboratory Consumables & Chemistry Supplies',
                    'Student Council Office Stationery Supplies',
                    'Department Project Fabrication Materials',
                    'Classroom Whiteboard Markers & Paper Packs'
                ]
            },
            'housing': {
                code: 'hsg_ HOUSING DIRECTORY',
                title: 'Accredited Boarding House Room Inquiry',
                icon: 'bi-house-door-fill',
                color: '#06b6d4',
                options: [
                    'Boac Campus: Single Bed Space Reservation',
                    'Boac Campus: Shared Dormitory Room (2-4 pax)',
                    'Santa Cruz Campus: Boarding House Vacancy Inquiry',
                    'Landlord Verification & Monthly Rent Consultation',
                    'Boarding House Safety & Fire Clearance Check'
                ]
            },
            'health': {
                code: 'hth_ MEDICAL CLINIC',
                title: 'Medical & Dental Clinic Consultation',
                icon: 'bi-heart-pulse-fill',
                color: '#f43f5e',
                options: [
                    'Physician General Consultation (Fever, Flu, Checkup)',
                    'Dental Checkup & Oral Prophylaxis Slot',
                    'Annual Medical Examination (Freshmen & Athletes)',
                    'Medical Certificate Issuance (OJT / Scholarship)',
                    'Prescription Medicine Refill'
                ]
            },
            'guidance': {
                code: 'gdc_ GUIDANCE CENTER',
                title: 'Confidential Guidance & Counseling Intake',
                icon: 'bi-chat-heart-fill',
                color: '#a855f7',
                options: [
                    'Individual Confidential Psychological Counseling',
                    'Academic Stress & Career Path Advising',
                    'Personal & Emotional Support Session',
                    'Peer Facilitator Program Inquiry',
                    'Good Moral Certificate Request'
                ]
            },
            'welfare': {
                code: 'wlf_ STUDENT WELFARE',
                title: 'Student Welfare & Scholarship Application',
                icon: 'bi-award-fill',
                color: '#f59e0b',
                options: [
                    'CHED UniFAST Tertiary Education Subsidy (TES)',
                    'University Academic Scholarship Certification',
                    'Emergency Student Financial Assistance Loan',
                    'Student Assistantship (SA) Program Application',
                    'Solo Parent / PWD Student Assistance Benefit'
                ]
            },
            'expense4ps': {
                code: 'exp_ DSWD 4PS SUPPORT',
                title: 'DSWD 4Ps Monthly Educational Compliance',
                icon: 'bi-wallet2',
                color: '#eab308',
                options: [
                    'Monthly School Attendance Verification Submission',
                    'Stipend & Cash Allowance Disbursement Tracker',
                    'Educational Expenses Breakdown Report',
                    'Beneficiary Profile Update Request'
                ]
            },
            'leadership': {
                code: 'sld_ STUDENT LEADERSHIP',
                title: 'Student Council & Organization Activity Permit',
                icon: 'bi-people-fill',
                color: '#6366f1',
                options: [
                    'Campus Student Activity Permit Application',
                    'Student Organization Re-Accreditation Filing',
                    'Officer Verification for Co-Curricular Transcript',
                    'Leadership Training Workshop Registration'
                ]
            },
            'orgfinance': {
                code: 'orf_ ORG FINANCE',
                title: 'Student Organization Dues & Liquidation',
                icon: 'bi-cash-stack',
                color: '#14b8a6',
                options: [
                    'Semester Organization Dues Payment Receipt Verification',
                    'Student Council Financial Clearance Endorsement',
                    'Audited Organization Financial Statement Request',
                    'Event Budget Liquidation Submission'
                ]
            },
            'assets': {
                code: 'ast_ IT ASSETS & LABS',
                title: 'IT Lab Reservation & Equipment Pass',
                icon: 'bi-laptop-fill',
                color: '#3b82f6',
                options: [
                    'Computer Programming Lab Workstation Booking',
                    'Multimedia LCD Projector Borrowing Pass',
                    'Wireless Microphones & PA System Borrowing',
                    'Hardware Troubleshooting & Lab Facility Requisition'
                ]
            },
            'kms': {
                code: 'kmp_ IRIM KMS ARCHIVE',
                title: 'IRIM KMS Research & Capstone Archive',
                icon: 'bi-journal-bookmark-fill',
                color: '#8b5cf6',
                options: [
                    'Undergraduate Thesis & Capstone Paper Full-Text Access',
                    'Faculty Journal Publication Reprint Request',
                    'MarSU Innovation & Patent Registry Search',
                    'Plagiarism Scanning & Similarity Certificate'
                ]
            },
            'retention': {
                code: 'ret_ RETENTION & TUTORIAL',
                title: 'Academic Retention & Peer Tutoring Request',
                icon: 'bi-graph-up-arrow',
                color: '#0ea5e9',
                options: [
                    'Volunteer Peer Tutor Match (Discrete Math / Programming)',
                    'Midterm Academic Early Warning Consultation',
                    'Faculty Advising Session Request',
                    'Study Skills & Time Management Mentorship'
                ]
            }
        };

        // Current Active Drawer Key
        let activeServiceKey = 'procurement';

        // 2. Open Service Offcanvas Drawer
        function openServiceDrawer(serviceKey) {
            const meta = serviceMetaDictionary[serviceKey] || serviceMetaDictionary['procurement'];
            activeServiceKey = serviceKey;

            // Update drawer elements
            const drawerTitle = document.getElementById('drawerTitle');
            const drawerModuleCode = document.getElementById('drawerModuleCode');
            const drawerIcon = document.getElementById('drawerIcon');
            const drawerIconBox = document.getElementById('drawerIconBox');
            const selectEl = document.getElementById('requestTypeSelect');

            if (drawerTitle) drawerTitle.textContent = meta.title;
            if (drawerModuleCode) drawerModuleCode.textContent = meta.code;
            if (drawerIcon) drawerIcon.className = `bi ${meta.icon} fs-5`;
            if (drawerIconBox) {
                drawerIconBox.style.color = meta.color;
                drawerIconBox.style.backgroundColor = `${meta.color}22`;
            }

            // Populate select options
            if (selectEl) {
                selectEl.innerHTML = '<option value="" selected disabled>-- Select Specific Requisition --</option>';
                meta.options.forEach(opt => {
                    const optEl = document.createElement('option');
                    optEl.value = opt;
                    optEl.textContent = opt;
                    selectEl.appendChild(optEl);
                });
            }

            // Trigger Bootstrap Offcanvas
            const drawerEl = document.getElementById('serviceDrawer');
            if (drawerEl && typeof bootstrap !== 'undefined') {
                const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(drawerEl);
                bsOffcanvas.show();
            }
        }

        // 3. Handle Service Form Submission (Client-Side Interactive Simulation)
        function handleServiceFormSubmit(event) {
            event.preventDefault();
            const selectEl = document.getElementById('requestTypeSelect');
            const dateEl = document.getElementById('requestDateInput');
            const meta = serviceMetaDictionary[activeServiceKey] || { title: 'Service Request' };
            const refId = `REQ-2026-${Math.floor(1000 + Math.random() * 9000)}`;

            // Close Offcanvas
            const drawerEl = document.getElementById('serviceDrawer');
            if (drawerEl && typeof bootstrap !== 'undefined') {
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(drawerEl);
                if (bsOffcanvas) bsOffcanvas.hide();
            }

            // Show SweetAlert2 Success Feedback
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Requisition Submitted!',
                    html: `Your request for <strong>${selectEl.value || meta.title}</strong> has been transmitted to the department dispatch queue.<br><br><span class="badge bg-secondary text-warning px-3 py-2 fs-6">Tracking Ref: ${refId}</span><br><br><small class="text-white-50">Target Date: ${dateEl.value} &bull; Status: Transmitted</small>`,
                    icon: 'success',
                    background: '#121722',
                    color: '#ffffff',
                    confirmButtonColor: '#800020'
                });
            } else {
                alert(`Success! Requisition submitted with Reference: ${refId}`);
            }

            // Reset form
            event.target.reset();
        }

        // 4. Real-time Search Across 11 Services
        function filterServicesRealtime(keyword) {
            const query = (keyword || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.service-col');
            let visibleCount = 0;

            cards.forEach(col => {
                const text = (col.innerText || '').toLowerCase();
                const keywords = (col.getAttribute('data-keywords') || '').toLowerCase();
                const matches = text.includes(query) || keywords.includes(query);

                col.style.display = matches ? 'block' : 'none';
                if (matches) visibleCount++;
            });

            const countEl = document.getElementById('serviceResultCount');
            if (countEl) {
                countEl.textContent = `Showing ${visibleCount} of 11 campus services`;
            }
        }

        function quickFilterKeyword(word) {
            const searchInput = document.getElementById('serviceSearchInput');
            if (searchInput) {
                searchInput.value = word;
                filterServicesRealtime(word);
                // Scroll to services
                const sec = document.getElementById('servicesSection');
                if (sec) sec.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // 5. Category Filtering
        function filterCategory(category, btnEl) {
            const buttons = document.querySelectorAll('.btn-filter-service');
            buttons.forEach(b => b.classList.remove('active'));
            if (btnEl) btnEl.classList.add('active');

            const cards = document.querySelectorAll('.service-col');
            let visibleCount = 0;

            cards.forEach(col => {
                const cardCat = col.getAttribute('data-category');
                const matches = (category === 'all') || (cardCat === category);
                col.style.display = matches ? 'block' : 'none';
                if (matches) visibleCount++;
            });

            const countEl = document.getElementById('serviceResultCount');
            if (countEl) {
                countEl.textContent = `Showing ${visibleCount} of 11 campus services`;
            }
        }

        function resetAllFilters() {
            const searchInput = document.getElementById('serviceSearchInput');
            if (searchInput) searchInput.value = '';
            const allBtn = document.querySelector('.btn-filter-service');
            filterCategory('all', allBtn);
        }

        // 6. Open Digital ID Modal
        function openDigitalIdModal() {
            const modalEl = document.getElementById('digitalIdModal');
            if (modalEl && typeof bootstrap !== 'undefined') {
                const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                bsModal.show();
            }
        }

        // 7. Clearance Download / Preview Simulation
        function simulateClearanceDownload() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Digital Clearance Pass',
                    html: 'AY 2026-2027 Clearance is at <strong>80% Completion</strong>.<br><br>Remaining pending sign-offs: <strong>Property Custodian</strong> (Equipment return check) and <strong>Dean\'s Office</strong> (Final sign-off).',
                    icon: 'info',
                    background: '#121722',
                    color: '#ffffff',
                    confirmButtonColor: '#d4af37'
                });
            }
        }

        // 8. Toggle Mobile Phone Simulator Shell
        let isSimulatorMode = false;
        function toggleMobileSimulator() {
            isSimulatorMode = !isSimulatorMode;
            const body = document.getElementById('portalBody');
            const simText = document.getElementById('simulatorBtnText');

            if (isSimulatorMode) {
                body.classList.add('simulator-active', 'simulator-active-body');
                if (simText) simText.textContent = 'Exit Mobile Mode';
            } else {
                body.classList.remove('simulator-active', 'simulator-active-body');
                if (simText) simText.textContent = 'Mobile App Mode';
            }
        }

        function switchSimulatorTab(tab) {
            if (tab === 'home' || tab === 'services') {
                toggleMobileSimulator();
                const target = document.getElementById(tab === 'home' ? 'home' : 'servicesSection');
                if (target) target.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // 9. Simulator Clock Tick
        setInterval(() => {
            const now = new Date();
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const clockEl = document.getElementById('simulatorClock');
            if (clockEl) clockEl.textContent = `${hours}:${minutes}`;
        }, 1000);
    </script>
</body>
</html>
