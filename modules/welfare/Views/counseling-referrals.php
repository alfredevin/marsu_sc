<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>External Referral Form - Marinduque State University</title>
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --maroon: #800000;
      --maroon-dark: #5c0000;
      --maroon-light: #fdf5f5;
      --ink-900: #1a202c;
      --ink-800: #2d3748;
      --ink-700: #4a5568;
      --ink-500: #718096;
      --border-color: #cbd5e0;
      --bg-color: #f0f4f8;
      --white: #ffffff;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --radius: 8px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
    }

    body {
      background-color: var(--bg-color);
      color: var(--ink-900);
      padding: 30px 20px;
      display: flex;
      justify-content: center;
      width: 100vw;
      overflow-x: hidden;
    }

    /* Page Container */
    .page-container {
      width: 100%;
      max-width: 1100px;
    }

    /* Action Bar (Screen Only) */
    .action-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      background-color: var(--white);
      padding: 16px 28px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border-left: 5px solid var(--maroon);
    }

    .eyebrow {
      text-transform: uppercase;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--maroon);
    }

    .action-toolbar h1 {
      font-size: 1.3rem;
      color: var(--ink-900);
      font-weight: 700;
    }

    .btn-group {
      display: flex;
      gap: 10px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      font-size: 0.85rem;
      font-weight: 600;
      border-radius: 6px;
      border: 1px solid transparent;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-outline {
      background-color: var(--white);
      border-color: var(--border-color);
      color: var(--ink-700);
    }

    .btn-outline:hover {
      background-color: #edf2f7;
    }

    .btn-maroon {
      background-color: var(--maroon);
      color: var(--white);
    }

    .btn-maroon:hover {
      background-color: var(--maroon-dark);
    }

    /* Form Sheet Layout */
    .referral-sheet {
      background: var(--white);
      padding: 40px 48px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid #e2e8f0;
    }

    /* Balanced Centered Letterhead with Logo */
    .referral-letterhead {
      display: grid;
      grid-template-columns: 80px 1fr 80px;
      align-items: center;
      border-bottom: 2px solid var(--maroon);
      padding-bottom: 16px;
      margin-bottom: 24px;
    }

    .logo-container {
      width: 75px;
      height: 75px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .logo-placeholder {
      width: 75px;
      height: 75px;
    }

    .lh-text {
      text-align: center;
    }

    .lh-text h3 {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--ink-700);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .lh-text h2 {
      font-size: 1.35rem;
      color: var(--maroon);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-weight: 800;
      line-height: 1.2;
      margin: 2px 0;
    }

    .lh-text p {
      font-size: 0.88rem;
      color: var(--ink-800);
      font-weight: 600;
    }

    .lh-text .sub-detail {
      font-size: 0.75rem;
      color: var(--ink-500);
      margin-top: 2px;
    }

    /* Form Content Elements */
    .referral-body {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .intro-letter {
      font-size: 0.85rem;
      line-height: 1.6;
      color: var(--ink-800);
      background-color: var(--maroon-light);
      padding: 14px 18px;
      border-left: 4px solid var(--maroon);
      border-radius: 0 6px 6px 0;
      margin-bottom: 8px;
    }

    .sign-off {
      margin-top: 10px;
      display: flex;
      flex-direction: column;
    }

    .sign-off b {
      color: var(--ink-900);
      font-size: 0.88rem;
    }

    /* Professional Case Management Card Block */
    .case-card-block {
      background-color: #f8fafc;
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      padding: 20px 24px;
      margin-bottom: 8px;
    }

    /* Section Divider Headers */
    .form-section-title {
      font-size: 0.82rem;
      font-weight: 700;
      color: var(--maroon);
      text-transform: uppercase;
      letter-spacing: 0.6px;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 6px;
      margin-top: 8px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* Field Grids with Proper Spacing */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px 20px;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .field.full {
      grid-column: span 2;
    }

    .field label {
      font-size: 0.73rem;
      font-weight: 700;
      color: var(--ink-700);
      text-transform: uppercase;
    }

    .field input, 
    .field textarea {
      width: 100%;
      padding: 8px 12px;
      font-size: 0.85rem;
      color: var(--ink-900);
      border: 1px solid var(--border-color);
      border-radius: 5px;
      background-color: #ffffff;
      outline: none;
      transition: all 0.2s ease;
    }

    .field input:focus, 
    .field textarea:focus {
      border-color: var(--maroon);
      box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.08);
    }

    /* Selection Grids */
    .check-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 8px 20px;
    }

    .check-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      color: var(--ink-800);
      cursor: pointer;
    }

    .check-item input[type="checkbox"],
    .check-item input[type="radio"] {
      accent-color: var(--maroon);
      width: 15px;
      height: 15px;
    }

    .other-inline-input {
      flex: 1;
      margin-left: 6px;
      padding: 3px 6px;
      border: none;
      border-bottom: 1px solid var(--border-color);
      outline: none;
      font-size: 0.82rem;
      background: transparent;
    }

    /* Signatures Block */
    .sig-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 32px;
      margin-top: 14px;
    }

    .sig-line {
      border-top: 1px solid var(--ink-800);
      padding-top: 6px;
      font-size: 0.78rem;
      color: var(--ink-700);
      font-weight: 600;
      text-align: center;
    }

    /* Footer Notice */
    .confidential-note {
      margin-top: 12px;
      padding: 10px 14px;
      font-size: 0.73rem;
      color: var(--ink-700);
      background-color: #f8fafc;
      border: 1px dashed var(--border-color);
      border-radius: 5px;
      line-height: 1.4;
    }

    /* ==========================================
       OPTIMIZED PRINT STYLESHEET
       ========================================== */
    @media print {
      body {
        background-color: #fff;
        padding: 0;
        margin: 0;
        width: 100%;
      }

      .no-print {
        display: none !important;
      }

      .page-container {
        padding: 0 !important;
        max-width: 100%;
      }

      .referral-sheet {
        box-shadow: none;
        border: none;
        padding: 0;
        margin: 0;
      }

      .intro-letter {
        background-color: #fdf8f8 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .case-card-block {
        background-color: transparent !important;
        border: 1px solid #cbd5e0 !important;
        padding: 12px 16px !important;
      }

      .field input, 
      .field textarea {
        border: none !important;
        border-bottom: 1px solid #000 !important;
        border-radius: 0 !important;
        padding: 2px 0 !important;
        background: transparent !important;
      }

      .other-inline-input {
        border-bottom: 1px solid #000 !important;
      }

      @page {
        size: A4 portrait;
        margin: 10mm 14mm 10mm 14mm;
      }

      .form-section-title, .sig-grid, .confidential-note {
        break-inside: avoid;
      }
    }
  </style>
