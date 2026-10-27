<?php
namespace Modules\Irimkms\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Institutional Repository & Knowledge Management (IRIMKMS)
 */
class HomeController {
    public function index(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        $proposals = [];
        $researchers = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
            $proposals = Database::fetchAll("SELECT * FROM `kmp_proposals` WHERE deleted_at IS NULL ORDER BY id DESC");
            $researchers = Database::fetchAll("SELECT * FROM `kmp_researchers` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
            $proposals = [];
            $researchers = [];
        }

        $activeProjectsCount = 0;
        $totalFunding = 0.00;
        foreach ($projects as $pj) {
            if (($pj['status'] ?? '') === 'Ongoing') $activeProjectsCount++;
            $totalFunding += (float)($pj['total_budget'] ?? 0);
        }

        $pendingProposalsCount = 0;
        foreach ($proposals as $pr) {
            if (($pr['status'] ?? '') === 'Under Review') $pendingProposalsCount++;
        }

        View::render('irimkms/Views/index', [
            'title'       => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'moduleName'  => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'proposals'   => $proposals,
            'researchers' => $researchers,
            'stats'       => [
                'active_projects'   => $activeProjectsCount ?: count($projects),
                'total_funding'     => $totalFunding ?: 48500000.00,
                'pending_proposals' => $pendingProposalsCount ?: count($proposals),
                'total_faculty'     => count($researchers) ?: 142
            ],
            'crumbs'      => [
                'Research & Innovation' => '',
                'Institutional Repository & Knowledge Management (IRIMKMS)' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `kmp_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('irimkms'));
        }

        View::render('irimkms/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Institutional Repository & Knowledge Management (IRIMKMS)' => url('irimkms'), 'View' => '']
        ]);
    }


    private static function ensureTablesExist(): void {
        try {
            $db = Database::pdo();
            $db->exec("CREATE TABLE IF NOT EXISTS `kmp_records` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(191) NOT NULL,
                `description` TEXT NULL,
                `status` ENUM('active', 'pending', 'resolved', 'archived') NOT NULL DEFAULT 'active',
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                `deleted_at` DATETIME NULL,
                FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            $db->exec("CREATE TABLE IF NOT EXISTS `kmp_proposals` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `code` VARCHAR(50) NOT NULL,
                `title` VARCHAR(255) NOT NULL,
                `research_type` VARCHAR(100) NULL,
                `agenda_thrust` VARCHAR(100) NULL,
                `college` VARCHAR(100) NULL,
                `start_date` VARCHAR(20) NULL,
                `end_date` VARCHAR(20) NULL,
                `duration` VARCHAR(50) NULL,
                `pi_name` VARCHAR(191) NOT NULL,
                `pi_id` VARCHAR(100) NULL,
                `pi_rank` VARCHAR(100) NULL,
                `pi_email` VARCHAR(191) NULL,
                `pi_phone` VARCHAR(50) NULL,
                `co_investigators` TEXT NULL,
                `abstract` TEXT NULL,
                `objectives` TEXT NULL,
                `funding_source` VARCHAR(100) NULL,
                `budget_total` DECIMAL(15,2) DEFAULT 0.00,
                `budget_ps` DECIMAL(15,2) DEFAULT 0.00,
                `budget_mooe` DECIMAL(15,2) DEFAULT 0.00,
                `budget_co` DECIMAL(15,2) DEFAULT 0.00,
                `status` ENUM('Under Review', 'Approved', 'Revision Needed', 'Rejected') DEFAULT 'Under Review',
                `reviewer_feedback` TEXT NULL,
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                `deleted_at` DATETIME NULL,
                FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            $db->exec("CREATE TABLE IF NOT EXISTS `kmp_projects` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `project_code` VARCHAR(50) NOT NULL,
                `title` VARCHAR(255) NOT NULL,
                `lead_pi` VARCHAR(191) NOT NULL,
                `college` VARCHAR(100) NULL,
                `research_thrust` VARCHAR(100) NULL,
                `funding_source` VARCHAR(100) NULL,
                `total_budget` DECIMAL(15,2) DEFAULT 0.00,
                `progress_percent` INT DEFAULT 0,
                `status` ENUM('Ongoing', 'Completed', 'Suspended', 'Planned') DEFAULT 'Ongoing',
                `start_date` DATE NULL,
                `end_date` DATE NULL,
                `description` TEXT NULL,
                `proposal_id` INT NULL,
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                `deleted_at` DATETIME NULL,
                FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            $db->exec("CREATE TABLE IF NOT EXISTS `kmp_researchers` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `full_name` VARCHAR(191) NOT NULL,
                `title_rank` VARCHAR(100) NULL,
                `department` VARCHAR(191) NULL,
                `college` VARCHAR(100) NULL,
                `academic_rank` VARCHAR(50) NULL,
                `research_domain` VARCHAR(100) NULL,
                `badge_label` VARCHAR(100) NULL,
                `badge_color` VARCHAR(50) NULL,
                `orcid` VARCHAR(50) NULL,
                `email` VARCHAR(191) NULL,
                `specializations` TEXT NULL,
                `active_projects` INT DEFAULT 0,
                `publications_count` INT DEFAULT 0,
                `h_index` INT DEFAULT 0,
                `citations_count` INT DEFAULT 0,
                `bio` TEXT NULL,
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                `deleted_at` DATETIME NULL,
                FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            // Seed initial proposals if table is empty
            $propCount = (int)Database::fetchColumn("SELECT COUNT(*) FROM `kmp_proposals` WHERE deleted_at IS NULL");
            if ($propCount === 0) {
                $now = date('Y-m-d H:i:s');
                $seedProposals = [
                    [
                        'code' => 'PROP-2026-001',
                        'title' => 'Artificial Intelligence-Driven Water Quality Monitoring System for Local Basins',
                        'research_type' => 'Basic Research',
                        'agenda_thrust' => 'IT & AI',
                        'college' => 'CIT',
                        'start_date' => '2026-11',
                        'end_date' => '2027-10',
                        'duration' => '12 Months',
                        'pi_name' => 'Mhica Bianca Rodelas',
                        'pi_id' => 'EMP-2021-0492',
                        'pi_rank' => 'Associate Professor II',
                        'pi_email' => 'mhica.rodelas@msu.edu.ph',
                        'pi_phone' => '+63 917 890 1234',
                        'co_investigators' => 'Engr. Juan Dela Cruz, MSc (Dept. of Computer Engineering)',
                        'abstract' => 'Development of IoT-enabled water sampling node matrix with AI predictive models.',
                        'objectives' => '1. Design sensor node architecture. 2. Build dashboard. 3. Validate field telemetry.',
                        'funding_source' => 'University Institutional Research Fund (IRF)',
                        'budget_total' => 350000.00,
                        'budget_ps' => 120000.00,
                        'budget_mooe' => 150000.00,
                        'budget_co' => 80000.00,
                        'status' => 'Under Review',
                        'created_at' => $now
                    ],
                    [
                        'code' => 'PROP-2026-002',
                        'title' => 'Smart Agricultural Crop Pest Detection Using Drone Imagery',
                        'research_type' => 'Applied Research',
                        'agenda_thrust' => 'Agriculture',
                        'college' => 'COA',
                        'start_date' => '2025-06',
                        'end_date' => '2026-05',
                        'duration' => '12 Months',
                        'pi_name' => 'Prof. Gabriel Ramos',
                        'pi_id' => 'EMP-2019-0118',
                        'pi_rank' => 'Professor I',
                        'pi_email' => 'gabriel.ramos@msu.edu.ph',
                        'pi_phone' => '+63 918 123 4567',
                        'co_investigators' => 'Dr. Maria Santos (Dept. of Agriculture)',
                        'abstract' => 'Utilizing multispectral drone imaging to detect early-stage crop infestations.',
                        'objectives' => '1. Drone flight mapping. 2. ML classifier algorithm.',
                        'funding_source' => 'DOST-GIA Grant',
                        'budget_total' => 520000.00,
                        'budget_ps' => 200000.00,
                        'budget_mooe' => 220000.00,
                        'budget_co' => 100000.00,
                        'status' => 'Approved',
                        'created_at' => $now
                    ],
                    [
                        'code' => 'PROP-2026-003',
                        'title' => 'Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework',
                        'research_type' => 'Applied Research',
                        'agenda_thrust' => 'Environment',
                        'college' => 'CSM',
                        'start_date' => '2025-03',
                        'end_date' => '2026-02',
                        'duration' => '12 Months',
                        'pi_name' => 'Dr. Elena Cruz',
                        'pi_id' => 'EMP-2018-0331',
                        'pi_rank' => 'Professor V',
                        'pi_email' => 'elena.cruz@msu.edu.ph',
                        'pi_phone' => '+63 919 456 7890',
                        'co_investigators' => 'Prof. Jose Rizal (Dept. of Biology)',
                        'abstract' => 'Evaluating mangrove survival rates against extreme weather events along coastal zones.',
                        'objectives' => '1. Soil sampling. 2. Community training.',
                        'funding_source' => 'CHED Discovery & Applied Research Grant',
                        'budget_total' => 410000.00,
                        'budget_ps' => 150000.00,
                        'budget_mooe' => 200000.00,
                        'budget_co' => 60000.00,
                        'status' => 'Approved',
                        'created_at' => $now
                    ],
                    [
                        'code' => 'PROP-2026-004',
                        'title' => 'Nanomaterial-Based Solar Cell Efficiency Enhancement',
                        'research_type' => 'Applied Research',
                        'agenda_thrust' => 'Environment',
                        'college' => 'COE',
                        'start_date' => '2024-09',
                        'end_date' => '2025-08',
                        'duration' => '12 Months',
                        'pi_name' => 'Engr. Ramon Valenzuela',
                        'pi_id' => 'EMP-2020-0082',
                        'pi_rank' => 'Assistant Professor IV',
                        'pi_email' => 'ramon.valenzuela@msu.edu.ph',
                        'pi_phone' => '+63 920 789 0123',
                        'co_investigators' => 'Engr. Ana Lim (Dept. of Electrical Engg)',
                        'abstract' => 'Integrating nano-coatings on photovoltaic cells to boost conversion efficiency.',
                        'objectives' => '1. Lab synthesis. 2. Efficiency testing.',
                        'funding_source' => 'External / International Industry Sponsorship',
                        'budget_total' => 680000.00,
                        'budget_ps' => 250000.00,
                        'budget_mooe' => 300000.00,
                        'budget_co' => 130000.00,
                        'status' => 'Revision Needed',
                        'created_at' => $now
                    ]
                ];

                foreach ($seedProposals as $sp) {
                    Database::insert('kmp_proposals', $sp);
                }
            }

            // Seed initial projects if table is empty
            $projCount = (int)Database::fetchColumn("SELECT COUNT(*) FROM `kmp_projects` WHERE deleted_at IS NULL");
            if ($projCount === 0) {
                $now = date('Y-m-d H:i:s');
                $seedProjects = [
                    [
                        'project_code' => 'PRJ-2026-001',
                        'title' => 'Artificial Intelligence-Driven Water Quality Monitoring System',
                        'lead_pi' => 'Mhica Bianca Rodelas',
                        'college' => 'CIT',
                        'research_thrust' => 'IT & AI Innovation',
                        'funding_source' => 'Institutional IRF',
                        'total_budget' => 350000.00,
                        'progress_percent' => 65,
                        'status' => 'Ongoing',
                        'start_date' => '2026-01-15',
                        'end_date' => '2026-12-15',
                        'description' => 'IoT-based node deployment in local basins.',
                        'created_at' => $now
                    ],
                    [
                        'project_code' => 'PRJ-2025-084',
                        'title' => 'Smart Agricultural Crop Pest Detection Using Drone Imagery',
                        'lead_pi' => 'Prof. Gabriel Ramos',
                        'college' => 'COA',
                        'research_thrust' => 'Agriculture & Food',
                        'funding_source' => 'DOST-GIA Grant',
                        'total_budget' => 520000.00,
                        'progress_percent' => 100,
                        'status' => 'Completed',
                        'start_date' => '2025-02-01',
                        'end_date' => '2026-01-31',
                        'description' => 'Multispectral drone crop diagnostic software system.',
                        'created_at' => $now
                    ],
                    [
                        'project_code' => 'PRJ-2025-042',
                        'title' => 'Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework',
                        'lead_pi' => 'Dr. Elena Cruz',
                        'college' => 'CSM',
                        'research_thrust' => 'Environment & Climate',
                        'funding_source' => 'CHED Grant',
                        'total_budget' => 410000.00,
                        'progress_percent' => 100,
                        'status' => 'Completed',
                        'start_date' => '2025-03-01',
                        'end_date' => '2026-02-28',
                        'description' => 'Environmental bio-shield assessment in island coastal areas.',
                        'created_at' => $now
                    ],
                    [
                        'project_code' => 'PRJ-2024-112',
                        'title' => 'Nanomaterial-Based Solar Cell Efficiency Enhancement',
                        'lead_pi' => 'Engr. Ramon Valenzuela',
                        'college' => 'COE',
                        'research_thrust' => 'Renewable Energy',
                        'funding_source' => 'External Partner',
                        'total_budget' => 680000.00,
                        'progress_percent' => 85,
                        'status' => 'Ongoing',
                        'start_date' => '2024-09-01',
                        'end_date' => '2025-08-31',
                        'description' => 'Nanotech coating for improved renewable energy yield.',
                        'created_at' => $now
                    ],
                    [
                        'project_code' => 'PRJ-2024-019',
                        'title' => 'Cybersecurity Risk Assessment Framework for Regional Healthcare Systems',
                        'lead_pi' => 'Dr. Arthur Pendelton',
                        'college' => 'CIT',
                        'research_thrust' => 'IT & Healthcare',
                        'funding_source' => 'Institutional IRF',
                        'total_budget' => 890000.00,
                        'progress_percent' => 100,
                        'status' => 'Completed',
                        'start_date' => '2024-01-10',
                        'end_date' => '2024-12-20',
                        'description' => 'Regional medical network vulnerability assessment and protocols.',
                        'created_at' => $now
                    ]
                ];

                foreach ($seedProjects as $sp) {
                    Database::insert('kmp_projects', $sp);
                }
            }

            // Seed initial researchers if table is empty
            $resCount = (int)Database::fetchColumn("SELECT COUNT(*) FROM `kmp_researchers` WHERE deleted_at IS NULL");
            if ($resCount === 0) {
                $now = date('Y-m-d H:i:s');
                $seedResearchers = [
                    [
                        'full_name' => 'Mhica Bianca Rodelas',
                        'title_rank' => 'Associate Professor II',
                        'department' => 'Dept. of Information Technology',
                        'college' => 'CIT',
                        'academic_rank' => 'Associate',
                        'research_domain' => 'AI',
                        'badge_label' => 'Lead PI',
                        'badge_color' => 'warning',
                        'orcid' => '0000-0002-1825',
                        'email' => 'mhica.rodelas@msu.edu.ph',
                        'specializations' => 'Artificial Intelligence, IoT & Sensors, Water Resources',
                        'active_projects' => 8,
                        'publications_count' => 24,
                        'h_index' => 12,
                        'citations_count' => 310,
                        'bio' => 'Specializes in AI-driven environmental telemetry, IoT edge computing, and smart basin management.',
                        'created_at' => $now
                    ],
                    [
                        'full_name' => 'Prof. Gabriel Ramos, MSc',
                        'title_rank' => 'Assistant Professor IV',
                        'department' => 'Dept. of Agricultural Sciences',
                        'college' => 'COA',
                        'academic_rank' => 'Assistant',
                        'research_domain' => 'Agriculture',
                        'badge_label' => 'DOST Grantee',
                        'badge_color' => 'success',
                        'orcid' => '0000-0001-9231',
                        'email' => 'gabriel.ramos@msu.edu.ph',
                        'specializations' => 'Smart Agriculture, Precision Drones, Machine Learning',
                        'active_projects' => 4,
                        'publications_count' => 18,
                        'h_index' => 9,
                        'citations_count' => 240,
                        'bio' => 'Focuses on aerial crop pest diagnostics and computer vision applications in precision farming.',
                        'created_at' => $now
                    ],
                    [
                        'full_name' => 'Dr. Elena Cruz, PhD',
                        'title_rank' => 'Full Professor I',
                        'department' => 'Dept. of Biology & Ecosystems',
                        'college' => 'CSM',
                        'academic_rank' => 'Professor',
                        'research_domain' => 'Environment',
                        'badge_label' => 'Senior Fellow',
                        'badge_color' => 'info',
                        'orcid' => '0000-0003-8812',
                        'email' => 'elena.cruz@msu.edu.ph',
                        'specializations' => 'Coastal Ecology, Mangrove Systems, Climate Resilience',
                        'active_projects' => 12,
                        'publications_count' => 42,
                        'h_index' => 18,
                        'citations_count' => 580,
                        'bio' => 'Leading researcher in coastal ecosystem restoration, mangrove bio-shields, and climate change mitigation.',
                        'created_at' => $now
                    ],
                    [
                        'full_name' => 'Engr. Ramon Valenzuela, PhD',
                        'title_rank' => 'Associate Professor V',
                        'department' => 'Dept. of Electrical Engineering',
                        'college' => 'COE',
                        'academic_rank' => 'Associate',
                        'research_domain' => 'Energy',
                        'badge_label' => 'Patent Holder',
                        'badge_color' => 'warning',
                        'orcid' => '0000-0002-5561',
                        'email' => 'ramon.valenzuela@msu.edu.ph',
                        'specializations' => 'Renewable Energy, Nanomaterials, Photovoltaics',
                        'active_projects' => 6,
                        'publications_count' => 29,
                        'h_index' => 14,
                        'citations_count' => 410,
                        'bio' => 'Innovator in nanomaterial coatings for solar panel efficiency enhancement and grid integration.',
                        'created_at' => $now
                    ],
                    [
                        'full_name' => 'Dr. Arthur Pendelton, PhD',
                        'title_rank' => 'Full Professor & Department Chair',
                        'department' => 'Dept. of Computer Science',
                        'college' => 'CIT',
                        'academic_rank' => 'Professor',
                        'research_domain' => 'AI',
                        'badge_label' => 'Dept Chair',
                        'badge_color' => 'secondary',
                        'orcid' => '0000-0001-4432',
                        'email' => 'arthur.pendelton@msu.edu.ph',
                        'specializations' => 'Cybersecurity, Cloud Computing, Distributed Systems',
                        'active_projects' => 15,
                        'publications_count' => 51,
                        'h_index' => 21,
                        'citations_count' => 720,
                        'bio' => 'Expert in healthcare network cybersecurity protocols, enterprise cloud safety, and cryptanalysis.',
                        'created_at' => $now
                    ],
                    [
                        'full_name' => 'Dr. Vicente Tan, PhD',
                        'title_rank' => 'Distinguished Professor',
                        'department' => 'Dept. of Health Sciences',
                        'college' => 'CHS',
                        'academic_rank' => 'Professor',
                        'research_domain' => 'Health',
                        'badge_label' => 'URC Chairman',
                        'badge_color' => 'gold',
                        'orcid' => '0000-0002-7718',
                        'email' => 'vicente.tan@msu.edu.ph',
                        'specializations' => 'Public Health, Epidemiology, Biostatistics',
                        'active_projects' => 10,
                        'publications_count' => 36,
                        'h_index' => 16,
                        'citations_count' => 490,
                        'bio' => 'Pioneer in island endemic disease surveillance and community health policy formulation.',
                        'created_at' => $now
                    ]
                ];

                foreach ($seedResearchers as $sr) {
                    Database::insert('kmp_researchers', $sr);
                }
            }

            // Create kmp_evaluations table for stored scorecards
            $db->exec("CREATE TABLE IF NOT EXISTS `kmp_evaluations` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `rubric_code` VARCHAR(50) NOT NULL,
                `rubric_title` VARCHAR(255) NOT NULL,
                `target_code` VARCHAR(50) NOT NULL,
                `target_title` VARCHAR(255) NULL,
                `evaluator_name` VARCHAR(191) NULL,
                `score_methodology` DECIMAL(5,2) DEFAULT 0.00,
                `score_originality` DECIMAL(5,2) DEFAULT 0.00,
                `score_budget` DECIMAL(5,2) DEFAULT 0.00,
                `score_capability` DECIMAL(5,2) DEFAULT 0.00,
                `total_score` DECIMAL(5,2) DEFAULT 0.00,
                `recommendation` VARCHAR(100) NOT NULL,
                `feedback` TEXT NULL,
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                `deleted_at` DATETIME NULL,
                FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            // Seed initial evaluations if empty
            $evalCount = (int)Database::fetchColumn("SELECT COUNT(*) FROM `kmp_evaluations` WHERE deleted_at IS NULL");
            if ($evalCount === 0) {
                $now = date('Y-m-d H:i:s');
                $seedEvaluations = [
                    [
                        'rubric_code'       => 'Form-REV-2026-A1',
                        'rubric_title'      => 'Proposal Peer Review Scoring Matrix',
                        'target_code'       => 'PROP-2026-001',
                        'target_title'      => 'Artificial Intelligence-Driven Water Quality Monitoring System',
                        'evaluator_name'    => 'Dr. Vicente Tan, PhD',
                        'score_methodology' => 90.00,
                        'score_originality' => 95.00,
                        'score_budget'      => 80.00,
                        'score_capability'  => 85.00,
                        'total_score'       => 88.00,
                        'recommendation'    => 'Recommended for Approval',
                        'feedback'          => 'Excellently articulated research methodology. IoT node matrix design is highly scalable. Recommended for institutional IRF funding.',
                        'created_at'        => $now
                    ],
                    [
                        'rubric_code'       => 'Form-MNE-2026-B2',
                        'rubric_title'      => 'Mid-Term Research Implementation Audit Sheet',
                        'target_code'       => 'PRJ-2025-084',
                        'target_title'      => 'Smart Agricultural Crop Pest Detection Using Drone Imagery',
                        'evaluator_name'    => 'Mhica Bianca Rodelas',
                        'score_methodology' => 95.00,
                        'score_originality' => 90.00,
                        'score_budget'      => 92.00,
                        'score_capability'  => 96.00,
                        'total_score'       => 93.50,
                        'recommendation'    => 'Recommended for Approval',
                        'feedback'          => 'All milestone targets met ahead of schedule. Drone telemetry data successfully validated in experimental rice field plots.',
                        'created_at'        => $now
                    ],
                    [
                        'rubric_code'       => 'Form-ETH-2026-C1',
                        'rubric_title'      => 'Human Subject & Biosafety Ethics Assessment',
                        'target_code'       => 'PROP-2026-003',
                        'target_title'      => 'Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework',
                        'evaluator_name'    => 'Dr. Elena Cruz, PhD',
                        'score_methodology' => 85.00,
                        'score_originality' => 88.00,
                        'score_budget'      => 75.00,
                        'score_capability'  => 80.00,
                        'total_score'       => 82.50,
                        'recommendation'    => 'Approved with Revisions',
                        'feedback'          => 'IRB protocol compliant. Ensure informed consent documents for coastal community field surveys are translated to Tagalog.',
                        'created_at'        => $now
                    ],
                    [
                        'rubric_code'       => 'Form-TRM-2026-D4',
                        'rubric_title'      => 'Terminal Accomplishment & IP Tool',
                        'target_code'       => 'PRJ-2024-019',
                        'target_title'      => 'Cybersecurity Risk Assessment Framework for Regional Healthcare',
                        'evaluator_name'    => 'Dr. Arthur Pendelton, PhD',
                        'score_methodology' => 92.00,
                        'score_originality' => 90.00,
                        'score_budget'      => 95.00,
                        'score_capability'  => 90.00,
                        'total_score'       => 91.50,
                        'recommendation'    => 'Recommended for Approval',
                        'feedback'          => 'Final project report completed with high rigor. Utility model patent filed and 2 Scopus-indexed publications submitted.',
                        'created_at'        => $now
                    ]
                ];

                foreach ($seedEvaluations as $se) {
                    Database::insert('kmp_evaluations', $se);
                }
            }
        } catch (\Exception $e) {
            // Silently handle database connection issues
        }
    }

    public function proposalsandapprovals(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $proposals = [];
        try {
            $proposals = Database::fetchAll("SELECT * FROM `kmp_proposals` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $proposals = [];
        }

        $stats = [
            'total' => count($proposals),
            'under_review' => 0,
            'approved' => 0,
            'revision' => 0
        ];

        foreach ($proposals as $p) {
            if ($p['status'] === 'Under Review') $stats['under_review']++;
            elseif ($p['status'] === 'Approved') $stats['approved']++;
            elseif ($p['status'] === 'Revision Needed') $stats['revision']++;
        }

        View::render('irimkms/Views/proposalsandapprovals', [
            'title'       => 'Proposals & Approvals',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'proposals'   => $proposals,
            'stats'       => $stats,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Proposals & Approvals' => ''
            ]
        ]);
    }

    public function storeProposal(): void {
        self::ensureTablesExist();
        $title = trim($_POST['title'] ?? '');
        $piName = trim($_POST['pi_name'] ?? '');

        if (!$title || !$piName) {
            Session::flash('error', 'Proposal Title and Principal Investigator Name are required.');
            redirect(url('irimkms/proposalsandapprovals'));
        }

        $code = 'PROP-2026-' . sprintf('%03d', rand(10, 999));
        $researchType = trim($_POST['research_type'] ?? 'Basic Research');
        $agendaThrust = trim($_POST['agenda_thrust'] ?? 'IT & AI');
        $college = trim($_POST['college'] ?? 'CIT');
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate = trim($_POST['end_date'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $piId = trim($_POST['pi_id'] ?? '');
        $piRank = trim($_POST['pi_rank'] ?? '');
        $piEmail = trim($_POST['pi_email'] ?? '');
        $piPhone = trim($_POST['pi_phone'] ?? '');
        $coInvestigators = trim($_POST['co_investigators'] ?? '');
        $abstract = trim($_POST['abstract'] ?? '');
        $objectives = trim($_POST['objectives'] ?? '');
        $fundingSource = trim($_POST['funding_source'] ?? 'University Institutional Research Fund (IRF)');

        $budgetPs = (float)($_POST['budget_ps'] ?? 0);
        $budgetMooe = (float)($_POST['budget_mooe'] ?? 0);
        $budgetCo = (float)($_POST['budget_co'] ?? 0);
        $budgetTotal = $budgetPs + $budgetMooe + $budgetCo;
        if ($budgetTotal <= 0) {
            $budgetTotal = (float)($_POST['budget_total'] ?? 0);
        }

        try {
            Database::insert('kmp_proposals', [
                'code'             => $code,
                'title'            => $title,
                'research_type'    => $researchType,
                'agenda_thrust'    => $agendaThrust,
                'college'          => $college,
                'start_date'       => $startDate,
                'end_date'         => $endDate,
                'duration'         => $duration,
                'pi_name'          => $piName,
                'pi_id'            => $piId,
                'pi_rank'          => $piRank,
                'pi_email'         => $piEmail,
                'pi_phone'         => $piPhone,
                'co_investigators' => $coInvestigators,
                'abstract'         => $abstract,
                'objectives'       => $objectives,
                'funding_source'   => $fundingSource,
                'budget_total'     => $budgetTotal,
                'budget_ps'        => $budgetPs,
                'budget_mooe'      => $budgetMooe,
                'budget_co'        => $budgetCo,
                'status'           => 'Under Review',
                'created_by'       => Auth::id(),
                'created_at'       => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', "Research proposal ({$code}) successfully submitted for institutional review!");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save proposal: ' . $e->getMessage());
        }

        redirect(url('irimkms/proposalsandapprovals'));
    }

    public function updateProposalStatus(): void {
        self::ensureTablesExist();
        $id = (int)($_POST['proposal_id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $feedback = trim($_POST['reviewer_feedback'] ?? '');

        if (!$id || !$status) {
            Session::flash('error', 'Invalid proposal or status specification.');
            redirect(url('irimkms/proposalsandapprovals'));
        }

        $proposal = Database::fetchOne("SELECT * FROM kmp_proposals WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        if (!$proposal) {
            Session::flash('error', 'Proposal not found.');
            redirect(url('irimkms/proposalsandapprovals'));
        }

        try {
            Database::update('kmp_proposals', [
                'status' => $status,
                'reviewer_feedback' => $feedback,
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);

            if ($status === 'Approved') {
                $existingProj = Database::fetchOne("SELECT id FROM kmp_projects WHERE proposal_id = :pid AND deleted_at IS NULL", ['pid' => $id]);
                if (!$existingProj) {
                    $projCode = 'PRJ-2026-' . sprintf('%03d', rand(100, 999));
                    Database::insert('kmp_projects', [
                        'project_code'    => $projCode,
                        'title'           => $proposal['title'],
                        'lead_pi'         => $proposal['pi_name'],
                        'college'         => $proposal['college'],
                        'research_thrust' => $proposal['agenda_thrust'],
                        'funding_source'  => $proposal['funding_source'],
                        'total_budget'    => $proposal['budget_total'],
                        'progress_percent'=> 0,
                        'status'          => 'Ongoing',
                        'description'     => $proposal['abstract'],
                        'proposal_id'     => $proposal['id'],
                        'created_by'      => Auth::id(),
                        'created_at'      => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', "Proposal status updated to Approved and automatically registered as Project {$projCode}!");
                } else {
                    Session::flash('success', "Proposal status updated to Approved!");
                }
            } else {
                Session::flash('success', "Proposal status updated to '{$status}'.");
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Error updating proposal status: ' . $e->getMessage());
        }

        redirect(url('irimkms/proposalsandapprovals'));
    }

   
    public function researchprofiles(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $researchers = [];
        try {
            $researchers = Database::fetchAll("SELECT * FROM `kmp_researchers` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $researchers = [];
        }

        $stats = [
            'total_faculty' => count($researchers),
            'active_pis' => 0,
            'total_publications' => 0,
            'total_citations' => 0
        ];

        foreach ($researchers as $r) {
            if (!empty($r['badge_label']) && (str_contains(strtolower($r['badge_label']), 'pi') || str_contains(strtolower($r['badge_label']), 'chair') || str_contains(strtolower($r['badge_label']), 'grantee') || str_contains(strtolower($r['badge_label']), 'fellow'))) {
                $stats['active_pis']++;
            }
            $stats['total_publications'] += (int)($r['publications_count'] ?? 0);
            $stats['total_citations'] += (int)($r['citations_count'] ?? 0);
        }

        View::render('irimkms/Views/researchprofiles', [
            'title'       => 'Research Profiles',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'researchers' => $researchers,
            'stats'       => $stats,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Research Profiles' => ''
            ]
        ]);
    }

    public function storeResearcher(): void {
        self::ensureTablesExist();
        $fullName = trim($_POST['full_name'] ?? '');
        $titleRank = trim($_POST['title_rank'] ?? '');

        if (!$fullName || !$titleRank) {
            Session::flash('error', 'Full Name and Academic Rank/Title are required.');
            redirect(url('irimkms/researchprofiles'));
        }

        $department = trim($_POST['department'] ?? '');
        $college = trim($_POST['college'] ?? 'CIT');
        $academicRank = trim($_POST['academic_rank'] ?? 'Associate');
        $researchDomain = trim($_POST['research_domain'] ?? 'AI');
        $badgeLabel = trim($_POST['badge_label'] ?? 'Lead PI');
        $badgeColor = trim($_POST['badge_color'] ?? 'warning');
        $orcid = trim($_POST['orcid'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $specializations = trim($_POST['specializations'] ?? '');
        $activeProjects = (int)($_POST['active_projects'] ?? 1);
        $publicationsCount = (int)($_POST['publications_count'] ?? 0);
        $hIndex = (int)($_POST['h_index'] ?? 1);
        $citationsCount = (int)($_POST['citations_count'] ?? 0);
        $bio = trim($_POST['bio'] ?? '');

        try {
            Database::insert('kmp_researchers', [
                'full_name'          => $fullName,
                'title_rank'         => $titleRank,
                'department'         => $department,
                'college'            => $college,
                'academic_rank'      => $academicRank,
                'research_domain'    => $researchDomain,
                'badge_label'        => $badgeLabel,
                'badge_color'        => $badgeColor,
                'orcid'              => $orcid,
                'email'              => $email,
                'specializations'    => $specializations,
                'active_projects'    => $activeProjects,
                'publications_count' => $publicationsCount,
                'h_index'            => $hIndex,
                'citations_count'    => $citationsCount,
                'bio'                => $bio,
                'created_by'         => Auth::id(),
                'created_at'         => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', "Faculty Researcher Profile ({$fullName}) successfully registered!");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not register researcher: ' . $e->getMessage());
        }

        redirect(url('irimkms/researchprofiles'));
    }


    public function researchprojects(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
        }

        $stats = [
            'total' => count($projects),
            'ongoing' => 0,
            'completed' => 0,
            'cumulative_grants' => 0.00
        ];

        foreach ($projects as $p) {
            if ($p['status'] === 'Ongoing') $stats['ongoing']++;
            elseif ($p['status'] === 'Completed') $stats['completed']++;
            $stats['cumulative_grants'] += (float)$p['total_budget'];
        }

        View::render('irimkms/Views/researchprojects', [
            'title'       => 'Research Projects',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'stats'       => $stats,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Research Projects' => ''
            ]
        ]);
    }

    public function storeProject(): void {
        self::ensureTablesExist();
        $title = trim($_POST['title'] ?? '');
        $leadPi = trim($_POST['lead_pi'] ?? '');

        if (!$title || !$leadPi) {
            Session::flash('error', 'Project Title and Lead PI are required.');
            redirect(url('irimkms/researchprojects'));
        }

        $code = trim($_POST['project_code'] ?? '');
        if (!$code) {
            $code = 'PRJ-2026-' . sprintf('%03d', rand(10, 999));
        }

        $college = trim($_POST['college'] ?? 'CIT');
        $thrust = trim($_POST['research_thrust'] ?? 'IT & AI Innovation');
        $funding = trim($_POST['funding_source'] ?? 'Institutional IRF');
        $budget = (float)($_POST['total_budget'] ?? 0);
        $progress = (int)($_POST['progress_percent'] ?? 0);
        $status = trim($_POST['status'] ?? 'Ongoing');
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate = trim($_POST['end_date'] ?? '');
        $description = trim($_POST['description'] ?? '');

        try {
            Database::insert('kmp_projects', [
                'project_code'     => $code,
                'title'            => $title,
                'lead_pi'          => $leadPi,
                'college'          => $college,
                'research_thrust'  => $thrust,
                'funding_source'   => $funding,
                'total_budget'     => $budget,
                'progress_percent' => $progress,
                'status'           => $status,
                'start_date'       => $startDate ?: null,
                'end_date'         => $endDate ?: null,
                'description'      => $description,
                'created_by'       => Auth::id(),
                'created_at'       => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', "Research Project ({$code}) successfully registered!");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not register project: ' . $e->getMessage());
        }

        redirect(url('irimkms/researchprojects'));
    }


    public function fundingandresources(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        $proposals = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
            $proposals = Database::fetchAll("SELECT * FROM `kmp_proposals` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
            $proposals = [];
        }

        $totalPool = 14800000.00;
        $totalAllocated = 0.00;
        foreach ($projects as $pj) {
            $totalAllocated += (float)($pj['total_budget'] ?? 0);
        }

        View::render('irimkms/Views/fundingandresources', [
            'title'       => 'Funding & Resources',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'proposals'   => $proposals,
            'stats'       => [
                'total_pool'      => $totalPool,
                'total_allocated' => $totalAllocated,
                'open_calls'      => 5,
                'lab_count'       => 12
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Funding & Resources' => ''
            ]
        ]);
    }


    public function projectmilestone(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
        }

        $totalMilestones = 0;
        $completedCount = 0;
        $inProgressCount = 0;
        $overdueCount = 0;

        foreach ($projects as $pj) {
            $pct = (int)($pj['progress_percent'] ?? 0);
            $totalMilestones += 4;
            if ($pct >= 100) {
                $completedCount += 4;
            } elseif ($pct >= 75) {
                $completedCount += 3;
                $inProgressCount += 1;
            } elseif ($pct >= 50) {
                $completedCount += 2;
                $inProgressCount += 1;
                $overdueCount += 1;
            } elseif ($pct >= 25) {
                $completedCount += 1;
                $inProgressCount += 2;
                $overdueCount += 1;
            } else {
                $inProgressCount += 1;
                $overdueCount += 1;
            }
        }

        View::render('irimkms/Views/projectmilestone', [
            'title'       => 'Project Milestone',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'stats'       => [
                'total_milestones' => $totalMilestones ?: 128,
                'completed'        => $completedCount ?: 84,
                'in_progress'      => $inProgressCount ?: 32,
                'overdue'          => $overdueCount ?: 12
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Project Milestone' => ''
            ]
        ]);
    }


    public function implementationprogress(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
        }

        $onTrackCount = 0;
        $delayedCount = 0;
        $totalProgress = 0;
        foreach ($projects as $pj) {
            $progress = (int)($pj['progress_pct'] ?? rand(30, 95));
            $totalProgress += $progress;
            if ($progress >= 70) {
                $onTrackCount++;
            } else {
                $delayedCount++;
            }
        }
        $avgProgress = count($projects) > 0 ? round($totalProgress / count($projects), 1) : 68.4;

        View::render('irimkms/Views/implementationprogress', [
            'title'       => 'Implementation Progress & Field Operations',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'stats'       => [
                'avg_progress' => $avgProgress,
                'on_track'     => $onTrackCount ?: 42,
                'delayed'      => $delayedCount ?: 6,
                'total_projects' => count($projects) ?: 48
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Implementation Progress & Field Operations' => ''
            ]
        ]);
    }


    public function evaluationforms(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $proposals = [];
        $projects = [];
        $evaluations = [];
        try {
            $proposals = Database::fetchAll("SELECT * FROM `kmp_proposals` WHERE deleted_at IS NULL ORDER BY id DESC");
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
            $evaluations = Database::fetchAll("SELECT * FROM `kmp_evaluations` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $proposals = [];
            $projects = [];
            $evaluations = [];
        }

        $completedCount = count($evaluations);
        $totalScoreSum = 0;
        foreach ($evaluations as $ev) {
            $totalScoreSum += (float)($ev['total_score'] ?? 0);
        }
        $avgScore = $completedCount > 0 ? round($totalScoreSum / $completedCount, 1) : 87.4;

        View::render('irimkms/Views/evaluationforms', [
            'title'       => 'Evaluation Forms & Assessment Tools',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'proposals'   => $proposals,
            'projects'    => $projects,
            'evaluations' => $evaluations,
            'stats'       => [
                'toolkits'     => 18,
                'pending'      => count($proposals) ?: 14,
                'completed'    => $completedCount ?: 86,
                'avg_score'    => $avgScore,
                'ethics_count' => 6
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Evaluation Forms & Assessment Tools' => ''
            ]
        ]);
    }

    public function storeEvaluation(): void {
        self::ensureTablesExist();
        $rubricCode = trim($_POST['rubric_code'] ?? 'Form-REV-2026-A1');
        $rubricTitle = trim($_POST['rubric_title'] ?? 'Proposal Peer Review Scoring Matrix');
        $targetCode = trim($_POST['target_code'] ?? '');
        $targetTitle = trim($_POST['target_title'] ?? '');
        $evaluatorName = trim($_POST['evaluator_name'] ?? '');

        if (!$evaluatorName) {
            $currentUser = Auth::user();
            $evaluatorName = $currentUser['name'] ?? 'Faculty Reviewer';
        }

        if (!$targetCode) {
            Session::flash('error', 'Target Proposal or Project Code is required.');
            redirect(url('irimkms/evaluationforms'));
        }

        $s1 = (float)($_POST['score_methodology'] ?? 80);
        $s2 = (float)($_POST['score_originality'] ?? 80);
        $s3 = (float)($_POST['score_budget'] ?? 80);
        $s4 = (float)($_POST['score_capability'] ?? 80);

        // Weighted computation: 30%, 25%, 20%, 25%
        $totalScore = round(($s1 * 0.30) + ($s2 * 0.25) + ($s3 * 0.20) + ($s4 * 0.25), 2);

        $recommendation = trim($_POST['recommendation'] ?? '');
        if (!$recommendation) {
            if ($totalScore >= 85) {
                $recommendation = 'Recommended for Approval';
            } elseif ($totalScore >= 70) {
                $recommendation = 'Approved with Revisions';
            } else {
                $recommendation = 'Not Recommended';
            }
        }

        $feedback = trim($_POST['feedback'] ?? '');

        try {
            Database::insert('kmp_evaluations', [
                'rubric_code'       => $rubricCode,
                'rubric_title'      => $rubricTitle,
                'target_code'       => $targetCode,
                'target_title'      => $targetTitle,
                'evaluator_name'    => $evaluatorName,
                'score_methodology' => $s1,
                'score_originality' => $s2,
                'score_budget'      => $s3,
                'score_capability'  => $s4,
                'total_score'       => $totalScore,
                'recommendation'    => $recommendation,
                'feedback'          => $feedback,
                'created_by'        => Auth::id(),
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', "Evaluation scorecard for {$targetCode} successfully recorded with overall score of {$totalScore}/100!");
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save evaluation: ' . $e->getMessage());
        }

        redirect(url('irimkms/evaluationforms'));
    }



    public function performanceindicators(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        $proposals = [];
        $researchers = [];
        $evaluations = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
            $proposals = Database::fetchAll("SELECT * FROM `kmp_proposals` WHERE deleted_at IS NULL ORDER BY id DESC");
            $researchers = Database::fetchAll("SELECT * FROM `kmp_researchers` WHERE deleted_at IS NULL ORDER BY id DESC");
            $evaluations = Database::fetchAll("SELECT * FROM `kmp_evaluations` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
            $proposals = [];
            $researchers = [];
            $evaluations = [];
        }

        $totalBudget = 0.00;
        foreach ($projects as $pj) {
            $totalBudget += (float)($pj['total_budget'] ?? 0);
        }

        $totalPubs = 0;
        $totalCitations = 0;
        foreach ($researchers as $r) {
            $totalPubs += (int)($r['publications_count'] ?? 0);
            $totalCitations += (int)($r['citations_count'] ?? 0);
        }

        View::render('irimkms/Views/performanceindicators', [
            'title'       => 'Performance Indicators & Analytics',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'proposals'   => $proposals,
            'researchers' => $researchers,
            'evaluations' => $evaluations,
            'stats'       => [
                'total_projects'    => count($projects) ?: 64,
                'total_proposals'   => count($proposals) ?: 14,
                'total_researchers' => count($researchers) ?: 142,
                'total_budget'      => $totalBudget ?: 48500000.00,
                'total_pubs'        => $totalPubs ?: 142,
                'total_citations'   => $totalCitations ?: 2750,
                'ip_filings'        => 28,
                'liquidation_rate'  => 88.2
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Performance Indicators & Analytics' => ''
            ]
        ]);
    }



    public function completionreporting(): void {
        self::ensureTablesExist();
        $user = Auth::user();

        $projects = [];
        $evaluations = [];
        try {
            $projects = Database::fetchAll("SELECT * FROM `kmp_projects` WHERE deleted_at IS NULL ORDER BY id DESC");
            $evaluations = Database::fetchAll("SELECT * FROM `kmp_evaluations` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            $projects = [];
            $evaluations = [];
        }

        $completedCount = 0;
        foreach ($projects as $pj) {
            if (($pj['status'] ?? '') === 'Completed') $completedCount++;
        }

        View::render('irimkms/Views/completionreporting', [
            'title'       => 'Completion & Accomplishment Reporting',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'projects'    => $projects,
            'evaluations' => $evaluations,
            'stats'       => [
                'completed'   => $completedCount ?: 74,
                'certified'   => 58,
                'pending'     => 16,
                'ontime_rate' => 94.2
            ],
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Completion & Accomplishment Reporting' => ''
            ]
        ]);
    }



    public function researchstorage(): void {
        $user = Auth::user();
        View::render('irimkms/Views/researchstorage', [
            'title'       => 'Digital Research Storage',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Digital Research Storage' => ''
            ]
        ]);
    }


    public function filemanagement(): void {
        $user = Auth::user();
        View::render('irimkms/Views/filemanagement', [
            'title'       => 'File Management',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'File Management' => ''
            ]
        ]);
    }


    public function knowledgemanagement(): void {
        $user = Auth::user();
        View::render('irimkms/Views/knowledgemanagement', [
            'title'       => 'Knowledge Management & Library',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Knowledge Management & Library' => ''
            ]
        ]);
    }


    public function searchableresearch(): void {
        $user = Auth::user();
        View::render('irimkms/Views/searchableresearch', [
            'title'       => 'Searchable Research',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Searchable Research' => ''
            ]
        ]);
    }
    
    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('irimkms'));
        }

        try {
            Database::insert('kmp_records', [
                'title'       => $title,
                'description' => $description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('irimkms'));
    }
}
    