</head>
<body>

  <div class="page-container">
    <!-- Action Controls -->
    <div class="action-toolbar no-print">
      <div>
        <div class="eyebrow">Case Management System</div>
        <h1>External Referral Form</h1>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-outline" onclick="genReferralNo()">
          <i class="fa-solid fa-hashtag"></i> Generate No.
        </button>
        <button type="button" class="btn btn-maroon" onclick="window.print()">
          <i class="fa-solid fa-print"></i> Print / Save PDF
        </button>
      </div>
    </div>

    <!-- Referral Document -->
    <div class="referral-sheet" id="referralSheet">
      <div class="referral-letterhead">
        <div class="logo-container">
          <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo">
        </div>
        <div class="lh-text">
          <h3>Republic of the Philippines</h3>
          <h2>Marinduque State University</h2>
          <p>Student Welfare and Development Office &middot; Guidance and Counseling Office</p>
          <div class="sub-detail">Boac, Marinduque, Philippines | Email: guidance@marsu.edu.ph</div>
        </div>
        <div class="logo-placeholder"></div>
      </div>

      <div class="referral-body">
        <div class="intro-letter">
          Dear Sir/Madam:<br>
          The Guidance and Counseling Office of Marinduque State University respectfully refers the student named below to your office for appropriate assessment and services. Initial support has been provided by our office. Your expert assistance for our student is greatly appreciated.
          <div class="sign-off">
            Very truly yours,
            <b>Emelita R. Rodelas, RGC</b>
            Director, Student Welfare and Development Office
          </div>
        </div>

        <!-- Professional Case Management Box Section -->
        <div class="case-card-block">
          <div class="form-section-title" style="margin-top: 0;"><i class="fa-solid fa-file-invoice"></i> Case Tracking & Management</div>
          <div class="form-grid">
            <div class="field"><label>Referral No.</label><input id="refNoField" value="RF-2026-042"></div>
            <div class="field"><label>Date</label><input type="date" id="refDateField"></div>
          </div>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-user-graduate"></i> I. Student Information</div>
        <div class="form-grid">
          <div class="field full"><label>Student Name</label><input placeholder="Last Name, First Name, M.I."></div>
          <div class="field"><label>Student No.</label><input placeholder="e.g. 2023-0182"></div>
          <div class="field"><label>Year &amp; Program</label><input placeholder="e.g. 3rd Year - BSIS"></div>
          <div class="field"><label>Contact Number</label><input placeholder="09XXXXXXXXX"></div>
          <div class="field"><label>Email Address</label><input type="email" placeholder="student@marsu.edu.ph"></div>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-building-circle-arrow-right"></i> II. Referred Agency / Professional</div>
        <div class="form-grid">
          <div class="field full"><label>Agency / Office Name</label><input placeholder="e.g. Provincial Health Office"></div>
          <div class="field"><label>Contact Person</label><input placeholder="Name / Position"></div>
          <div class="field"><label>Contact Info</label><input placeholder="Phone / Email"></div>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-list-check"></i> III. Purpose of Referral</div>
        <div class="check-grid">
          <label class="check-item"><input type="checkbox"> Psychological Evaluation</label>
          <label class="check-item"><input type="checkbox"> Psychiatric Consultation</label>
          <label class="check-item"><input type="checkbox"> Medical Assessment</label>
          <label class="check-item"><input type="checkbox"> Social Welfare / Financial</label>
          <label class="check-item"><input type="checkbox"> Legal Consultation</label>
          <label class="check-item"><input type="checkbox"> Crisis Intervention</label>
          <label class="check-item" style="grid-column: span 2;">
            Other: <input type="text" class="other-inline-input">
          </label>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-align-left"></i> IV. Case Summary &amp; Reason for Referral</div>
        <div class="field full">
          <textarea rows="2" placeholder="Brief relevant background and observations..."></textarea>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-hands-holding-child"></i> V. Initial Interventions Rendered</div>
        <div class="check-grid">
          <label class="check-item"><input type="checkbox"> Intake Interview</label>
          <label class="check-item"><input type="checkbox"> Psychological First Aid</label>
          <label class="check-item"><input type="checkbox"> Parent Consultation</label>
          <label class="check-item"><input type="checkbox"> Academic Faculty Liaison</label>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-triangle-exclamation"></i> VI. Priority Level</div>
        <div class="check-grid">
          <label class="check-item"><input type="radio" name="urg"> Routine</label>
          <label class="check-item"><input type="radio" name="urg"> Urgent (24–72 hrs)</label>
          <label class="check-item"><input type="radio" name="urg"> Emergency (Immediate)</label>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-signature"></i> VII. Student Consent</div>
        <p style="font-size:.75rem;color:var(--ink-700);line-height:1.4;">
          I consent to this referral and authorize the MarSU Guidance Office to share necessary information with the designated agency, compliant with RA 10173 (Data Privacy Act).
        </p>
        <div class="sig-grid">
          <div class="sig-line">Student Signature &nbsp;&nbsp;&nbsp; Date: ________</div>
          <div class="sig-line">Parent / Guardian Signature</div>
        </div>

        <div class="form-section-title"><i class="fa-solid fa-user-pen"></i> VIII. Signatures &amp; Acknowledgment</div>
        <div class="sig-grid">
          <div class="sig-line">Guidance Personnel / Counselor</div>
          <div class="sig-line">Receiving Agency Representative</div>
        </div>

        <div class="confidential-note">
          <b>Confidentiality Notice:</b> This document contains confidential information intended solely for student welfare. Handle according to RA 10173 and university regulations.
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const dateInput = document.getElementById('refDateField');
      if (dateInput && !dateInput.value) {
        dateInput.value = new Date().toISOString().split('T')[0];
      }
    });

    function genReferralNo() {
      const year = new Date().getFullYear();
      const randomNum = Math.floor(Math.random() * 900) + 100;
      document.getElementById('refNoField').value = `RF-${year}-${randomNum}`;
    }
  </script>
</body>
</html>