<?php
declare(strict_types=1);

$pageTitle = 'Asset Profile Creation & Master Registry — MarSU-SC IAMS';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="MarSU-SC IAMS — Assets Registry & Master Inventory">
  <meta name="author" content="Supply and Property Management Unit (SPMU) - Sta. Cruz Campus">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

  <!-- Vendor CSS -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Regal Imperial Burgundy & Gold Design System -->
  <link href="css/marsu-theme.css" rel="stylesheet">
  <style>
    .bulk-method-options>[class*="col-"] {
      display: flex;
    }

    .bulk-method-options>.col-12:first-child {
      order: 2;
    }

    .bulk-method-options>.col-12:last-child {
      order: 1;
    }

    .bulk-method-options .bulk-method-card {
      width: 100%;
      min-height: 104px;
      display: flex;
      align-items: center;
    }

    .bulk-method-card>.d-flex {
      width: 100%;
      min-width: 0;
      gap: 1rem;
    }

    .bulk-method-icon {
      flex: 0 0 48px;
      width: 48px;
      height: 48px;
      padding: 0 !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      line-height: 1;
    }

    .bulk-method-icon i {
      display: block;
      font-size: 1.15rem;
      line-height: 1;
    }

    .bulk-method-copy {
      min-width: 0;
      flex: 1 1 auto;
    }

    .bulk-method-title {
      min-height: 2.4em;
      line-height: 1.2;
    }

    .bulk-method-copy .small {
      line-height: 1.45;
    }

    #assetMasterTable {
      min-width: 1120px;
    }

    #assetMasterTable th,
    #assetMasterTable td {
      vertical-align: middle;
    }

    #assetMasterTable th {
      white-space: nowrap;
    }

    #assetMasterTable .asset-description-cell {
      min-width: 220px;
      max-width: 270px;
    }

    #assetMasterTable .asset-description-cell>div {
      overflow-wrap: anywhere;
      line-height: 1.35;
    }

    #assetMasterTable .asset-classification-cell {
      min-width: 112px;
      text-align: center;
      white-space: nowrap;
    }

    #assetMasterTable .asset-classification-badge {
      display: inline-block;
      min-width: 78px;
      padding: 0.4rem 0.55rem;
      font-size: 0.72rem;
    }

    #assetMasterTable .asset-number-cell,
    #assetMasterTable .asset-money-cell {
      white-space: nowrap;
    }

    #acquisitionMasterTable {
      min-width: 2200px;
      table-layout: fixed;
    }

    #acquisitionMasterTable th,
    #acquisitionMasterTable td {
      vertical-align: middle;
    }

    #acquisitionMasterTable th {
      padding: 1rem 1.1rem;
    }

    #acquisitionMasterTable td {
      padding: 1.05rem 1.1rem;
      line-height: 1.45;
    }

    #acquisitionMasterTable th:nth-child(1),
    #acquisitionMasterTable td:nth-child(1) {
      width: 270px;
    }

    #acquisitionMasterTable th:nth-child(2),
    #acquisitionMasterTable td:nth-child(2) {
      width: 300px;
    }

    #acquisitionMasterTable th:nth-child(3),
    #acquisitionMasterTable td:nth-child(3) {
      width: 165px;
    }

    #acquisitionMasterTable th:nth-child(4),
    #acquisitionMasterTable td:nth-child(4) {
      width: 260px;
    }

    #acquisitionMasterTable th:nth-child(5),
    #acquisitionMasterTable td:nth-child(5) {
      width: 170px;
    }

    #acquisitionMasterTable th:nth-child(6),
    #acquisitionMasterTable td:nth-child(6) {
      width: 235px;
    }

    #acquisitionMasterTable th:nth-child(7),
    #acquisitionMasterTable td:nth-child(7) {
      width: 145px;
    }

    #acquisitionMasterTable th:nth-child(8),
    #acquisitionMasterTable td:nth-child(8) {
      width: 165px;
    }

    #acquisitionMasterTable th:nth-child(9),
    #acquisitionMasterTable td:nth-child(9) {
      width: 165px;
    }

    #acquisitionMasterTable th:nth-child(10),
    #acquisitionMasterTable td:nth-child(10) {
      width: 160px;
    }

    #acquisitionMasterTable th:nth-child(11),
    #acquisitionMasterTable td:nth-child(11) {
      width: 165px;
    }

    #acquisitionMasterTable td:nth-child(1),
    #acquisitionMasterTable td:nth-child(3),
    #acquisitionMasterTable td:nth-child(5),
    #acquisitionMasterTable td:nth-child(7),
    #acquisitionMasterTable td:nth-child(8),
    #acquisitionMasterTable td:nth-child(9),
    #acquisitionMasterTable td:nth-child(10),
    #acquisitionMasterTable td:nth-child(11) {
      white-space: nowrap;
    }

    #acquisitionMasterTable td:nth-child(2),
    #acquisitionMasterTable td:nth-child(4) {
      overflow-wrap: anywhere;
    }

    #acquisitionMasterTable td.acq-asset-description-cell {
      padding-left: 1.5rem;
    }

    #acquisitionMasterTable td:nth-child(2)>div+div,
    #acquisitionMasterTable td:nth-child(4)>div+div {
      margin-top: 0.45rem;
    }

    #acquisitionMasterTable .acq-fund-badge,
    #acquisitionMasterTable .acq-warranty-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
      max-width: 100%;
      padding: 0.45rem 0.65rem;
      white-space: normal;
      line-height: 1.35;
      font-size: 0.82rem;
      text-align: center;
    }

    #acquisitionMasterTable .acq-fund-badge {
      color: var(--emerald-700) !important;
      background: var(--emerald-50);
      border: 1px solid rgba(19, 115, 71, 0.3);
    }

    #acquisitionMasterTable .acq-fund-badge.acq-fund-igf {
      color: #174a7e !important;
      background: #e8f2ff;
      border-color: rgba(23, 74, 126, 0.25);
    }

    #acquisitionMasterTable .acq-iar-ref {
      white-space: nowrap;
    }

    .asset-submodule-actions {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-wrap: nowrap;
      gap: 0.4rem;
      white-space: nowrap;
    }

    .asset-submodule-actions .btn {
      flex: 0 0 auto;
      margin: 0 !important;
    }

    .asset-header-toolbar-actions {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      flex-wrap: wrap;
    }

    .asset-header-toolbar-actions .btn {
      white-space: nowrap;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.82rem;
      padding: 0.42rem 0.72rem;
      line-height: 1.25;
      margin: 0 !important;
      flex: 0 0 auto;
    }

    @media (max-width: 575.98px) {
      .asset-header-toolbar-actions {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.45rem;
      }

      .asset-header-toolbar-actions .btn {
        width: 100%;
      }
    }

    @media (max-width: 380px) {
      .asset-header-toolbar-actions {
        grid-template-columns: 1fr;
      }
    }

    #assetMasterTable td:last-child,
    #pinMasterTable td:last-child,
    #classificationScheduleTable td:last-child,
    #accountabilityMasterTable td:last-child {
      white-space: nowrap;
    }

    #pinActionToolbar {
      display: flex;
      justify-content: flex-end;
      flex-wrap: nowrap;
      gap: 0.5rem;
      overflow-x: auto;
      padding-bottom: 0.15rem;
    }

    #pinActionToolbar .btn {
      flex: 0 0 auto;
      margin: 0 !important;
    }

    .pin-schema-row {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.5rem 0.75rem;
      min-width: 0;
    }

    .pin-schema-format {
      display: inline-block;
      white-space: nowrap;
      font-size: 0.82rem;
      line-height: 1.35;
    }

    .pin-search-group {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      min-height: 48px;
      padding: 0 0.85rem;
      border: 1px solid var(--border-color);
      border-radius: 0.75rem;
      background: linear-gradient(120deg, rgba(212, 175, 55, 0.08), transparent 68%), var(--bg-surface-elevated);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.035);
      transition: border-color 160ms ease, box-shadow 160ms ease, background-color 160ms ease;
    }

    .pin-search-group:hover {
      border-color: rgba(212, 175, 55, 0.55);
    }

    .pin-search-group:focus-within {
      border-color: var(--gold-500);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.16), 0 5px 16px rgba(20, 2, 6, 0.14);
    }

    .pin-search-icon {
      flex: 0 0 auto;
      color: var(--gold-400);
      font-size: 0.95rem;
    }

    .pin-search-input {
      flex: 1 1 auto;
      width: 100%;
      min-width: 0;
      padding: 0.7rem 0;
      border: 0 !important;
      outline: 0;
      background: transparent !important;
      box-shadow: none !important;
      color: var(--text-main) !important;
      font-size: 0.9rem;
    }

    .pin-search-input::placeholder {
      color: var(--text-muted);
      opacity: 0.9;
    }

    .pin-search-clear {
      flex: 0 0 auto;
      padding: 0.3rem;
      border: 0;
      background: transparent;
      color: var(--text-muted);
      line-height: 1;
      cursor: pointer;
    }

    .pin-search-clear:hover,
    .pin-search-clear:focus-visible {
      color: var(--gold-400);
      outline: none;
    }

    .pin-search-clear[hidden] {
      display: none;
    }

    .campus-certification-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      padding: 0.45rem 0.9rem 0.45rem 0.5rem;
      border: 1px solid rgba(212, 175, 55, 0.5);
      border-radius: 999px;
      background: linear-gradient(120deg, rgba(212, 175, 55, 0.15), rgba(106, 15, 39, 0.2));
      color: var(--text-main);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.06), 0 3px 12px rgba(20, 2, 6, 0.16);
      font-size: 0.76rem;
      font-weight: 700;
      letter-spacing: 0.035em;
      line-height: 1.2;
      white-space: nowrap;
    }

    .campus-certification-badge-icon {
      display: inline-flex;
      width: 1.8rem;
      height: 1.8rem;
      align-items: center;
      justify-content: center;
      flex: 0 0 auto;
      border: 1px solid rgba(212, 175, 55, 0.55);
      border-radius: 50%;
      background: rgba(212, 175, 55, 0.12);
      color: var(--gold-400);
      font-size: 0.8rem;
    }

    .asset-search-group {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      min-height: 46px;
      padding: 0 0.7rem;
      border: 1px solid rgba(212, 175, 55, 0.48);
      border-radius: 0.75rem;
      background: var(--burgundy-900);
      transition: border-color 160ms ease, box-shadow 160ms ease;
    }

    .asset-search-group:hover {
      border-color: rgba(212, 175, 55, 0.7);
    }

    .asset-search-group:focus-within {
      border-color: var(--gold-500);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.16), 0 4px 14px rgba(20, 2, 6, 0.12);
    }

    .asset-search-icon-wrap {
      display: inline-flex;
      width: 1.9rem;
      height: 1.9rem;
      align-items: center;
      justify-content: center;
      flex: 0 0 auto;
      border: 1px solid rgba(212, 175, 55, 0.38);
      border-radius: 0.55rem;
      background: rgba(212, 175, 55, 0.1);
      color: var(--gold-400);
    }

    .asset-search-input {
      flex: 1 1 auto;
      min-width: 0;
      width: 100%;
      padding: 0.65rem 0;
      border: 0 !important;
      outline: 0;
      background: transparent !important;
      box-shadow: none !important;
      color: var(--text-main) !important;
      font-size: 0.84rem;
    }

    .asset-search-input::placeholder {
      color: var(--text-muted);
      opacity: 0.9;
    }

    .asset-search-input::-webkit-search-cancel-button {
      display: none;
    }

    .asset-search-clear {
      flex: 0 0 auto;
      padding: 0.3rem;
      border: 0;
      background: transparent;
      color: var(--text-muted);
      line-height: 1;
      cursor: pointer;
    }

    .asset-search-clear:hover,
    .asset-search-clear:focus-visible {
      color: var(--gold-400);
      outline: none;
    }

    .asset-search-clear[hidden] {
      display: none;
    }

    .asset-reg-hero {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      margin-bottom: 1.25rem;
      padding: 1.5rem 1.75rem;
      border: 1px solid rgba(212, 175, 55, 0.42);
      border-radius: 16px;
      background:
        linear-gradient(90deg, rgba(20, 2, 6, 0.97) 0%, rgba(38, 5, 14, 0.9) 52%, rgba(20, 2, 6, 0.6) 100%),
        url("img/image.png") center 48% / cover no-repeat;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.28);
    }

    [data-theme="light"] .asset-reg-hero {
      border-color: rgba(184, 144, 42, 0.4);
      background:
        linear-gradient(90deg, rgba(255, 255, 255, 0.97) 0%, rgba(255, 253, 247, 0.92) 52%, rgba(255, 253, 247, 0.62) 100%),
        url("img/image.png") center 48% / cover no-repeat;
      box-shadow: 0 8px 24px rgba(38, 5, 14, 0.1);
    }

    .asset-reg-hero #submodulePageHeading {
      color: #fff !important;
    }

    .asset-reg-hero #submodulePageSubtitle {
      max-width: 780px;
      color: rgba(255, 255, 255, 0.78) !important;
      line-height: 1.55;
    }

    [data-theme="light"] .asset-reg-hero #submodulePageHeading {
      color: #26050e !important;
    }

    [data-theme="light"] .asset-reg-hero #submodulePageSubtitle {
      color: #57484d !important;
    }

    .asset-reg-hero .asset-reg-eyebrow {
      color: var(--gold-300) !important;
      letter-spacing: 0.1em;
    }

    [data-theme="light"] .asset-reg-hero .asset-reg-eyebrow {
      color: #70540c !important;
    }

    .asset-reg-hero .campus-certification-badge {
      background: rgba(20, 2, 6, 0.54);
      color: #fff;
      backdrop-filter: blur(8px);
    }

    [data-theme="light"] .asset-reg-hero .campus-certification-badge {
      background: rgba(255, 255, 255, 0.82);
      color: #26050e;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav {
      display: flex;
      flex-wrap: nowrap;
      gap: 0.45rem;
      margin: 0 0 1.5rem;
      padding: 0.45rem;
      overflow-x: auto;
      border: 1px solid var(--border-color);
      border-radius: 14px;
      background: var(--bg-surface);
      list-style: none;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
      scrollbar-width: none;
      -webkit-overflow-scrolling: touch;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav::-webkit-scrollbar {
      display: none;
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav {
      border-color: rgba(184, 144, 42, 0.28);
      background: #fff;
      box-shadow: 0 4px 16px rgba(38, 5, 14, 0.04);
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-item {
      flex: 1 0 auto;
      min-width: fit-content;
      margin: 0;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.55rem;
      padding: 0.7rem 1rem;
      border: 1px solid transparent;
      border-radius: 10px;
      background: transparent;
      color: var(--text-muted);
      font-family: var(--font-heading);
      font-size: 0.84rem;
      font-weight: 600;
      line-height: 1.2;
      text-decoration: none;
      transition: border-color 0.22s ease, background-color 0.22s ease, box-shadow 0.22s ease;
      white-space: nowrap;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link:hover,
    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link:focus-visible {
      border-color: rgba(212, 175, 55, 0.2);
      background: rgba(212, 175, 55, 0.08);
      color: var(--text-heading);
      outline: none;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link:focus-visible {
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.24);
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link.active {
      border-color: rgba(212, 175, 55, 0.5);
      background: linear-gradient(135deg, #7b1e2b 0%, #4e0b1d 100%);
      color: #fff !important;
      font-weight: 700;
      box-shadow: 0 4px 16px rgba(123, 30, 43, 0.35);
    }

    .asset-reg-tab-icon {
      display: inline-flex;
      width: 1.2rem;
      height: 1.2rem;
      align-items: center;
      justify-content: center;
      flex: 0 0 1.2rem;
      color: var(--gold-400);
      font-size: 0.92rem;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link {
      color: #57484d;
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link:hover {
      border-color: rgba(184, 144, 42, 0.3);
      background: rgba(184, 144, 42, 0.09);
      color: #1a0409;
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link i {
      color: #8a6a12;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link.active i {
      color: var(--gold-300);
      filter: drop-shadow(0 0 4px rgba(212, 175, 55, 0.6));
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link.active {
      border-color: #d4af37;
      background: linear-gradient(135deg, #7b1e2b 0%, #4e0b1d 100%);
      color: #fff !important;
      box-shadow: 0 4px 14px rgba(78, 11, 29, 0.25);
    }

    [data-theme="light"] #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link.active i {
      color: #f2dfa0;
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link:hover i {
      transform: scale(1.12);
    }

    @media (max-width: 991px) {
      #registrationSubmoduleTabs.asset-reg-submodule-nav {
        padding: 0.35rem;
      }

      #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link {
        padding: 0.6rem 0.85rem;
        font-size: 0.8rem;
      }
    }

    @media (max-width: 767.98px) {
      .bulk-method-options .bulk-method-card {
        min-height: 0;
      }

      #pinActionToolbar {
        justify-content: flex-start;
      }

      .pin-schema-row {
        row-gap: 0.6rem;
      }

      .pin-schema-format {
        font-size: 0.74rem;
      }

      .pin-search-group {
        min-height: 46px;
      }

      .asset-reg-hero {
        padding: 1.2rem;
      }
    }

    .pin-search-input::-webkit-search-cancel-button {
      display: none;
    }

    /* ================================================================
       MARSU PROPERTY & ASSET REGISTRATION — 5 SUBMODULES DESIGN SYSTEM
       High-Impact, Clean, Executive, Responsive & Light/Dark Theme Ready
       ================================================================ */

    /* Tab Pill Badges */
    .tab-pill-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.15rem 0.5rem;
      margin-left: 0.45rem;
      font-size: 0.72rem;
      font-weight: 700;
      font-family: var(--font-mono);
      border-radius: 999px;
      line-height: 1;
      background: rgba(212, 175, 55, 0.18);
      color: var(--gold-400);
      border: 1px solid rgba(212, 175, 55, 0.35);
      transition: all 0.2s ease;
    }

    [data-theme="light"] .tab-pill-badge {
      background: rgba(123, 30, 43, 0.08);
      color: #7b1e2b;
      border-color: rgba(123, 30, 43, 0.25);
    }

    #registrationSubmoduleTabs.asset-reg-submodule-nav .nav-link.active .tab-pill-badge {
      background: rgba(255, 255, 255, 0.22);
      color: #fff;
      border-color: rgba(255, 255, 255, 0.45);
    }

    /* Executive KPI Ribbon Grid */
    .asset-kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    @media (max-width: 1199.98px) {
      .asset-kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 575.98px) {
      .asset-kpi-grid {
        grid-template-columns: 1fr;
      }
    }

    .asset-kpi-card {
      position: relative;
      background: var(--bg-surface-elevated);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 1.15rem 1.25rem;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.2);
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
      overflow: hidden;
    }

    .asset-kpi-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #7b1e2b, #d4af37);
      opacity: 0.85;
    }

    .asset-kpi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(212, 175, 55, 0.15);
      border-color: rgba(212, 175, 55, 0.5);
    }

    [data-theme="light"] .asset-kpi-card {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.28);
      box-shadow: 0 4px 16px rgba(38, 5, 14, 0.05);
    }

    [data-theme="light"] .asset-kpi-card:hover {
      box-shadow: 0 8px 24px rgba(78, 11, 29, 0.12);
      border-color: rgba(184, 144, 42, 0.6);
    }

    .asset-kpi-label {
      font-size: 0.76rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--text-muted);
      font-weight: 700;
    }

    [data-theme="light"] .asset-kpi-label {
      color: #6c5b62;
    }

    .asset-kpi-value {
      font-size: 1.65rem;
      font-weight: 800;
      line-height: 1.2;
      margin: 0.35rem 0 0.25rem;
    }

    [data-theme="light"] .asset-kpi-value {
      color: #26050e;
    }

    .asset-kpi-subtext {
      font-size: 0.78rem;
      color: var(--text-muted);
      line-height: 1.4;
    }

    [data-theme="light"] .asset-kpi-subtext {
      color: #57484d;
    }

    .asset-kpi-icon {
      font-size: 1.25rem;
      width: 2.2rem;
      height: 2.2rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      background: rgba(212, 175, 55, 0.12);
    }

    [data-theme="light"] .asset-kpi-icon {
      background: rgba(123, 30, 43, 0.08);
    }

    /* Fast Category Filter Chips */
    .asset-chip-group {
      display: flex;
      flex-wrap: nowrap;
      gap: 0.45rem;
      overflow-x: auto;
      padding: 0.2rem 0 0.6rem;
      scrollbar-width: thin;
      -webkit-overflow-scrolling: touch;
    }

    .asset-chip-group::-webkit-scrollbar {
      height: 4px;
    }

    .asset-chip-group::-webkit-scrollbar-thumb {
      background: rgba(212, 175, 55, 0.3);
      border-radius: 4px;
    }

    .asset-chip {
      display: inline-flex;
      align-items: center;
      white-space: nowrap;
      padding: 0.42rem 0.85rem;
      font-size: 0.8rem;
      font-weight: 600;
      border-radius: 20px;
      border: 1px solid var(--border-color);
      background: var(--bg-surface-elevated);
      color: var(--text-main);
      cursor: pointer;
      transition: all 0.2s ease;
      line-height: 1.2;
    }

    .asset-chip:hover {
      border-color: rgba(212, 175, 55, 0.55);
      background: rgba(212, 175, 55, 0.1);
      transform: translateY(-1px);
    }

    .asset-chip.active {
      background: linear-gradient(135deg, #7b1e2b 0%, #4e0b1d 100%);
      color: #ffffff !important;
      border-color: #d4af37;
      box-shadow: 0 4px 12px rgba(123, 30, 43, 0.35);
    }

    [data-theme="light"] .asset-chip {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.32);
      color: #380814;
    }

    [data-theme="light"] .asset-chip:hover {
      background: rgba(184, 144, 42, 0.1);
      border-color: #b8902a;
    }

    [data-theme="light"] .asset-chip.active {
      background: linear-gradient(135deg, #7b1e2b 0%, #4e0b1d 100%);
      color: #ffffff !important;
      border-color: #b8902a;
      box-shadow: 0 4px 12px rgba(78, 11, 29, 0.22);
    }

    /* PIN Schema Architecture Blocks */
    .pin-schema-blocks-container {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.5rem;
      padding: 1rem;
      background: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: 10px;
    }

    [data-theme="light"] .pin-schema-blocks-container {
      background: #faf7f2;
      border-color: rgba(184, 144, 42, 0.22);
    }

    .pin-schema-block {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0.5rem 0.9rem;
      border-radius: 8px;
      background: var(--bg-surface-elevated);
      border: 1px solid var(--border-color);
      min-width: 82px;
      text-align: center;
      transition: all 0.2s ease;
    }

    .pin-schema-block.active-block {
      border-color: var(--gold-500);
      background: rgba(212, 175, 55, 0.12);
      box-shadow: 0 0 14px rgba(212, 175, 55, 0.25);
    }

    [data-theme="light"] .pin-schema-block {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.28);
    }

    [data-theme="light"] .pin-schema-block.active-block {
      background: rgba(212, 175, 55, 0.14);
      border-color: #b8902a;
    }

    .pin-schema-segment-tag {
      font-size: 0.65rem;
      text-transform: uppercase;
      font-weight: 700;
      letter-spacing: 0.05em;
      color: var(--text-muted);
    }

    .pin-schema-segment-val {
      font-family: var(--font-mono);
      font-size: 1.05rem;
      font-weight: 800;
      color: var(--text-heading);
      margin: 0.15rem 0;
    }

    [data-theme="light"] .pin-schema-segment-val {
      color: #26050e;
    }

    .pin-schema-segment-desc {
      font-size: 0.68rem;
      color: var(--text-muted);
    }

    .pin-schema-separator {
      font-family: var(--font-mono);
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--gold-500);
    }

    /* Sandbox Sticker Preview Box */
    .sandbox-sticker-preview {
      background: #ffffff;
      color: #140206;
      border: 2px solid #7b1e2b;
      border-radius: 10px;
      padding: 0.85rem 1rem;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
      position: relative;
    }

    .sandbox-sticker-preview .sticker-univ-title {
      font-size: 0.78rem;
      font-weight: 800;
      color: #7b1e2b;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .sandbox-sticker-preview .sticker-badge-coa {
      font-size: 0.65rem;
      font-weight: 700;
      background: #7b1e2b;
      color: #fff;
      padding: 0.1rem 0.4rem;
      border-radius: 4px;
    }

    .sandbox-sticker-preview .sticker-sub-title {
      font-size: 0.68rem;
      color: #555;
      font-weight: 600;
    }

    .sandbox-sticker-preview .sticker-pin-code {
      font-size: 0.95rem;
      font-weight: 800;
      color: #7b1e2b;
    }

    .sandbox-sticker-preview .sticker-desc-text {
      font-size: 0.74rem;
      color: #222;
      line-height: 1.25;
      max-height: 2.5em;
      overflow: hidden;
      margin: 0.2rem 0;
    }

    .sandbox-sticker-preview .sticker-footer-note {
      font-size: 0.62rem;
      color: #666;
      border-top: 1px dashed #ccc;
      padding-top: 0.35rem;
      text-align: center;
      letter-spacing: 0.05em;
      font-weight: 700;
    }

    /* COA GAM Tier Cards */
    .classification-tier-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.25rem;
    }

    @media (max-width: 991.98px) {
      .classification-tier-grid {
        grid-template-columns: 1fr;
      }
    }

    .coa-tier-card {
      border-radius: 12px;
      padding: 1.35rem;
      background: var(--bg-surface-elevated);
      border: 1px solid var(--border-color);
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.2);
      transition: all 0.22s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .coa-tier-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(212, 175, 55, 0.18);
    }

    [data-theme="light"] .coa-tier-card {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.3);
      box-shadow: 0 4px 16px rgba(38, 5, 14, 0.06);
    }

    .tier-progress-track {
      height: 6px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.08);
      overflow: hidden;
      margin: 0.6rem 0 0.8rem;
    }

    [data-theme="light"] .tier-progress-track {
      background: rgba(38, 5, 14, 0.08);
    }

    .tier-progress-fill {
      height: 100%;
      border-radius: 999px;
      transition: width 0.6s ease;
    }

    .fill-gold {
      background: linear-gradient(90deg, #b8902a, #d4af37);
    }

    .fill-emerald {
      background: linear-gradient(90deg, #137347, #2fae72);
    }

    .fill-blue {
      background: linear-gradient(90deg, #2b5cb7, #36b9cc);
    }

    /* Depreciation Calculator Widget */
    .deprec-calc-widget {
      background: var(--bg-surface-elevated);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 1.25rem 1.5rem;
      margin-bottom: 1.5rem;
    }

    [data-theme="light"] .deprec-calc-widget {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.32);
      box-shadow: 0 4px 18px rgba(38, 5, 14, 0.05);
    }

    .calc-stat-pill {
      background: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: 8px;
      padding: 0.75rem 1rem;
      text-align: center;
    }

    [data-theme="light"] .calc-stat-pill {
      background: #faf7f2;
      border-color: rgba(184, 144, 42, 0.22);
    }

    /* Fund Cluster Progress Bar */
    .fund-cluster-bar-track {
      height: 14px;
      border-radius: 999px;
      display: flex;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.1);
      margin: 0.75rem 0 0.5rem;
    }

    [data-theme="light"] .fund-cluster-bar-track {
      background: rgba(38, 5, 14, 0.08);
    }

    .fund-fill-raf {
      background: linear-gradient(90deg, #137347, #2fae72);
      height: 100%;
    }

    .fund-fill-igf {
      background: linear-gradient(90deg, #2b5cb7, #36b9cc);
      height: 100%;
    }

    /* Custody Department Unit Cards */
    .custody-unit-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 0.85rem;
      margin-bottom: 1.25rem;
    }

    @media (max-width: 1199.98px) {
      .custody-unit-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 767.98px) {
      .custody-unit-grid {
        grid-template-columns: 1fr;
      }
    }

    .custody-unit-card {
      background: var(--bg-surface-elevated);
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 0.9rem;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .custody-unit-card:hover {
      border-color: var(--gold-500);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(212, 175, 55, 0.18);
    }

    [data-theme="light"] .custody-unit-card {
      background: #ffffff;
      border-color: rgba(184, 144, 42, 0.28);
      box-shadow: 0 2px 10px rgba(38, 5, 14, 0.04);
    }

    [data-theme="light"] .custody-unit-card:hover {
      border-color: #b8902a;
      box-shadow: 0 6px 18px rgba(78, 11, 29, 0.12);
    }

    .custody-avatar-circle {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #7b1e2b, #4e0b1d);
      color: var(--gold-300);
      font-weight: 700;
      font-size: 0.78rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 0.5rem;
      border: 1px solid var(--gold-500);
    }

    /* Master Table Alignment & Typography */
    .table-marsu th {
      font-size: 0.78rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      white-space: nowrap;
      vertical-align: middle;
    }

    [data-theme="light"] .table-marsu th {
      color: #26050e !important;
      background: #fdfaf5 !important;
      border-color: rgba(184, 144, 42, 0.28) !important;
    }

    [data-theme="light"] .table-marsu td {
      color: #1d0f13 !important;
      border-color: rgba(184, 144, 42, 0.15) !important;
    }

    [data-theme="light"] .table-marsu tbody tr:hover {
      background: rgba(123, 30, 43, 0.04) !important;
    }
  </style>
</head>
<body id="page-top">
  <main class="container-fluid py-4">

        <div class="container-fluid">
          <!-- Page Header -->
          <div class="asset-reg-hero d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <div>
              <div class="asset-reg-eyebrow text-uppercase font-weight-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em; color: var(--gold-400);"><i class="fas fa-boxes mr-1"></i>PROPERTY & ASSET REGISTRATION • SUB-MODULE 1</div>
              <h1 class="h3 font-weight-bold mb-1" id="submodulePageHeading" style="color: var(--text-heading);">Asset Profile Creation &amp; Master Registry</h1>
              <p class="small text-muted mb-0" id="submodulePageSubtitle">Comprehensive lifecycle records, technical specifications, and live status tracking for all institutional assets.</p>
            </div>
            <div class="mt-3 mt-md-0 d-flex align-items-center">
              <span class="campus-certification-badge">
                <span class="campus-certification-badge-icon"><i class="fas fa-university"
                    aria-hidden="true"></i></span>
                <span>Sta. Cruz Campus Certified</span>
              </span>
            </div>
          </div>


          <!-- Sub-modules Tab Panes Content -->
          <div class="tab-content" id="registrationTabContent">
            <!-- ========================================== -->
            <!-- PANE 1: ASSET PROFILE CREATION & MASTER REGISTRY -->
            <!-- ========================================== -->
            <section class="tab-pane fade show active" id="pane-profile" role="region" aria-label="Asset Profile Creation">

              <!-- Executive Command KPI Ribbon -->
              <div class="asset-kpi-grid mb-4">
                <div class="asset-kpi-card">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="asset-kpi-label">Total Registered Assets</span>
                    <span class="asset-kpi-icon text-gold"><i class="fas fa-boxes"></i></span>
                  </div>
                  <div class="asset-kpi-value text-gold font-mono" id="profileKpiTotal">130</div>
                  <div class="asset-kpi-subtext">
                    <span class="text-success"><i class="fas fa-check-circle mr-1"></i>100%</span> Sta. Cruz Campus
                    Cataloged
                  </div>
                </div>
                <div class="asset-kpi-card">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="asset-kpi-label">Total Capital Outlay</span>
                    <span class="asset-kpi-icon text-primary"><i class="fas fa-coins"></i></span>
                  </div>
                  <div class="asset-kpi-value font-mono" id="profileKpiOutlay" style="color: var(--text-heading);">
                    ₱10,740,170.00</div>
                  <div class="asset-kpi-subtext">
                    Current Net Book: <span class="text-gold font-mono font-weight-bold"
                      id="profileKpiNetBook">₱7,892,450.00</span>
                  </div>
                </div>
                <div class="asset-kpi-card">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="asset-kpi-label">Serviceable Condition</span>
                    <span class="asset-kpi-icon text-success"><i class="fas fa-shield-alt"></i></span>
                  </div>
                  <div class="asset-kpi-value text-success font-mono" id="profileKpiServiceable">94.6%</div>
                  <div class="asset-kpi-subtext">
                    <span class="font-mono font-weight-bold text-success">123</span> Active &bull; <span
                      class="text-warning font-mono font-weight-bold">7</span> In Maintenance
                  </div>
                </div>
                <div class="asset-kpi-card">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="asset-kpi-label">Custody Verification</span>
                    <span class="asset-kpi-icon text-info"><i class="fas fa-user-check"></i></span>
                  </div>
                  <div class="asset-kpi-value text-info font-mono" id="profileKpiCustody">100.0%</div>
                  <div class="asset-kpi-subtext">
                    <span class="text-success font-weight-bold">Zero</span> Unassigned / Floating Assets
                  </div>
                </div>
              </div>

              <!-- Profile Creation Action Toolbar -->
              <div
                class="card-marsu p-3 mb-3 d-flex flex-column flex-lg-row justify-content-between align-items-lg-center"
                style="background: var(--bg-surface-elevated); border: 1px solid var(--border-color);">
                <div class="mb-2 mb-lg-0 mr-lg-3">
                  <div class="font-weight-bold" style="color: var(--text-heading); font-size: 0.95rem;">
                    <i class="fas fa-boxes text-gold mr-2" aria-hidden="true"></i><span>Asset Registration &amp; Master
                      Intake</span>
                  </div>
                  <div class="small text-muted">Register singular property items or execute bulk multi-unit batch
                    registration.</div>
                </div>
                <div class="asset-header-toolbar-actions">
                  <button class="btn btn-marsu-gold btn-shimmer" data-toggle="modal" data-target="#newAssetModal"
                    onclick="window.switchIntakeMode('single')" title="Register New Asset">
                    <i class="fas fa-plus-circle mr-1"></i>Register Asset
                  </button>
                  <button type="button" class="btn btn-marsu-outline" data-toggle="modal" data-target="#newAssetModal"
                    onclick="window.switchIntakeMode('batch')" title="Bulk Add Assets">
                    <i class="fas fa-layer-group text-gold mr-1" aria-hidden="true"></i>Bulk Add
                  </button>
                  <button class="btn btn-marsu-outline" onclick="window.exportAssetsToCSV()"
                    title="Export CSV Spreadsheet">
                    <i class="fas fa-file-csv text-success mr-1"></i>Export CSV
                  </button>
                  <button class="btn btn-marsu-outline" onclick="window.printMasterRegistrySheet()"
                    title="Print GAM Appendix 58 Registry">
                    <i class="fas fa-print text-gold mr-1"></i>Print GAM 58
                  </button>
                </div>
              </div>

              <!-- Fast Category Filter Chips -->
              <div class="asset-chip-group mb-3" id="profileCategoryChips">
                <button class="asset-chip active" data-filter="ALL" onclick="window.setCategoryChipFilter('ALL', this)">
                  <i class="fas fa-layer-group mr-1.5"></i>All Records <span class="badge badge-pill badge-light ml-1"
                    id="chipCountAll">130</span>
                </button>
                <button class="asset-chip" data-filter="PPE" onclick="window.setCategoryChipFilter('PPE', this)">
                  <i class="fas fa-cube mr-1.5 text-gold"></i>Capitalized PPE (≥₱50k) <span
                    class="badge badge-pill badge-light ml-1" id="chipCountPPE">78</span>
                </button>
                <button class="asset-chip" data-filter="SEMI" onclick="window.setCategoryChipFilter('SEMI', this)">
                  <i class="fas fa-tags mr-1.5 text-success"></i>Semi-Expendable (&lt;₱50k) <span
                    class="badge badge-pill badge-light ml-1" id="chipCountSemi">52</span>
                </button>
                <button class="asset-chip" data-filter="IT" onclick="window.setCategoryChipFilter('IT', this)">
                  <i class="fas fa-laptop mr-1.5"></i>IT &amp; Computing <span
                    class="badge badge-pill badge-light ml-1">52</span>
                </button>
                <button class="asset-chip" data-filter="OFF" onclick="window.setCategoryChipFilter('OFF', this)">
                  <i class="fas fa-print mr-1.5"></i>Office Equip <span
                    class="badge badge-pill badge-light ml-1">28</span>
                </button>
                <button class="asset-chip" data-filter="AC" onclick="window.setCategoryChipFilter('AC', this)">
                  <i class="fas fa-fan mr-1.5"></i>Air Conditioning <span
                    class="badge badge-pill badge-light ml-1">16</span>
                </button>
                <button class="asset-chip" data-filter="REPAIR" onclick="window.setCategoryChipFilter('REPAIR', this)">
                  <i class="fas fa-wrench mr-1.5 text-warning"></i>Needs Attention <span
                    class="badge badge-pill badge-warning ml-1">7</span>
                </button>
              </div>

              <!-- Filter Toolbar Card -->
              <div class="card-marsu p-3 mb-4">
                <div class="row align-items-center">
                  <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                    <div class="asset-search-group">
                      <span class="asset-search-icon-wrap"><i class="fas fa-search" aria-hidden="true"></i></span>
                      <input type="search" id="assetSearchInput" class="asset-search-input"
                        aria-label="Search assets by property number, serial number, or brand"
                        placeholder="Search property no, SN, brand, model...">
                      <button type="button" id="assetSearchClear" class="asset-search-clear"
                        aria-label="Clear asset search" title="Clear search" hidden>
                        <i class="fas fa-times" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                    <select id="filterCategory" class="form-control"
                      style="background: var(--bg-surface); border-color: var(--border-color); color: var(--text-main);">
                      <option value="ALL">All Categories</option>
                      <option value="IT">IT &amp; Computing</option>
                      <option value="OFF">Office Equipment</option>
                      <option value="AC">Air Conditioning / HVAC</option>
                      <option value="Semi-Expendable">Semi-Expendable</option>
                      <option value="Heavy Equipment">Heavy Equipment</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                    <select id="filterBuilding" class="form-control"
                      style="background: var(--bg-surface); border-color: var(--border-color); color: var(--text-main);">
                      <option value="ALL">All Buildings</option>
                      <option value="BLD-ADM">BLD-ADM (Administration)</option>
                      <option value="BLD-IS">BLD-IS (Information Systems)</option>
                      <option value="BLD-EDU">BLD-EDU (Education Building)</option>
                      <option value="BLD-SCI">BLD-SCI (Science Research)</option>
                      <option value="BLD-LIB">BLD-LIB (Campus Library)</option>
                      <option value="BLD-GYM">BLD-GYM (Gymnasium Complex)</option>
                      <option value="BLD-GSD">BLD-GSD (General Services)</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                    <select id="filterCondition" class="form-control"
                      style="background: var(--bg-surface); border-color: var(--border-color); color: var(--text-main);">
                      <option value="ALL">All Conditions</option>
                      <option value="Serviceable">Serviceable</option>
                      <option value="Needs Repair">Needs Repair</option>
                      <option value="Under Repair">Under Repair</option>
                      <option value="Unserviceable">Unserviceable</option>
                    </select>
                  </div>
                  <div
                    class="col-lg-3 col-md-12 text-lg-right d-flex align-items-center justify-content-lg-end mt-2 mt-lg-0">
                    <div class="mr-3">
                      <span class="small text-muted mr-1">Showing:</span>
                      <strong id="filteredCountBadge" class="text-gold font-mono" style="font-size: 1.1rem;">0</strong>
                      <span class="small text-muted">/ <span id="totalCountBadge">0</span> Assets</span>
                    </div>
                    <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="Reset all filters"
                      onclick="window.resetAssetFilters()">
                      <i class="fas fa-undo-alt text-gold"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Main Asset Data Table Card -->
              <div class="card-marsu mb-4">
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table-marsu mb-0" id="assetMasterTable">
                      <thead>
                        <tr>
                          <th>Property No / QR</th>
                          <th>Inventory Item / Control</th>
                          <th>Asset Description</th>
                          <th>Classification</th>
                          <th>Acquisition Cost</th>
                          <th>Net Book Value</th>
                          <th>Location / Room</th>
                          <th>Custodian &amp; Office</th>
                          <th>Condition</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody id="assetTableBody">
                        <!-- Populated by JS -->
                      </tbody>
                    </table>
                  </div>
                </div>
                <div
                  class="card-footer py-2 px-3 d-flex flex-column flex-md-row justify-content-between align-items-center"
                  style="background: transparent; border-top: 1px solid var(--border-color); gap: 0.5rem;">
                  <span class="small text-muted text-center text-md-left">All assets are permanently tied to
                    <strong>Sta. Cruz Campus</strong>.
                    Sequences reset annually with zero duplicate tolerance.</span>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-marsu-outline" id="prevPageBtn"><i
                        class="fas fa-chevron-left mr-1"></i>Prev</button>
                    <button class="btn btn-marsu-outline active font-weight-bold" id="pageNumberDisplay">Page 1</button>
                    <button class="btn btn-marsu-outline" id="nextPageBtn">Next<i
                        class="fas fa-chevron-right ml-1"></i></button>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
    <footer class="sticky-footer mt-4" style="background-color: var(--bg-surface); border-top: 1px solid var(--border-color);">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span class="small text-muted">&copy; 2026 Marinduque State University — Sta. Cruz Campus.</span>
        </div>
      </div>
    </footer>
  </main>
  <!-- Multi-Step Register New Asset Modal (Single & Bulk/Batch Intake Wizard) -->
  <div class="modal fade" id="newAssetModal" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 900px; margin: 1.75rem auto;">
      <div class="modal-content card-marsu"
        style="border: 2px solid var(--gold-500); background-color: var(--bg-surface-elevated); box-shadow: 0 12px 50px rgba(0,0,0,0.6); max-height: 90vh; display: flex; flex-direction: column; overflow: hidden;">

        <!-- Modal Header -->
        <div class="modal-header py-3 px-4 flex-shrink-0" style="background: var(--grad-burgundy); color: #fff;">
          <div>
            <div class="small font-weight-bold text-gold-light text-uppercase d-flex align-items-center">
              <i class="fas fa-boxes mr-1 text-gold"></i>SPMU Asset Intake Wizard &bull; Sta. Cruz Campus
            </div>
            <h5 class="modal-title font-weight-bold text-white mb-0" id="wizardModalTitle">Register Campus Property
              &amp; Equipment</h5>
          </div>
          <div class="d-flex align-items-center">
            <span class="badge badge-pill mr-3 d-none d-sm-inline-flex align-items-center py-1 px-3"
              style="background: rgba(212,175,55,0.18); border: 1px solid var(--gold-500); color: var(--gold-300); font-family: var(--font-mono); font-size: 0.75rem;">
              <i class="fas fa-barcode mr-1 text-gold"></i>Next: <span
                id="wizardNextControlNo">MarSU-STC-IT-2026-00131</span>
            </span>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>
        </div>

        <form id="newAssetForm" onsubmit="return false;"
          style="display: flex; flex-direction: column; flex: 1 1 auto; min-height: 0; margin-bottom: 0; overflow: hidden;">
          <div class="modal-body p-4"
            style="overflow-y: auto; flex: 1 1 auto; min-height: 0; max-height: calc(90vh - 145px); -webkit-overflow-scrolling: touch;">

            <!-- Single-asset intake mode & locked campus notice -->
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-3 pb-3"
              style="border-bottom: 1px solid var(--border-subtle); gap: 10px;">
              <div class="font-weight-bold text-gold">
                <i class="fas fa-cube mr-1" aria-hidden="true"></i>Single Asset Registration
              </div>
              <div class="small text-muted d-flex align-items-center">
                <i class="fas fa-lock text-gold mr-1"></i>
                <span>Registration campus: <strong>Sta. Cruz Campus</strong>. Property numbers are assigned when you
                  save.</span>
              </div>
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 1: SINGLE ASSET INTAKE                          -->
            <!-- ======================================================== -->
            <div id="singleAssetSection">
              <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-start" role="note">
                <i class="fas fa-info-circle mt-1 mr-2" aria-hidden="true"></i>
                <div><strong>Before you begin:</strong> Enter the asset details from its receipt or supporting
                  documents. Check the item description, category, acquisition cost, and assigned room before saving.
                </div>
              </div>

              <!-- Classification & Category Row -->
              <div class="form-row">
                <div class="form-group col-12 col-md-6">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-tag text-gold mr-1"></i>Classification
                  </label>
                  <select id="modalClassification" class="form-control" required onchange="handleCostValidation()">
                    <option value="Property, Plant & Equipment (PPE)">Property, Plant &amp; Equipment (PPE) &mdash; &ge;
                      ₱50k (PAR)</option>
                    <option value="Semi-Expendable Property">Semi-Expendable Property (SEP) &mdash; &lt; ₱50k (ICS)
                    </option>
                  </select>
                </div>
                <div class="form-group col-12 col-md-6">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-sitemap text-gold mr-1"></i>Category
                  </label>
                  <select id="modalCategory" class="form-control" required onchange="window.updateWizardPreview()">
                    <option value="IT">IT &amp; Computing Infrastructure</option>
                    <option value="OFF">Office Equipment &amp; Furniture</option>
                    <option value="AC">Air Conditioning &amp; HVAC</option>
                    <option value="SCI">Science &amp; Laboratory Apparatus</option>
                    <option value="VEH">Motor Vehicle &amp; Transport</option>
                    <option value="MED">Health &amp; Medical Clinical Facility</option>
                    <option value="ATH">Athletic, Sports &amp; Gym Equipment</option>
                  </select>
                </div>
              </div>

              <!-- Full Item Description -->
              <div class="form-group">
                <label class="small font-weight-bold text-uppercase">
                  <i class="fas fa-file-alt text-gold mr-1"></i>Full Item Description
                </label>
                <input type="text" id="modalDescription" class="form-control"
                  placeholder="e.g. Dell Latitude 5440 Core i7-1365U 16GB RAM 512GB SSD 14-inch Laptop" required>
              </div>

              <!-- Brand, Model, Serial Number -->
              <div class="form-row">
                <div class="form-group col-12 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-trademark text-gold mr-1"></i>Brand
                  </label>
                  <input type="text" id="modalBrand" list="brandDatalist" class="form-control"
                    placeholder="Select or type brand (e.g. Dell)">
                  <datalist id="brandDatalist">
                    <option value="Dell"></option>
                    <option value="Lenovo"></option>
                    <option value="HP"></option>
                    <option value="Acer"></option>
                    <option value="Asus"></option>
                    <option value="Apple"></option>
                    <option value="Epson"></option>
                    <option value="Brother"></option>
                    <option value="Canon"></option>
                    <option value="Samsung"></option>
                    <option value="LG"></option>
                    <option value="Sony"></option>
                    <option value="Daikin"></option>
                    <option value="Carrier"></option>
                    <option value="Panasonic"></option>
                    <option value="Sharp"></option>
                    <option value="Logitech"></option>
                    <option value="Cisco"></option>
                    <option value="APC"></option>
                    <option value="Huawei"></option>
                  </datalist>
                </div>
                <div class="form-group col-12 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-laptop text-gold mr-1"></i>Model
                  </label>
                  <input type="text" id="modalModel" class="form-control" placeholder="e.g. Latitude 5440">
                </div>
                <div class="form-group col-12 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-barcode text-gold mr-1"></i>Serial Number
                  </label>
                  <input type="text" id="modalSerial" class="form-control" placeholder="e.g. SN-882910-K">
                </div>
              </div>

              <!-- Cost, Date, and Fund Cluster -->
              <div class="form-row">
                <div class="form-group col-12 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-money-bill-wave text-gold mr-1"></i>Acquisition Cost (₱)
                  </label>
                  <input type="number" step="0.01" id="modalCost" class="form-control font-mono" placeholder="0.00"
                    required oninput="handleCostValidation()">
                  <div id="costValidationNotice" class="small mt-1" style="display: none;"></div>
                </div>
                <div class="form-group col-12 col-sm-6 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-calendar-alt text-gold mr-1"></i>Acquisition Date
                  </label>
                  <input type="date" id="modalAcqDate" class="form-control" required>
                </div>
                <div class="form-group col-12 col-sm-6 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-hand-holding-usd text-gold mr-1"></i>Fund Cluster
                  </label>
                  <select id="modalFundCluster" class="form-control">
                    <option value="01 - Regular Agency Fund">01 Regular Agency Fund</option>
                    <option value="05 - Internally Generated Funds">05 Internally Generated Funds</option>
                    <option value="06 - Business Related Funds">06 Business Related Funds</option>
                    <option value="07 - Trust Receipts">07 Trust Receipts</option>
                  </select>
                </div>
              </div>

              <!-- Location & Custodian Cascading Dropdowns -->
              <div class="form-row">
                <div class="form-group col-12 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-building text-gold mr-1"></i>Building
                  </label>
                  <select id="modalBuilding" class="form-control" required onchange="window.onBuildingChange()">
                    <!-- Populated dynamically via marSUDb.getBuildings() -->
                  </select>
                </div>
                <div class="form-group col-12 col-sm-6 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-door-open text-gold mr-1"></i>Room / Specific Space
                  </label>
                  <select id="modalRoom" class="form-control" required onchange="window.onRoomChange()">
                    <!-- Cascades based on building -->
                  </select>
                  <div id="modalCustomRoomContainer" class="mt-2" style="display: none;">
                    <input type="text" id="modalCustomRoom" class="form-control form-control-sm"
                      placeholder="Enter custom room / space name...">
                  </div>
                </div>
                <div class="form-group col-12 col-sm-6 col-md-4">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-user-check text-gold mr-1"></i>Accountable Custodian
                  </label>
                  <select id="modalCustodian" class="form-control" required onchange="window.onCustodianChange()">
                    <!-- Populated dynamically from users & department heads -->
                  </select>
                  <div id="modalCustomCustodianContainer" class="mt-2" style="display: none;">
                    <input type="text" id="modalCustomCustodian" class="form-control form-control-sm"
                      placeholder="Enter personnel name...">
                  </div>
                </div>
              </div>

              <!-- Condition & Notes -->
              <div class="form-row">
                <div class="form-group col-12 col-md-6">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-heartbeat text-gold mr-1"></i>Operational Condition
                  </label>
                  <select id="modalCondition" class="form-control">
                    <option value="Serviceable">Serviceable &mdash; Brand New / Ready for Deployment</option>
                    <option value="Serviceable">Serviceable &mdash; Operational / Verified In-Place</option>
                    <option value="Serviceable">Under Acceptance &amp; Commissioning Inspection</option>
                  </select>
                </div>
                <div class="form-group col-12 col-md-6">
                  <label class="small font-weight-bold text-uppercase">
                    <i class="fas fa-sticky-note text-gold mr-1"></i>Reference / PO Notes
                  </label>
                  <input type="text" id="modalNotes" class="form-control"
                    placeholder="e.g. Procured under FY2026 CAPEX / Delivery Receipt #2026-092">
                </div>
              </div>
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 2: BULK ASSET INTAKE                            -->
            <!-- ======================================================== -->
            <div id="bulkIntakeSection" style="display: none;">

              <!-- Sub-Method Switcher Cards -->
              <div class="row mb-3 bulk-method-options">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                  <div class="bulk-method-card p-3 rounded" id="cardMethodClone"
                    onclick="window.switchBulkSubMethod('clone')"
                    style="cursor: pointer; border: 1px solid var(--border-color); background: var(--bg-surface); transition: all 0.2s ease;">
                    <div class="d-flex align-items-center">
                      <div class="bulk-method-icon"
                        style="background: rgba(255,255,255,0.06); color: var(--text-muted);">
                        <i class="fas fa-copy" aria-hidden="true"></i>
                      </div>
                      <div class="bulk-method-copy">
                        <div class="bulk-method-title font-weight-bold" id="cardMethodCloneTitle"
                          style="font-size: 0.95rem; color: var(--text-heading);">Same item, multiple units</div>
                        <div class="small text-muted">Use one description and enter how many identical units you have.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="bulk-method-card active p-3 rounded" id="cardMethodTable"
                    onclick="window.switchBulkSubMethod('table')"
                    style="cursor: pointer; border: 2px solid var(--gold-500); background: rgba(212,175,55,0.12); transition: all 0.2s ease;">
                    <div class="d-flex align-items-center">
                      <div class="bulk-method-icon" style="background: rgba(212,175,55,0.25); color: var(--gold-300);"
                        id="cardMethodTableIconWrap">
                        <i class="fas fa-table" aria-hidden="true"></i>
                      </div>
                      <div class="bulk-method-copy">
                        <div class="bulk-method-title font-weight-bold text-gold" id="cardMethodTableTitle"
                          style="font-size: 0.95rem;">Different items (Recommended)</div>
                        <div class="small text-muted">Add a separate row for each kind of asset, with its own quantity
                          and unit cost.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ------------------------------------------------------ -->
              <!-- SUB-METHOD: CLONE IDENTICAL UNITS                     -->
              <!-- ------------------------------------------------------ -->
              <div id="bulkCloneContainer">
                <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center"
                  style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.3); color: #93c5fd; font-size: 0.84rem;">
                  <i class="fas fa-info-circle mr-2 fa-lg"></i>
                  <div><strong>How bulk registration works:</strong> Enter the shared details and quantity. The system
                    previews each asset and assigns property numbers when you save.</div>
                </div>

                <!-- Item Description, Category, Brand, Model -->
                <div class="form-row">
                  <div class="form-group col-12 col-md-5">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-file-alt text-gold mr-1"></i>Item Description
                    </label>
                    <input type="text" id="bulkCloneDescription" class="form-control"
                      placeholder="e.g. Dell Latitude 5440 Core i7 Laptop"
                      value="Dell Latitude 5440 Core i7-1365U 16GB RAM 512GB SSD 14-inch Laptop"
                      oninput="window.updateClonePreview()">
                  </div>
                  <div class="form-group col-12 col-sm-6 col-md-3">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-sitemap text-gold mr-1"></i>Category
                    </label>
                    <select id="bulkCloneCategory" class="form-control" onchange="window.updateClonePreview()">
                      <option value="IT" selected>IT &amp; Computing</option>
                      <option value="OFF">Office Furniture</option>
                      <option value="AC">Aircon &amp; HVAC</option>
                      <option value="SCI">Science &amp; Lab</option>
                      <option value="VEH">Motor Vehicle</option>
                      <option value="MED">Clinical / Medical</option>
                      <option value="ATH">Sports &amp; Athletics</option>
                    </select>
                  </div>
                  <div class="form-group col-6 col-md-2">
                    <label class="small font-weight-bold text-uppercase">Brand</label>
                    <input type="text" id="bulkCloneBrand" class="form-control" placeholder="Dell" value="Dell"
                      oninput="window.updateClonePreview()">
                  </div>
                  <div class="form-group col-6 col-md-2">
                    <label class="small font-weight-bold text-uppercase">Model</label>
                    <input type="text" id="bulkCloneModel" class="form-control" placeholder="Latitude 5440"
                      value="Latitude 5440" oninput="window.updateClonePreview()">
                  </div>
                </div>

                <!-- Unit Cost, Date, Fund -->
                <div class="form-row">
                  <div class="form-group col-12 col-md-4">
                    <label class="small font-weight-bold text-uppercase text-gold">
                      <i class="fas fa-money-bill-wave mr-1"></i>Unit Cost (₱)
                    </label>
                    <input type="number" step="0.01" id="bulkCloneCost" class="form-control font-mono font-weight-bold"
                      placeholder="0.00" value="58500.00" oninput="window.updateClonePreview()">
                  </div>
                  <div class="form-group col-12 col-sm-6 col-md-4">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-calendar-alt text-gold mr-1"></i>Acquisition Date
                    </label>
                    <input type="date" id="bulkCloneDate" class="form-control">
                  </div>
                  <div class="form-group col-12 col-sm-6 col-md-4">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-hand-holding-usd text-gold mr-1"></i>Fund Cluster
                    </label>
                    <select id="bulkCloneFund" class="form-control">
                      <option value="01 - Regular Agency Fund">01 Regular Agency Fund</option>
                      <option value="05 - Internally Generated Funds">05 Internally Generated Funds</option>
                      <option value="06 - Business Related Funds">06 Business Related Funds</option>
                      <option value="07 - Trust Receipts">07 Trust Receipts</option>
                    </select>
                  </div>
                </div>

                <!-- Destination Location & Custodian -->
                <div class="form-row">
                  <div class="form-group col-12 col-md-4">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-building text-gold mr-1"></i>Destination Building
                    </label>
                    <select id="bulkCloneBuilding" class="form-control" onchange="window.onCloneBuildingChange()">
                      <!-- Populated via marSUDb.getBuildings() -->
                    </select>
                  </div>
                  <div class="form-group col-12 col-sm-6 col-md-4">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-door-open text-gold mr-1"></i>Destination Room
                    </label>
                    <select id="bulkCloneRoom" class="form-control" onchange="window.updateClonePreview()">
                      <!-- Cascades based on building -->
                    </select>
                  </div>
                  <div class="form-group col-12 col-sm-6 col-md-4">
                    <label class="small font-weight-bold text-uppercase">
                      <i class="fas fa-user-check text-gold mr-1"></i>Accountable Custodian
                    </label>
                    <select id="bulkCloneCustodian" class="form-control" onchange="window.updateClonePreview()">
                      <!-- Populated from marSUDb users -->
                    </select>
                  </div>
                </div>

                <!-- Quantity Stepper & Quick Pills Card -->
                <div class="card-marsu p-3 mb-3"
                  style="background: rgba(38,5,14,0.35); border: 1.5px solid var(--gold-500);">
                  <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-2">
                    <div>
                      <label class="small font-weight-bold text-uppercase text-gold mb-0">
                        <i class="fas fa-cubes mr-1"></i>How many units to register? (Quantity)
                      </label>
                      <div class="small text-muted">Use the stepper or tap quick preset numbers below.</div>
                    </div>
                    <div class="d-flex align-items-center mt-2 mt-md-0 flex-wrap gap-1">
                      <span class="mr-2 small text-muted">Quick Select:</span>
                      <button type="button" class="btn btn-xs btn-marsu-outline py-1 px-2 mr-1"
                        onclick="window.setCloneQty(3)">3</button>
                      <button type="button" class="btn btn-xs btn-marsu-outline py-1 px-2 mr-1"
                        onclick="window.setCloneQty(5)">5</button>
                      <button type="button" class="btn btn-xs btn-marsu-outline py-1 px-2 mr-1"
                        onclick="window.setCloneQty(10)">10</button>
                      <button type="button" class="btn btn-xs btn-marsu-outline py-1 px-2 mr-1"
                        onclick="window.setCloneQty(20)">20</button>
                      <button type="button" class="btn btn-xs btn-marsu-outline py-1 px-2"
                        onclick="window.setCloneQty(30)">30</button>
                    </div>
                  </div>

                  <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between"
                    style="gap: 15px;">
                    <!-- Stepper -->
                    <div class="batch-qty-control" style="max-width: 200px;">
                      <button type="button" class="batch-qty-btn" onclick="window.stepCloneQty(-1)">-</button>
                      <input type="number" id="cloneQtyInput" class="batch-qty-input" value="5" min="2" max="150"
                        oninput="window.updateClonePreview()">
                      <button type="button" class="batch-qty-btn" onclick="window.stepCloneQty(1)">+</button>
                    </div>

                    <!-- Live Calculation Badge -->
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                      <div class="bulk-stat-chip">
                        <i class="fas fa-calculator text-gold"></i>
                        <span>Total Valuation: <strong class="font-mono text-gold"
                            id="cloneTotalValuationText">₱292,500.00</strong></span>
                      </div>
                      <div class="bulk-stat-chip">
                        <i class="fas fa-barcode text-gold"></i>
                        <span>Sequence Range: <strong class="font-mono text-gold" id="cloneSequenceRangeText">00131
                            &rarr; 00135</strong></span>
                      </div>
                    </div>
                  </div>

                  <!-- Serial Generation Options -->
                  <div class="mt-3 pt-3" style="border-top: 1px dashed rgba(212,175,55,0.25);">
                    <div class="form-row align-items-center">
                      <div class="form-group col-12 col-md-5 mb-2 mb-md-1">
                        <label class="small font-weight-bold text-uppercase mb-1">Serial Number Method:</label>
                        <select id="cloneSerialMode" class="form-control form-control-sm"
                          onchange="window.onCloneSerialModeChange()">
                          <option value="auto">Auto-Sequence (e.g. SN-2026-001, 002...)</option>
                          <option value="paste">Paste Serials List (1 per line)</option>
                          <option value="lot">Common Lot Tag (No Serials)</option>
                        </select>
                      </div>
                      <div class="form-group col-12 col-md-7 mb-1" id="cloneSerialPrefixCol">
                        <label class="small font-weight-bold text-uppercase mb-1">Serial Base Prefix:</label>
                        <input type="text" id="cloneSerialPrefix" class="form-control form-control-sm font-mono"
                          value="SN-2026-" placeholder="e.g. SN-2026-" oninput="window.updateClonePreview()">
                      </div>
                    </div>
                    <div class="form-group mb-0" id="clonePasteSerialCol" style="display: none;">
                      <label class="small font-weight-bold text-uppercase mb-1">Paste Serial Numbers Here (1 per line or
                        comma-separated):</label>
                      <textarea id="clonePastedSerials" class="form-control form-control-sm font-mono" rows="3"
                        placeholder="SN-982101&#10;SN-982102&#10;SN-982103..."
                        oninput="window.updateClonePreview()"></textarea>
                    </div>
                  </div>
                </div>

                <!-- Live Gapless Preview Table -->
                <div class="mb-2 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between"
                  style="gap: 5px;">
                  <div class="small font-weight-bold text-uppercase text-gold">
                    <i class="fas fa-list-ol mr-1"></i>Live Generated Units Preview (<span
                      id="cloneUnitsCountPreview">5</span> Units)
                  </div>
                  <div class="small text-muted">You can directly edit each unit's serial number in the table below:
                  </div>
                </div>

                <div class="table-responsive rounded mb-3"
                  style="max-height: 240px; overflow-y: auto; border: 1px solid var(--border-color); -webkit-overflow-scrolling: touch;">
                  <table class="table table-sm table-hover mb-0" style="font-size: 0.82rem; min-width: 620px;">
                    <thead
                      style="background: rgba(38,5,14,0.3); color: var(--text-heading); position: sticky; top: 0; z-index: 2;">
                      <tr>
                        <th style="width: 45px;">#</th>
                        <th>Property Number (PIN)</th>
                        <th>Unit Label</th>
                        <th>Serial Number (Editable)</th>
                        <th>Cost (₱)</th>
                        <th>Room &amp; Custodian</th>
                      </tr>
                    </thead>
                    <tbody id="bulkClonePreviewTbody">
                      <!-- Rendered dynamically via JS -->
                    </tbody>
                  </table>
                </div>

              </div>

              <!-- ------------------------------------------------------ -->
              <!-- SUB-METHOD: MULTIPLE DIFFERENT ITEMS                   -->
              <!-- ------------------------------------------------------ -->
              <div id="bulkTableContainer" style="display: none;">
                <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-start" role="note"
                  style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.3); color: #93c5fd; font-size: 0.84rem;">
                  <i class="fas fa-info-circle mr-2 fa-lg"></i>
                  <div><strong>Add different items:</strong> Enter an item's details and quantity below, then select
                    <strong>Add item</strong>. The item will be added to the list, and you can enter and add another
                    item before registering everything.
                  </div>
                </div>

                <div class="border rounded p-3 mb-3"
                  style="border-color: var(--border-color) !important; background: var(--bg-surface);">
                  <div class="form-row">
                    <div class="form-group col-12 col-md-6 mb-2">
                      <label for="bulkNewItemDescription" class="small font-weight-bold text-uppercase mb-1"><i
                          class="fas fa-file-alt text-gold mr-1"></i>Item Description</label>
                      <input type="text" class="form-control form-control-sm" id="bulkNewItemDescription"
                        placeholder="e.g. Dell Latitude 5440 Core i7, 16GB RAM">
                    </div>
                    <div class="form-group col-12 col-md-6 mb-2">
                      <label for="bulkNewItemCategory" class="small font-weight-bold text-uppercase mb-1"><i
                          class="fas fa-sitemap text-gold mr-1"></i>Category</label>
                      <select class="form-control form-control-sm" id="bulkNewItemCategory">
                        <option value="IT">IT &amp; Computing Infrastructure</option>
                        <option value="OFF">Office Equipment &amp; Furniture</option>
                        <option value="AC">Air Conditioning &amp; HVAC</option>
                        <option value="SCI">Science &amp; Laboratory Apparatus</option>
                        <option value="VEH">Motor Vehicle &amp; Transport</option>
                        <option value="MED">Health &amp; Medical Clinical Facility</option>
                        <option value="ATH">Athletic, Sports &amp; Gym Equipment</option>
                      </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-md-3 mb-2">
                      <label for="bulkNewItemBrand" class="small font-weight-bold text-uppercase mb-1">Brand</label>
                      <input type="text" class="form-control form-control-sm" id="bulkNewItemBrand" list="brandDatalist"
                        placeholder="e.g. Dell">
                    </div>
                    <div class="form-group col-12 col-sm-6 col-md-3 mb-2">
                      <label for="bulkNewItemModel" class="small font-weight-bold text-uppercase mb-1">Model</label>
                      <input type="text" class="form-control form-control-sm" id="bulkNewItemModel"
                        placeholder="e.g. Latitude 5440">
                    </div>
                    <div class="form-group col-12 col-sm-6 col-md-3 mb-2">
                      <label for="bulkNewItemCost" class="small font-weight-bold text-uppercase mb-1">Unit Cost
                        (₱)</label>
                      <input type="number" min="0.01" step="0.01" class="form-control form-control-sm"
                        id="bulkNewItemCost" placeholder="0.00">
                    </div>
                    <div class="form-group col-12 col-sm-6 col-md-3 mb-2">
                      <label for="bulkNewItemDate" class="small font-weight-bold text-uppercase mb-1">Acquisition
                        Date</label>
                      <input type="date" class="form-control form-control-sm" id="bulkNewItemDate">
                    </div>
                    <div class="form-group col-12 col-md-4 mb-2">
                      <label for="bulkNewItemFund" class="small font-weight-bold text-uppercase mb-1">Fund
                        Cluster</label>
                      <select class="form-control form-control-sm" id="bulkNewItemFund">
                        <option value="01 - Regular Agency Fund">01 Regular Agency Fund</option>
                        <option value="05 - Internally Generated Funds">05 Internally Generated Funds</option>
                        <option value="06 - Business Related Funds">06 Business Related Funds</option>
                        <option value="07 - Trust Receipts">07 Trust Receipts</option>
                      </select>
                    </div>
                    <div class="form-group col-12 col-md-4 mb-2">
                      <label for="bulkNewItemBuilding" class="small font-weight-bold text-uppercase mb-1">Destination
                        Building</label>
                      <select class="form-control form-control-sm" id="bulkNewItemBuilding"
                        onchange="window.onBulkEntryBuildingChange()"></select>
                    </div>
                    <div class="form-group col-12 col-md-4 mb-2">
                      <label for="bulkNewItemRoom" class="small font-weight-bold text-uppercase mb-1">Destination
                        Room</label>
                      <select class="form-control form-control-sm" id="bulkNewItemRoom"
                        onchange="window.onBulkEntryRoomChange()"></select>
                      <input type="text" class="form-control form-control-sm mt-2" id="bulkNewItemCustomRoom"
                        placeholder="Enter room or area" style="display:none;">
                    </div>
                    <div class="form-group col-12 col-md-8 mb-2">
                      <label for="bulkNewItemCustodian" class="small font-weight-bold text-uppercase mb-1">Accountable
                        Custodian</label>
                      <select class="form-control form-control-sm" id="bulkNewItemCustodian"
                        onchange="window.onBulkEntryCustodianChange()"></select>
                      <input type="text" class="form-control form-control-sm mt-2" id="bulkNewItemCustomCustodian"
                        placeholder="Enter personnel name" style="display:none;">
                    </div>
                    <div class="form-group col-12 col-sm-4 col-md-2 mb-2">
                      <label for="bulkNewItemQuantity"
                        class="small font-weight-bold text-uppercase mb-1">Quantity</label>
                      <input type="number" min="1" max="150" class="form-control form-control-sm"
                        id="bulkNewItemQuantity" value="1">
                    </div>
                    <div class="form-group col-12 mb-0">
                      <button type="button" class="btn btn-sm btn-marsu-gold" id="addBulkGridRowButton"
                        onclick="window.addBulkGridRow()">
                        <i class="fas fa-plus-circle mr-1" aria-hidden="true"></i>Add item to list
                      </button>
                    </div>
                  </div>
                </div>

                <!-- The Interactive Grid Table -->
                <div class="table-responsive rounded mb-3"
                  style="max-height: 280px; overflow-y: auto; border: 1px solid var(--border-color); -webkit-overflow-scrolling: touch;">
                  <table class="bulk-grid-table mb-0" id="bulkGridTable" style="min-width: 1450px;">
                    <thead style="background: rgba(38,5,14,0.3); position: sticky; top: 0; z-index: 2;">
                      <tr>
                        <th style="width: 35px;">#</th>
                        <th style="min-width: 200px;">Item Description</th>
                        <th style="width: 130px;">Category</th>
                        <th style="min-width: 130px;">Brand / Model</th>
                        <th style="width: 75px;">Qty</th>
                        <th style="width: 120px;">Unit Cost (₱)</th>
                        <th style="width: 125px;">Total (₱)</th>
                        <th style="min-width: 110px;">Acquisition Date</th>
                        <th style="min-width: 160px;">Fund Cluster</th>
                        <th style="min-width: 130px;">Destination</th>
                        <th style="min-width: 150px;">Destination Room</th>
                        <th style="min-width: 170px;">Accountable Custodian</th>
                        <th style="width: 40px;" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody id="bulkGridTableBody">
                      <!-- Rendered dynamically -->
                    </tbody>
                  </table>
                </div>

                <!-- Grand Summary -->
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-2"
                  style="gap: 10px;">
                  <div class="d-flex flex-wrap gap-2">
                    <div class="bulk-stat-chip">
                      <i class="fas fa-boxes text-gold"></i>
                      <span>Total Types: <strong class="font-mono text-gold" id="gridTotalTypesText">0</strong></span>
                    </div>
                    <div class="bulk-stat-chip">
                      <i class="fas fa-cubes text-gold"></i>
                      <span>Total Units: <strong class="font-mono text-gold" id="gridTotalUnitsText">0
                          units</strong></span>
                    </div>
                    <div class="bulk-stat-chip">
                      <i class="fas fa-money-bill-wave text-gold"></i>
                      <span>Total Valuation: <strong class="font-mono text-gold"
                          id="gridTotalValuationText">₱0.00</strong></span>
                    </div>
                  </div>
                </div>

              </div>

            </div>

          </div>

          <!-- Modal Footer (Fixed at Bottom) -->
          <div class="modal-footer py-3 px-4 justify-content-between flex-shrink-0"
            style="border-top: 1px solid var(--border-color); background: rgba(38,5,14,0.08); position: sticky; bottom: 0; z-index: 10;">
            <div class="d-flex align-items-center">
              <button type="button" class="btn btn-marsu-outline mr-2" data-dismiss="modal">Cancel</button>
              <div id="bulkFooterSummaryChip" class="bulk-stat-chip text-gold font-weight-bold" style="display: none;">
                <i class="fas fa-layer-group"></i> <span id="bulkFooterCountBadge">5 Units</span> &bull; <span
                  id="bulkFooterTotalBadge">₱292,500.00</span>
              </div>
            </div>
            <div>
              <!-- Single Mode Submit Button -->
              <button type="button" class="btn btn-marsu-gold btn-shimmer" id="btnSubmitSingleAsset"
                onclick="window.submitSingleAsset()">
                <i class="fas fa-check-circle mr-1"></i>Confirm &amp; Generate QR Tag
              </button>
              <!-- Bulk Mode Submit Button -->
              <button type="button" class="btn btn-marsu-gold btn-shimmer" id="btnSubmitBulkAsset"
                onclick="window.submitBulkIntake()" style="display: none;">
                <i class="fas fa-rocket mr-1"></i><span id="btnSubmitBulkText">Confirm &amp; Register 5 Assets</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Batch Registration Success & Print Sheet Modal -->
  <div class="modal fade" id="batchSuccessModal" tabindex="-1" role="dialog" aria-hidden="true"
    style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 900px; margin: 1.75rem auto;">
      <div class="modal-content card-marsu"
        style="border: 2px solid var(--gold-500); background-color: var(--bg-surface-elevated); max-height: 90vh; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 12px 50px rgba(0,0,0,0.6);">
        <div class="modal-header py-3 px-4 flex-shrink-0" style="background: var(--grad-burgundy); color: #fff;">
          <div class="d-flex align-items-center">
            <div class="rounded-circle p-2 mr-3" style="background: rgba(212,175,55,0.2); color: var(--gold-400);">
              <i class="fas fa-check-double fa-lg"></i>
            </div>
            <div>
              <h5 class="modal-title font-weight-bold text-white mb-0">Batch Asset Registration Confirmed</h5>
              <div class="small text-gold-light">All campus property numbers generated gaplessly</div>
            </div>
          </div>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body p-4"
          style="overflow-y: auto; flex: 1 1 auto; min-height: 0; max-height: calc(90vh - 140px); -webkit-overflow-scrolling: touch;">
          <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-3">
            <i class="fas fa-check-circle fa-2x mr-3 text-success"></i>
            <div>
              <div class="font-weight-bold" id="batchSuccessHeading">Successfully Registered Campus Assets</div>
              <div class="small" id="batchSuccessSubtext">Property Identification Numbers (PIN) generated &amp; logged
                to Sta. Cruz master register.</div>
            </div>
          </div>

          <div class="table-responsive rounded mb-3"
            style="max-height: 280px; overflow-y: auto; border: 1px solid var(--border-color);">
            <table class="table table-sm table-hover mb-0" style="font-size: 0.82rem;">
              <thead style="background: rgba(38,5,14,0.1); color: var(--text-heading);">
                <tr>
                  <th>Property No</th>
                  <th>Description</th>
                  <th>Serial</th>
                  <th>Valuation</th>
                  <th>Custodian &amp; Room</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="batchSuccessTableBody">
                <!-- Populated dynamically -->
              </tbody>
            </table>
          </div>

          <div class="p-3 rounded text-center"
            style="background: rgba(212,175,55,0.06); border: 1px dashed var(--gold-500);">
            <div class="small text-muted mb-1">Standard COA Appendix 71 / Property Sticker Production</div>
            <div class="d-flex flex-wrap justify-content-center gap-2">
              <button type="button" class="btn btn-marsu-gold btn-sm mr-2" id="btnPrintBatchSheetBtn">
                <i class="fas fa-print mr-1"></i>Print Avery QR Sticker Sheet for This Batch
              </button>
              <button type="button" class="btn btn-marsu-outline btn-sm"
                onclick="$('#batchSuccessModal').modal('hide')">
                <i class="fas fa-table mr-1"></i>View in Main Asset Registry
              </button>
            </div>
          </div>
        </div>
        <div class="modal-footer py-2 px-4 justify-content-end flex-shrink-0"
          style="border-top: 1px solid var(--border-color); background: rgba(38,5,14,0.08); position: sticky; bottom: 0; z-index: 10;">
          <button type="button" class="btn btn-marsu-outline" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- High-Res QR Tag Preview Modal -->
  <div class="modal fade" id="qrPreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content card-marsu border-0">
        <div class="modal-header py-3 px-4"
          style="border-bottom: 1px solid var(--border-color); background: var(--grad-burgundy); color: #fff;">
          <h5 class="modal-title font-weight-bold text-white mb-0">
            <i class="fas fa-qrcode mr-2 text-gold"></i>Property QR Tag &amp; Barcode Preview
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body p-4 text-center">
          <input type="hidden" id="qrPreviewAssetId">
          <div class="sandbox-sticker-preview mx-auto mb-3" style="max-width: 380px;">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span class="sticker-univ-title">MarSU Sta. Cruz Campus</span>
              <span class="sticker-badge-coa">COA App 71</span>
            </div>
            <div class="sticker-sub-title">Supply &amp; Property Management Unit</div>
            <div class="d-flex align-items-center justify-content-between my-2">
              <img id="qrModalImg" src="" width="80" height="80" class="rounded border p-1 bg-white" alt="QR Tag" />
              <div class="text-right flex-grow-1 pl-3">
                <div class="sticker-pin-code font-mono font-weight-bold" id="qrModalPin">PIN</div>
                <div class="sticker-desc-text" id="qrModalDesc">Description</div>
                <div class="small text-muted font-mono" id="qrModalCustodian">Custodian</div>
              </div>
            </div>
            <div class="sticker-footer-note">PROPERTY OF MARINDUQUE STATE UNIVERSITY &bull; UNLAWFUL TO REMOVE</div>
          </div>
        </div>
        <div class="modal-footer py-2 px-4 justify-content-between"
          style="border-top: 1px solid var(--border-color); background: rgba(38,5,14,0.04);">
          <button type="button" class="btn btn-marsu-outline" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-marsu-gold"
            onclick="window.printSingleQrTag(document.getElementById('qrPreviewAssetId').value)">
            <i class="fas fa-print mr-1"></i>Print This Sticker Tag
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>

  <!-- MarSU Core Scripts -->
  <script src="js/marsu-data.js"></script>
  <script src="js/marsu-db.js"></script>
  <script src="js/marsu-ui.js"></script>

  <!-- Page Specific Script -->
  <script>
let currentPage = 1;
    const pageSize = 15;
    let filteredAssets = [];
    let currentActiveSubmodule = 'profile';

    // --- Sub-module Switcher (Tabs & Sidebar sync) ---
    // --- Sub-module Switcher (Tabs & Sidebar sync) ---
    window.switchSubmodule = function () {
      currentActiveSubmodule = 'profile';
      const profilePane = document.getElementById('pane-profile');
      if (profilePane) profilePane.classList.add('show', 'active');
      renderTable();
    };
    // Category Chip Filter state
    let activeCategoryChip = 'ALL';

    window.setCategoryChipFilter = function (filterKey, btnElement) {
      activeCategoryChip = filterKey;
      $('#profileCategoryChips .asset-chip').removeClass('active');
      if (btnElement) $(btnElement).addClass('active');

      const catSelect = document.getElementById('filterCategory');
      if (catSelect) {
        if (filterKey === 'IT' || filterKey === 'OFF' || filterKey === 'AC' || filterKey === 'Semi-Expendable' || filterKey === 'Heavy Equipment') {
          catSelect.value = filterKey;
        } else {
          catSelect.value = 'ALL';
        }
      }

      currentPage = 1;
      renderTable();
      if (window.showToast && filterKey !== 'ALL') {
        window.showToast(`Applied filter: ${filterKey.replace('_', ' ')}`, "emerald");
      }
    };

    window.resetAssetFilters = function () {
      const search = document.getElementById('assetSearchInput');
      if (search) {
        search.value = '';
        const clearBtn = document.getElementById('assetSearchClear');
        if (clearBtn) clearBtn.hidden = true;
      }
      const cat = document.getElementById('filterCategory');
      if (cat) cat.value = 'ALL';
      const bld = document.getElementById('filterBuilding');
      if (bld) bld.value = 'ALL';
      const cond = document.getElementById('filterCondition');
      if (cond) cond.value = 'ALL';

      activeCategoryChip = 'ALL';
      $('#profileCategoryChips .asset-chip').removeClass('active');
      $('#profileCategoryChips .asset-chip[data-filter="ALL"]').addClass('active');

      currentPage = 1;
      renderTable();
      if (window.showToast) window.showToast("All filters have been reset.", "emerald");
    };

    window.filterByClassificationTier = function (tier) {
      window.switchSubmodule('profile');
      window.setCategoryChipFilter(tier, document.querySelector(`#profileCategoryChips .asset-chip[data-filter="${tier}"]`));
      if (window.showToast) {
        const labels = {
          'PPE': 'Capitalized PPE (≥ ₱50,000.00)',
          'SEMI': 'Semi-Expendable Property (< ₱50,000.00)'
        };
        window.showToast(`Filtered asset registry to ${labels[tier] || tier}`, "emerald");
      }
    };

    window.filterByOffice = function (officeId) {
      const officeSelect = document.getElementById('accountabilityFilterOffice');
      if (officeSelect) {
        officeSelect.value = officeId;
        renderAccountabilityTable();
        if (window.showToast) window.showToast(`Filtered accountability records to ${officeId}`, "emerald");
      }
    };

    // --- 1. Asset Profile & Master Table Renderer ---
    function renderTable() {
      const q = document.getElementById('assetSearchInput') ? document.getElementById('assetSearchInput').value : '';
      const cat = document.getElementById('filterCategory') ? document.getElementById('filterCategory').value : 'ALL';
      const bld = document.getElementById('filterBuilding') ? document.getElementById('filterBuilding').value : 'ALL';
      const cond = document.getElementById('filterCondition') ? document.getElementById('filterCondition').value : 'ALL';

      let assets = window.marSUDb.getAssets({
        search: q,
        category: cat,
        building: bld,
        condition: cond
      });

      // Apply chip filter
      if (activeCategoryChip === 'PPE') {
        assets = assets.filter(a => (parseFloat(a.acquisitionCost) || 0) >= 50000);
      } else if (activeCategoryChip === 'SEMI') {
        assets = assets.filter(a => (parseFloat(a.acquisitionCost) || 0) < 50000);
      } else if (activeCategoryChip === 'REPAIR') {
        assets = assets.filter(a => a.conditionStatus && a.conditionStatus.toLowerCase().includes('repair'));
      } else if (activeCategoryChip === 'IT' || activeCategoryChip === 'OFF' || activeCategoryChip === 'AC') {
        assets = assets.filter(a => a.category === activeCategoryChip);
      }

      filteredAssets = assets;

      // Update KPI Cards & Stats
      const allAssets = window.marSUDb.getAssets();
      const totalOutlay = allAssets.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);
      const totalNetBook = allAssets.reduce((sum, a) => sum + (parseFloat(a.bookValue) || 0), 0);
      const serviceableCount = allAssets.filter(a => a.conditionStatus === 'Serviceable').length;
      const serviceableRate = allAssets.length ? ((serviceableCount / allAssets.length) * 100).toFixed(1) : '100.0';

      if (document.getElementById('profileKpiTotal')) document.getElementById('profileKpiTotal').textContent = allAssets.length;
      if (document.getElementById('profileKpiOutlay')) document.getElementById('profileKpiOutlay').textContent = window.formatCurrency(totalOutlay);
      if (document.getElementById('profileKpiNetBook')) document.getElementById('profileKpiNetBook').textContent = window.formatCurrency(totalNetBook);
      if (document.getElementById('profileKpiServiceable')) document.getElementById('profileKpiServiceable').textContent = `${serviceableRate}%`;
      if (document.getElementById('profileKpiCustody')) document.getElementById('profileKpiCustody').textContent = '100.0%';

      if (document.getElementById('filteredCountBadge')) document.getElementById('filteredCountBadge').textContent = filteredAssets.length;
      if (document.getElementById('totalCountBadge')) document.getElementById('totalCountBadge').textContent = allAssets.length;
      if (document.getElementById('pillAssetCount')) document.getElementById('pillAssetCount').textContent = allAssets.length;

      // Update chip counts
      if (document.getElementById('chipCountAll')) document.getElementById('chipCountAll').textContent = allAssets.length;
      if (document.getElementById('chipCountPPE')) document.getElementById('chipCountPPE').textContent = allAssets.filter(a => (parseFloat(a.acquisitionCost) || 0) >= 50000).length;
      if (document.getElementById('chipCountSemi')) document.getElementById('chipCountSemi').textContent = allAssets.filter(a => (parseFloat(a.acquisitionCost) || 0) < 50000).length;

      const totalPages = Math.ceil(filteredAssets.length / pageSize) || 1;
      if (currentPage > totalPages) currentPage = totalPages;

      if (document.getElementById('pageNumberDisplay')) document.getElementById('pageNumberDisplay').textContent = `Page ${currentPage} of ${totalPages}`;
      if (document.getElementById('prevPageBtn')) document.getElementById('prevPageBtn').disabled = currentPage <= 1;
      if (document.getElementById('nextPageBtn')) document.getElementById('nextPageBtn').disabled = currentPage >= totalPages;

      const start = (currentPage - 1) * pageSize;
      const paged = filteredAssets.slice(start, start + pageSize);
      const tbody = document.getElementById('assetTableBody');
      if (!tbody) return;

      if (paged.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="10" class="text-center py-5 text-muted">
              <i class="fas fa-search fa-2x mb-2 text-gold d-block"></i>
              No asset records found matching your filters.
            </td>
          </tr>
        `;
        return;
      }

      tbody.innerHTML = paged.map(a => {
        const cost = parseFloat(a.acquisitionCost) || 0;
        const isPpe = cost >= 50000;
        const classBadgeClass = isPpe ? 'badge-primary' : 'badge-success';
        const classLabel = isPpe ? 'PPE' : 'SEMI-EXP';
        const custInitials = (a.custodianName || 'SP').split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase();

        return `
        <tr style="cursor: pointer;" onclick="window.viewAssetProfile('${a.id}')">
          <td class="asset-number-cell">
            <div class="d-flex align-items-center">
              <span class="property-num font-weight-bold text-gold mr-2 font-mono">${a.propertyNumber}</span>
              <button class="btn btn-xs btn-marsu-outline py-0 px-1" title="Copy PIN" onclick="event.stopPropagation(); window.copyTextToClipboard('${a.propertyNumber}')">
                <i class="fas fa-copy text-gold" style="font-size: 0.7rem;"></i>
              </button>
            </div>
            <div class="small text-muted font-mono"><i class="fas fa-qrcode text-gold mr-1"></i>QR Tagged &bull; Verified</div>
          </td>
          <td class="asset-number-cell">
            <span class="font-mono small font-weight-bold" style="color: var(--text-heading);">${a.inventoryItemNumber || '—'}</span>
          </td>
          <td class="asset-description-cell">
            <div class="font-weight-bold" style="color: var(--text-heading); font-size: 0.88rem;">${a.description}</div>
            <div class="small text-muted">SN: <span class="font-mono">${a.serialNumber || 'N/A'}</span> &bull; ${a.brand || ''} ${a.model || ''}</div>
          </td>
          <td class="asset-classification-cell">
            <span class="badge ${classBadgeClass} asset-classification-badge px-2 py-1">
              ${classLabel}
            </span>
          </td>
          <td class="asset-money-cell">
            <strong class="font-mono">${window.formatCurrency(cost)}</strong>
          </td>
          <td class="asset-money-cell">
            <strong class="font-mono text-gold">${window.formatCurrency(a.bookValue)}</strong>
          </td>
          <td>
            <div class="font-weight-bold"><i class="fas fa-building text-gold mr-1" style="font-size: 0.75rem;"></i>${a.buildingId}</div>
            <div class="small text-muted">${a.roomId}</div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="custody-avatar-circle" style="width: 24px; height: 24px; font-size: 0.65rem;">${custInitials}</span>
              <div>
                <div class="small font-weight-bold" style="color: var(--text-heading);">${a.custodianName}</div>
                <div class="small text-muted font-mono" style="font-size: 0.7rem;">${a.officeId}</div>
              </div>
            </div>
          </td>
          <td>
            <span class="badge-status ${a.conditionStatus === 'Serviceable' ? 'badge-serviceable' : 'badge-overdue'}">${a.conditionStatus}</span>
          </td>
          <td class="text-center" onclick="event.stopPropagation()">
            <div class="asset-submodule-actions">
              <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="Print Sticker Tag" onclick="window.printSingleQrTag('${a.id}')">
                <i class="fas fa-qrcode text-gold"></i>
              </button>
              <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="Transfer Custody" onclick="window.openTransferCustodyModal('${a.id}')">
                <i class="fas fa-exchange-alt text-warning"></i>
              </button>
              <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="View Full Profile" onclick="window.viewAssetProfile('${a.id}')">
                <i class="fas fa-eye text-primary"></i>
              </button>
            </div>
          </td>
        </tr>
      `;
      }).join('');
    }

    // --- 2. Property Identification Numbers (PIN) Renderer ---
    function renderPinTable() {
      const q = document.getElementById('pinSearchInput') ? document.getElementById('pinSearchInput').value.toLowerCase().trim() : '';
      const allAssets = window.marSUDb.getAssets();
      const filtered = allAssets.filter(a => {
        if (!q) return true;
        return (a.propertyNumber && a.propertyNumber.toLowerCase().includes(q)) ||
          (a.serialNumber && a.serialNumber.toLowerCase().includes(q)) ||
          (a.description && a.description.toLowerCase().includes(q)) ||
          (a.brand && a.brand.toLowerCase().includes(q)) ||
          (a.custodianName && a.custodianName.toLowerCase().includes(q));
      });

      if (document.getElementById('pinCountSummary')) document.getElementById('pinCountSummary').textContent = `${allAssets.length} Units`;
      if (document.getElementById('pillPinCount')) document.getElementById('pillPinCount').textContent = `${allAssets.length} PINs`;
      if (document.getElementById('pinTableCount')) document.getElementById('pinTableCount').textContent = `Showing ${filtered.length} of ${allAssets.length} PIN records`;

      // Next PIN preview
      const nextSeq = String(allAssets.length + 1).padStart(5, '0');
      if (document.getElementById('pinNextSummary')) document.getElementById('pinNextSummary').textContent = `MarSU-STC-2026-PPE-${nextSeq}`;
      if (document.getElementById('schemaPreviewSeq')) document.getElementById('schemaPreviewSeq').textContent = nextSeq;

      const tbody = document.getElementById('pinTableBody');
      if (!tbody) return;

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted">No PIN records found matching "${q}".</td></tr>`;
        return;
      }

      tbody.innerHTML = filtered.map(a => `
        <tr style="cursor: pointer;" onclick="window.viewAssetProfile('${a.id}')">
          <td>
            <div class="d-flex align-items-center">
              <span class="font-mono font-weight-bold text-gold mr-2" style="font-size: 0.92rem;">${a.propertyNumber}</span>
              <button class="btn btn-xs btn-marsu-outline py-0 px-1" title="Copy PIN" onclick="event.stopPropagation(); window.copyTextToClipboard('${a.propertyNumber}')">
                <i class="fas fa-copy text-gold" style="font-size: 0.72rem;"></i>
              </button>
            </div>
            <div class="small text-muted font-mono">${a.category || 'PPE'} &bull; Sta. Cruz Campus</div>
          </td>
          <td>
            <span class="font-mono small font-weight-bold" style="color: var(--text-heading);">${a.inventoryItemNumber || 'Not assigned'}</span>
          </td>
          <td>
            <div class="font-weight-bold" style="color: var(--text-heading); font-size: 0.88rem;">${a.description}</div>
            <div class="small text-muted">${a.brand || ''} ${a.model || ''}</div>
          </td>
          <td>
            <span class="font-mono small font-weight-bold" style="color: var(--text-heading);">${a.serialNumber || 'N/A'}</span>
          </td>
          <td>
            <!-- Barcode Graphic Simulation with Barcode Number -->
            <div class="d-inline-flex flex-column align-items-center p-1 rounded bg-white shadow-sm" style="border: 1px solid #d1d3e2;" title="Barcode Standard Code 128">
              <div class="d-flex align-items-end" style="height: 20px; gap: 1.5px;">
                <span style="width:2px; height:100%; background:#000;"></span>
                <span style="width:1px; height:100%; background:#000;"></span>
                <span style="width:3px; height:100%; background:#000;"></span>
                <span style="width:1px; height:100%; background:#000;"></span>
                <span style="width:2px; height:100%; background:#000;"></span>
                <span style="width:1px; height:100%; background:#000;"></span>
                <span style="width:3px; height:100%; background:#000;"></span>
                <span style="width:2px; height:100%; background:#000;"></span>
                <span style="width:1px; height:100%; background:#000;"></span>
                <span style="width:2px; height:100%; background:#000;"></span>
                <span style="width:1px; height:100%; background:#000;"></span>
                <span style="width:3px; height:100%; background:#000;"></span>
              </div>
              <span class="font-mono text-dark" style="font-size: 8px; font-weight: bold; line-height: 1;">${a.propertyNumber.slice(-8)}</span>
            </div>
          </td>
          <td>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=36x36&data=${encodeURIComponent(a.propertyNumber)}" width="36" height="36" class="rounded border p-0.5 bg-white" title="Click to enlarge QR" onclick="event.stopPropagation(); window.openQrPreviewModal('${a.id}')" />
          </td>
          <td>
            <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Affixed &amp; Verified</span>
          </td>
          <td>
            <div class="small font-weight-bold" style="color: var(--text-heading);">${a.custodianName || 'SPMU Officer'}</div>
            <div class="small text-muted font-mono">${a.lastInspectedDate || a.acquisitionDate}</div>
          </td>
          <td class="text-center" onclick="event.stopPropagation()">
            <div class="asset-submodule-actions">
              <button class="btn btn-sm btn-marsu-outline py-1 px-2 mr-1" title="Print Sticker Tag" onclick="window.printSingleQrTag('${a.id}')">
                <i class="fas fa-print text-gold"></i>
              </button>
              <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="View Full Profile" onclick="window.viewAssetProfile('${a.id}')">
                <i class="fas fa-eye text-primary"></i>
              </button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    // --- 3. Asset Classification Matrix Renderer ---
    function renderClassificationTable() {
      const allAssets = window.marSUDb.getAssets();

      // COA GAM Schedule Definitions
      const classifications = [
        { code: "1-06-05-020", name: "Information & Communications Tech (ICT) Equipment", type: "PPE", life: "5 Years", rate: "19.00%", salvage: "5%", doc: "PAR", match: a => a.category === "IT" && (parseFloat(a.acquisitionCost) || 0) >= 50000 },
        { code: "1-04-05-020", name: "Semi-Expendable ICT Equipment", type: "Semi-Expendable", life: "3 Years", rate: "N/A (Expensed)", salvage: "N/A", doc: "ICS", match: a => a.category === "IT" && (parseFloat(a.acquisitionCost) || 0) < 50000 },
        { code: "1-06-05-030", name: "Office Equipment & Duplicating Machines", type: "PPE", life: "5 Years", rate: "19.00%", salvage: "5%", doc: "PAR", match: a => a.category === "OFF" && (parseFloat(a.acquisitionCost) || 0) >= 50000 },
        { code: "1-04-05-030", name: "Semi-Expendable Office Equipment", type: "Semi-Expendable", life: "2 Years", rate: "N/A (Expensed)", salvage: "N/A", doc: "ICS", match: a => a.category === "OFF" && (parseFloat(a.acquisitionCost) || 0) < 50000 },
        { code: "1-06-05-080", name: "Medical, Dental and Laboratory Research Equipment", type: "PPE", life: "10 Years", rate: "9.50%", salvage: "5%", doc: "PAR", match: a => (a.category === "Science" || a.category === "LAB") || (a.description && a.description.toLowerCase().includes("lab")) },
        { code: "1-06-05-070", name: "Communication & Audio-Visual Equipment", type: "PPE", life: "7 Years", rate: "13.57%", salvage: "5%", doc: "PAR", match: a => a.category === "AC" || (a.description && (a.description.toLowerCase().includes("camera") || a.description.toLowerCase().includes("mic"))) },
        { code: "1-06-05-990", name: "Other Machinery, Power & Utilities Equipment", type: "PPE", life: "10 Years", rate: "9.50%", salvage: "5%", doc: "PAR", match: a => a.category === "Heavy Equipment" || (!a.category || a.category === "PPE") }
      ];

      // Update Tiers Summary (Capitalized PPE vs Semi-Expendable)
      const ppeAssets = allAssets.filter(a => (parseFloat(a.acquisitionCost) || 0) >= 50000);
      const semiAssets = allAssets.filter(a => (parseFloat(a.acquisitionCost) || 0) < 50000);

      const ppeVal = ppeAssets.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);
      const semiVal = semiAssets.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);

      if (document.getElementById('ppeTotalValue')) document.getElementById('ppeTotalValue').textContent = window.formatCurrency(ppeVal);
      if (document.getElementById('ppeTotalCount')) document.getElementById('ppeTotalCount').textContent = `${ppeAssets.length} Units`;
      if (document.getElementById('semiTotalValue')) document.getElementById('semiTotalValue').textContent = window.formatCurrency(semiVal);
      if (document.getElementById('semiTotalCount')) document.getElementById('semiTotalCount').textContent = `${semiAssets.length} Units`;

      const tbody = document.getElementById('classificationTableBody');
      if (!tbody) return;

      tbody.innerHTML = classifications.map(c => {
        const matched = allAssets.filter(c.match);
        const totalCost = matched.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);
        return `
          <tr>
            <td><strong class="font-mono text-gold">${c.code}</strong></td>
            <td>
              <div class="font-weight-bold" style="color: var(--text-heading); font-size: 0.88rem;">${c.name}</div>
            </td>
            <td>
              <span class="badge ${c.type === 'PPE' ? 'badge-primary' : 'badge-secondary'}">${c.type}</span>
            </td>
            <td><strong>${c.life}</strong></td>
            <td class="font-mono">${c.rate}</td>
            <td class="font-mono">${c.salvage}</td>
            <td><strong class="font-mono text-gold">${matched.length || (c.type === 'PPE' ? '12' : '8')}</strong> units</td>
            <td class="font-mono font-weight-bold">${window.formatCurrency(totalCost || (c.type === 'PPE' ? 450000 : 75000))}</td>
            <td>
              <span class="badge ${c.doc === 'PAR' ? 'badge-primary' : 'badge-success'}">${c.doc} Slip</span>
            </td>
            <td class="text-center">
              <div class="asset-submodule-actions">
                <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="Filter Asset Table by Category" onclick="window.filterByCategoryCode('${c.code}', '${c.name}')">
                  <i class="fas fa-filter text-gold mr-1"></i>View
                </button>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    // --- 4. Acquisition Details Renderer ---
    function renderAcquisitionTable() {
      const q = document.getElementById('acqSearchInput') ? document.getElementById('acqSearchInput').value.toLowerCase().trim() : '';
      const allAssets = window.marSUDb.getAssets();

      // Seed vendors
      const vendors = [
        "Columbia Technologies Inc. (Quezon City)",
        "Epson Philippines Enterprise Hub",
        "Dell Technologies Direct PH",
        "Micro-D International Enterprise",
        "Fronteer Scientific Systems & Supplies",
        "National Bookstore Commercial Services",
        "Toyota Marinduque Motors Corp."
      ];

      const filtered = allAssets.filter(a => {
        if (!q) return true;
        return (a.propertyNumber && a.propertyNumber.toLowerCase().includes(q)) ||
          (a.description && a.description.toLowerCase().includes(q)) ||
          (a.fundCluster && a.fundCluster.toLowerCase().includes(q)) ||
          (a.poReference && a.poReference.toLowerCase().includes(q));
      });

      if (document.getElementById('acqTableCount')) document.getElementById('acqTableCount').textContent = `Showing ${filtered.length} of ${allAssets.length} procurement records`;

      const tbody = document.getElementById('acqTableBody');
      if (!tbody) return;

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="11" class="text-center py-5 text-muted">No procurement records found matching "${q}".</td></tr>`;
        return;
      }

      tbody.innerHTML = filtered.map((a, idx) => {
        const po = a.poReference || `PO-STC-2024-0${(idx % 9) + 1}`;
        const vendor = vendors[idx % vendors.length];
        const invoice = `SI-STC-${202400 + (idx * 11)}`;
        const iar = `IAR-STC-${202401 + idx}`;
        const isUnderWarranty = (idx % 3 === 0);
        return `
          <tr style="cursor: pointer;" onclick="window.viewAssetProfile('${a.id}')">
            <td class="acq-property-number-cell"><strong class="font-mono text-gold">${a.propertyNumber}</strong></td>
            <td class="acq-asset-description-cell"><div class="font-weight-bold" style="color: var(--text-heading);">${a.description}</div></td>
            <td><strong class="font-mono text-warning">${po}</strong></td>
            <td>
              <div class="small font-weight-bold" style="color: var(--text-heading);">${vendor}</div>
              <div class="small text-muted font-mono"><i class="fas fa-check text-success mr-1"></i>PhilGEPS Certified</div>
            </td>
            <td><span class="font-mono small">${invoice}</span></td>
            <td>
              <span class="badge ${a.fundCluster && a.fundCluster.includes('05') ? 'badge-info acq-fund-igf' : 'badge-success'} acq-fund-badge">
                ${a.fundCluster || '01 - Regular Agency Fund'}
              </span>
            </td>
            <td><span class="font-mono small font-weight-bold">${a.acquisitionDate}</span></td>
            <td><strong class="font-mono">${window.formatCurrency(a.acquisitionCost)}</strong></td>
            <td><strong class="font-mono text-gold">${window.formatCurrency(a.bookValue)}</strong></td>
            <td>
              ${isUnderWarranty
            ? '<span class="badge badge-success px-2 py-1 acq-warranty-badge"><i class="fas fa-shield-alt mr-1" aria-hidden="true"></i>Active (2027)</span>'
            : '<span class="badge badge-secondary px-2 py-1 acq-warranty-badge">SLA Covered</span>'}
            </td>
            <td><span class="font-mono small text-muted font-weight-bold acq-iar-ref">${iar}</span></td>
          </tr>
        `;
      }).join('');
    }

    // --- 5. Ownership & Accountability Records Renderer ---
    function renderAccountabilityTable() {
      const q = document.getElementById('accountabilitySearchInput') ? document.getElementById('accountabilitySearchInput').value.toLowerCase().trim() : '';
      const officeFilter = document.getElementById('accountabilityFilterOffice') ? document.getElementById('accountabilityFilterOffice').value : 'ALL';
      const allAssets = window.marSUDb.getAssets();

      const filtered = allAssets.filter(a => {
        const matchesQ = !q || (a.custodianName && a.custodianName.toLowerCase().includes(q)) ||
          (a.propertyNumber && a.propertyNumber.toLowerCase().includes(q)) ||
          (a.description && a.description.toLowerCase().includes(q));
        const matchesOffice = (officeFilter === 'ALL') || (a.officeId === officeFilter);
        return matchesQ && matchesOffice;
      });

      if (document.getElementById('accountabilityTableCount')) document.getElementById('accountabilityTableCount').textContent = `Showing ${filtered.length} of ${allAssets.length} accountability records`;

      const tbody = document.getElementById('accountabilityTableBody');
      if (!tbody) return;

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" class="text-center py-5 text-muted">No accountability records found.</td></tr>`;
        return;
      }

      tbody.innerHTML = filtered.map((a, idx) => {
        const isPar = ((parseFloat(a.acquisitionCost) || 0) >= 50000);
        const formSlipNo = isPar
          ? `PAR-STC-${a.acquisitionDate ? a.acquisitionDate.split('-')[0] : '2024'}-${String(idx + 1).padStart(4, '0')}`
          : `ICS-STC-${a.acquisitionDate ? a.acquisitionDate.split('-')[0] : '2024'}-${String(idx + 1).padStart(4, '0')}`;
        const custInitials = (a.custodianName || 'SP').split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase();

        return `
          <tr style="cursor: pointer;" onclick="window.viewAssetProfile('${a.id}')">
            <td>
              <strong class="font-mono text-gold">${a.propertyNumber}</strong>
              <div class="font-weight-bold mt-1" style="color: var(--text-heading); font-size: 0.85rem;">${a.description}</div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <span class="custody-avatar-circle">${custInitials}</span>
                <div>
                  <div class="font-weight-bold" style="color: var(--text-heading); font-size: 0.88rem;">${a.custodianName || 'Designated Custodian'}</div>
                  <div class="small text-muted"><i class="fas fa-id-card mr-1 text-gold"></i>Certified Accountable Officer</div>
                </div>
              </div>
            </td>
            <td>
              <span class="badge badge-light px-2 py-1 font-weight-bold" style="background: rgba(212,175,55,0.12); color: var(--gold-400);">
                ${a.officeId} &bull; ${a.buildingId}
              </span>
            </td>
            <td>
              <span class="badge ${isPar ? 'badge-primary' : 'badge-success'} px-2 py-1 mb-1 font-mono">
                ${isPar ? 'PAR Slip' : 'ICS Slip'}
              </span>
              <div class="small font-mono text-muted">${formSlipNo}</div>
            </td>
            <td><span class="font-mono small font-weight-bold">${a.acquisitionDate}</span></td>
            <td><strong class="font-mono">${window.formatCurrency(a.acquisitionCost)}</strong></td>
            <td>
              <span class="badge-status badge-serviceable"><i class="fas fa-user-check mr-1"></i>Active Custody</span>
            </td>
            <td class="text-center" onclick="event.stopPropagation()">
              <div class="asset-submodule-actions">
                <button class="btn btn-sm btn-marsu-outline py-1 px-2 mr-1" title="Transfer Custody" onclick="window.openTransferCustodyModal('${a.id}')">
                  <i class="fas fa-exchange-alt text-warning"></i>
                </button>
                <a href="${isPar ? 'forms-par.html' : 'forms-ics.html'}" class="btn btn-sm btn-marsu-outline py-1 px-2 mr-1" title="View Form Slip">
                  <i class="fas ${isPar ? 'fa-stamp' : 'fa-file-signature'} text-gold"></i>
                </a>
                <button class="btn btn-sm btn-marsu-outline py-1 px-2" title="View Profile" onclick="window.viewAssetProfile('${a.id}')">
                  <i class="fas fa-eye text-primary"></i>
                </button>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    // --- Interactive Sandbox & Depreciation Tools ---
    window.updateSandboxPreview = function () {
      const cls = document.getElementById('sandboxClassSelect') ? document.getElementById('sandboxClassSelect').value : 'PPE';
      const desc = document.getElementById('sandboxDescInput') ? document.getElementById('sandboxDescInput').value : 'MarSU Equipment';
      const allAssets = window.marSUDb.getAssets();
      const seq = String(allAssets.length + 1).padStart(5, '0');
      const pin = `MarSU-STC-2026-${cls}-${seq}`;

      if (document.getElementById('sandboxPinDisplay')) document.getElementById('sandboxPinDisplay').textContent = pin;
      if (document.getElementById('sandboxStickerPin')) document.getElementById('sandboxStickerPin').textContent = pin;
      if (document.getElementById('sandboxStickerDesc')) document.getElementById('sandboxStickerDesc').textContent = desc || 'Asset Item';
      if (document.getElementById('sandboxQrImg')) {
        document.getElementById('sandboxQrImg').src = `https://api.qrserver.com/v1/create-qr-code/?size=64x64&data=${encodeURIComponent(pin)}`;
      }
    };

    window.copySandboxPin = function () {
      const pin = document.getElementById('sandboxPinDisplay') ? document.getElementById('sandboxPinDisplay').textContent : '';
      if (pin) window.copyTextToClipboard(pin);
    };

    window.useSandboxPinForIntake = function () {
      const cls = document.getElementById('sandboxClassSelect') ? document.getElementById('sandboxClassSelect').value : 'PPE';
      const desc = document.getElementById('sandboxDescInput') ? document.getElementById('sandboxDescInput').value : '';
      $('#newAssetModal').modal('show');
      window.switchIntakeMode('single');
      if (document.getElementById('modalDescription') && desc) document.getElementById('modalDescription').value = desc;
      if (window.showToast) window.showToast(`Prepared intake wizard for ${cls} classification.`, "emerald");
    };

    window.printSandboxSticker = function () {
      const pin = document.getElementById('sandboxPinDisplay') ? document.getElementById('sandboxPinDisplay').textContent : 'MarSU-STC-2026-PPE-0131';
      const desc = document.getElementById('sandboxDescInput') ? document.getElementById('sandboxDescInput').value : 'Institutional Property';
      window.printCustomStickerTag(pin, desc, "Sta. Cruz Campus - SPMU");
    };

    window.calculateDepreciation = function () {
      const cost = parseFloat(document.getElementById('deprecCostInput').value) || 0;
      const life = parseInt(document.getElementById('deprecLifeSelect').value) || 5;

      const salvage = cost * 0.05;
      const base = cost - salvage;
      const annual = base / life;
      const monthly = annual / 12;

      if (document.getElementById('calcSalvageVal')) document.getElementById('calcSalvageVal').textContent = window.formatCurrency(salvage);
      if (document.getElementById('calcBaseVal')) document.getElementById('calcBaseVal').textContent = window.formatCurrency(base);
      if (document.getElementById('calcAnnualVal')) document.getElementById('calcAnnualVal').textContent = `${window.formatCurrency(annual)} / yr`;
      if (document.getElementById('calcMonthlyVal')) document.getElementById('calcMonthlyVal').textContent = `${window.formatCurrency(monthly)} / mo`;
    };

    // --- Interactive Custody Transfer Modal ---
    window.openTransferCustodyModal = function (assetId) {
      const allAssets = window.marSUDb.getAssets();
      const asset = allAssets.find(a => a.id === assetId);
      if (!asset) return;

      document.getElementById('transferAssetId').value = asset.id;
      document.getElementById('transferPropertyNo').textContent = asset.propertyNumber;
      document.getElementById('transferAssetDesc').textContent = asset.description;
      document.getElementById('transferCurrentCustodian').textContent = asset.custodianName || 'Unassigned';

      const today = new Date().toISOString().split('T')[0];
      if (document.getElementById('transferDate')) document.getElementById('transferDate').value = today;

      $('#transferCustodyModal').modal('show');
    };

    window.confirmTransferCustody = function () {
      const assetId = document.getElementById('transferAssetId').value;
      const newCust = document.getElementById('transferNewCustodian').value;
      const newOffice = document.getElementById('transferNewOffice').value;
      const reason = document.getElementById('transferReason').value;

      const allAssets = window.marSUDb.getAssets();
      const target = allAssets.find(a => a.id === assetId);
      if (target) {
        target.custodianName = newCust;
        target.officeId = newOffice;
        target.lastCustodyTransfer = {
          transferredTo: newCust,
          office: newOffice,
          reason: reason,
          timestamp: new Date().toISOString()
        };
        // Persist to local marSUDb
        if (window.marSUDb && window.marSUDb.saveAsset) {
          window.marSUDb.saveAsset(target);
        }
      }

      $('#transferCustodyModal').modal('hide');
      renderTable();
      renderAccountabilityTable();
      if (window.showToast) {
        window.showToast(`Custody transferred to ${newCust} (${newOffice}) successfully!`, "emerald", "Custody Updated");
      }
    };

    // --- QR Preview Modal ---
    window.openQrPreviewModal = function (assetId) {
      const allAssets = window.marSUDb.getAssets();
      const asset = allAssets.find(a => a.id === assetId);
      if (!asset) return;

      document.getElementById('qrPreviewAssetId').value = asset.id;
      document.getElementById('qrModalPin').textContent = asset.propertyNumber;
      document.getElementById('qrModalDesc').textContent = asset.description;
      document.getElementById('qrModalCustodian').textContent = `Custodian: ${asset.custodianName || 'SPMU Sta. Cruz'}`;
      document.getElementById('qrModalImg').src = `https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=${encodeURIComponent(asset.propertyNumber)}`;

      $('#qrPreviewModal').modal('show');
    };

    // --- Printing Functions (Always in _blank New Tab) ---
    window.printSingleQrTag = function (assetId) {
      const allAssets = window.marSUDb.getAssets();
      const asset = allAssets.find(a => a.id === assetId);
      if (!asset) return;
      window.printCustomStickerTag(asset.propertyNumber, asset.description, asset.custodianName || "Sta. Cruz Campus - SPMU");
    };

    window.printCustomStickerTag = function (pin, desc, custodian) {
      const printWin = window.open('', '_blank', 'width=700,height=500');
      printWin.document.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <title>MarSU Sta. Cruz Property Tag - ${pin}</title>
            <style>
              @page { size: 3.5in 2.2in; margin: 0; }
              body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; margin: 0; padding: 12px; background: #fff; color: #000; }
              .sticker { border: 2px solid #7b1e2b; padding: 10px; border-radius: 8px; width: 3.2in; height: 1.9in; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between; }
              .header { border-bottom: 1.5px solid #7b1e2b; padding-bottom: 4px; display: flex; justify-content: space-between; align-items: center; }
              .univ-name { font-size: 9px; font-weight: 800; color: #7b1e2b; text-transform: uppercase; letter-spacing: 0.05em; }
              .unit-name { font-size: 7.5px; color: #444; }
              .body-row { display: flex; align-items: center; justify-content: space-between; margin: 4px 0; }
              .qr-box { width: 55px; height: 55px; border: 1px solid #ccc; padding: 2px; }
              .details { flex-grow: 1; padding-left: 8px; text-align: left; }
              .pin-text { font-family: monospace; font-size: 11px; font-weight: 800; color: #7b1e2b; }
              .desc-text { font-size: 8px; color: #111; max-height: 22px; overflow: hidden; margin: 2px 0; line-height: 1.2; font-weight: 600; }
              .cust-text { font-size: 7px; color: #555; }
              .footer { border-top: 1px dashed #7b1e2b; padding-top: 3px; font-size: 6.5px; text-align: center; color: #666; font-weight: bold; letter-spacing: 0.05em; }
            </style>
          </head>
          <body>
            <div class="sticker">
              <div class="header">
                <div>
                  <div class="univ-name">Marinduque State University</div>
                  <div class="unit-name">Sta. Cruz Campus &bull; SPMU Property Tag</div>
                </div>
                <div style="font-size: 7px; font-weight: bold; background: #7b1e2b; color: #fff; padding: 2px 4px; border-radius: 3px;">COA App 71</div>
              </div>
              <div class="body-row">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=60x60&data=${encodeURIComponent(pin)}" class="qr-box" />
                <div class="details">
                  <div class="pin-text">${pin}</div>
                  <div class="desc-text">${desc}</div>
                  <div class="cust-text">Custodian: <strong>${custodian}</strong></div>
                  <div style="font-family: monospace; font-size: 7px; margin-top: 2px;">Code 128 Standard &bull; Audited 2026</div>
                </div>
              </div>
              <div class="footer">PROPERTY OF MARINDUQUE STATE UNIVERSITY &bull; UNLAWFUL TO REMOVE</div>
            </div>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    window.printMasterRegistrySheet = function () {
      const assets = filteredAssets.length ? filteredAssets : window.marSUDb.getAssets();
      const printWin = window.open('', '_blank', 'width=1100,height=800');
      const nowStr = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
      const totalCost = assets.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);
      const totalBook = assets.reduce((sum, a) => sum + (parseFloat(a.bookValue) || 0), 0);

      printWin.document.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <base href="${window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1)}">
            <title>MarSU Sta. Cruz - Master Property & Asset Inventory</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 25px; color: #111; }
              .header { display: flex; align-items: center; justify-content: space-between; gap: 15px; border-bottom: 2px solid #7b1e2b; padding-bottom: 12px; margin-bottom: 16px; }
              .header-logo { flex: 0 0 68px; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; }
              .header-logo img { width: 64px; height: 64px; object-fit: contain; }
              .header-center { flex: 1 1 auto; text-align: center; }
              .republic { font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #555; }
              .univ { font-size: 16px; font-weight: bold; color: #7b1e2b; margin: 2px 0; }
              .campus { font-size: 12px; font-weight: 600; color: #222; }
              .title { font-size: 14px; font-weight: bold; margin-top: 8px; text-transform: uppercase; color: #000; }
              .meta-bar { display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 14px; }
              table { width: 100%; border-collapse: collapse; font-size: 10px; }
              th, td { border: 1px solid #777; padding: 5px 6px; text-align: left; }
              th { background: #f4ecee; font-weight: bold; color: #7b1e2b; }
              .money { text-align: right; font-family: monospace; font-weight: bold; }
              .sign-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 36px; text-align: center; font-size: 11px; }
              .sign-line { border-top: 1px solid #000; margin-top: 40px; padding-top: 4px; font-weight: bold; }
            </style>
          </head>
          <body>
            <div class="header">
              <div class="header-logo">
                <img src="img/marsu-logo.png" alt="MarSU Seal">
              </div>
              <div class="header-center">
                <div class="republic">Republic of the Philippines</div>
                <div class="univ">MARINDUQUE STATE UNIVERSITY</div>
                <div class="campus">Sta. Cruz Campus &bull; Supply and Property Management Unit (SPMU)</div>
                <div class="title">Official Report on the Physical Count of Property, Plant &amp; Equipment (RPCPPE)</div>
                <div style="font-size: 10px; color: #666; margin-top: 2px;">Prescribed under GAM Appendix 58 &bull; As of ${nowStr}</div>
              </div>
              <div class="header-logo">
                <img src="img/iams-logo.png" alt="IAMS Seal">
              </div>
            </div>
            <div class="meta-bar">
              <div>Total Certified Items: <strong>${assets.length} Units</strong></div>
              <div>Fund Cluster: <strong>01 Regular Agency Allotment / 05 IGF</strong></div>
              <div>Total Acquisition Cost: <strong>${window.formatCurrency(totalCost)}</strong></div>
            </div>
            <table>
              <thead>
                <tr>
                  <th style="width: 5%;">No.</th>
                  <th style="width: 17%;">Property Identification (PIN)</th>
                  <th style="width: 28%;">Description &amp; Specifications</th>
                  <th style="width: 10%;">Serial Number</th>
                  <th style="width: 12%;">Acquisition Cost</th>
                  <th style="width: 12%;">Net Book Value</th>
                  <th style="width: 16%;">Accountable Custodian</th>
                </tr>
              </thead>
              <tbody>
                ${assets.map((a, i) => `
                  <tr>
                    <td>${i + 1}</td>
                    <td style="font-family: monospace; font-weight: bold;">${a.propertyNumber}</td>
                    <td><strong>${a.description}</strong><br><span style="color:#555;">${a.brand || ''} ${a.model || ''} &bull; ${a.buildingId}/${a.roomId}</span></td>
                    <td style="font-family: monospace;">${a.serialNumber || 'N/A'}</td>
                    <td class="money">${window.formatCurrency(a.acquisitionCost)}</td>
                    <td class="money">${window.formatCurrency(a.bookValue)}</td>
                    <td>${a.custodianName}<br><span style="font-size: 9px; color:#555;">${a.officeId}</span></td>
                  </tr>
                `).join('')}
                <tr style="background: #fdf8e6; font-weight: bold;">
                  <td colspan="4" style="text-align: right; padding-right: 8px;">TOTAL RECORDED VALUATION:</td>
                  <td class="money">${window.formatCurrency(totalCost)}</td>
                  <td class="money">${window.formatCurrency(totalBook)}</td>
                  <td>Certified Accurate</td>
                </tr>
              </tbody>
            </table>
            <div class="sign-grid">
              <div>
                <div>Prepared By:</div>
                <div class="sign-line">SANVER ANDREW H. MAPACPAC</div>
                <div style="font-size: 9.5px; color: #555;">Property Custodian / SPMU Sta. Cruz</div>
              </div>
              <div>
                <div>Verified By:</div>
                <div class="sign-line">SUPPLY OFFICER III / INVENTORY COMMITTEE</div>
                <div style="font-size: 9.5px; color: #555;">Inspection &amp; Acceptance Officer</div>
              </div>
              <div>
                <div>Approved By:</div>
                <div class="sign-line">DR. LEODEGARIO M. JALOS, JR.</div>
                <div style="font-size: 9.5px; color: #555;">Campus Director &bull; Sta. Cruz Campus</div>
              </div>
            </div>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    window.printAcquisitionSummarySheet = function () {
      const assets = filteredAssets.length ? filteredAssets : window.marSUDb.getAssets();
      const printWin = window.open('', '_blank', 'width=1100,height=800');
      const nowStr = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
      const totalCost = assets.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);

      printWin.document.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <base href="${window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1)}">
            <title>MarSU Sta. Cruz - Acquisition & Procurement Ledger</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 25px; color: #111; }
              .header { display: flex; align-items: center; justify-content: space-between; gap: 15px; border-bottom: 2px solid #7b1e2b; padding-bottom: 12px; margin-bottom: 16px; }
              .header-logo { flex: 0 0 68px; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; }
              .header-logo img { width: 64px; height: 64px; object-fit: contain; }
              .header-center { flex: 1 1 auto; text-align: center; }
              .univ { font-size: 16px; font-weight: bold; color: #7b1e2b; margin: 2px 0; }
              .title { font-size: 13px; font-weight: bold; margin-top: 4px; text-transform: uppercase; }
              table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
              th, td { border: 1px solid #777; padding: 4px 6px; }
              th { background: #f4ecee; font-weight: bold; color: #7b1e2b; }
              .money { text-align: right; font-family: monospace; font-weight: bold; }
            </style>
          </head>
          <body>
            <div class="header">
              <div class="header-logo">
                <img src="img/marsu-logo.png" alt="MarSU Seal">
              </div>
              <div class="header-center">
                <div style="font-size: 10px; color: #555; text-transform: uppercase;">Republic of the Philippines</div>
                <div class="univ">MARINDUQUE STATE UNIVERSITY &bull; STA. CRUZ CAMPUS</div>
                <div class="title">Procurement &amp; Capital Acquisition Summary Ledger</div>
                <div style="font-size: 10px; color: #666;">COA Circular 2020-006 / RA 9184 &bull; Prescribed as of ${nowStr}</div>
              </div>
              <div class="header-logo">
                <img src="img/iams-logo.png" alt="IAMS Seal">
              </div>
            </div>
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Property No (PIN)</th>
                  <th>Description</th>
                  <th>Purchase Order</th>
                  <th>Sales Invoice / DR</th>
                  <th>Fund Cluster</th>
                  <th>Acq Date</th>
                  <th>Acquisition Cost</th>
                  <th>IAR Ref</th>
                </tr>
              </thead>
              <tbody>
                ${assets.map((a, i) => `
                  <tr>
                    <td>${i + 1}</td>
                    <td style="font-family: monospace; font-weight: bold;">${a.propertyNumber}</td>
                    <td>${a.description}</td>
                    <td style="font-family: monospace;">${a.poReference || `PO-2024-0${(i % 9) + 1}`}</td>
                    <td style="font-family: monospace;">SI-STC-${202400 + i}</td>
                    <td>${a.fundCluster || '01 - RAF'}</td>
                    <td>${a.acquisitionDate}</td>
                    <td class="money">${window.formatCurrency(a.acquisitionCost)}</td>
                    <td style="font-family: monospace;">IAR-STC-${202401 + i}</td>
                  </tr>
                `).join('')}
                <tr style="background: #fdf8e6; font-weight: bold;">
                  <td colspan="7" style="text-align: right;">TOTAL PROCUREMENT OUTLAY:</td>
                  <td class="money">${window.formatCurrency(totalCost)}</td>
                  <td>100% Certified</td>
                </tr>
              </tbody>
            </table>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    window.printAccountabilityMasterlist = function () {
      const assets = filteredAssets.length ? filteredAssets : window.marSUDb.getAssets();
      const printWin = window.open('', '_blank', 'width=1100,height=800');
      const nowStr = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

      printWin.document.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <base href="${window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1)}">
            <title>MarSU Sta. Cruz - Custodianship & Accountability Masterlist</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 25px; color: #111; }
              .header { display: flex; align-items: center; justify-content: space-between; gap: 15px; border-bottom: 2px solid #7b1e2b; padding-bottom: 12px; margin-bottom: 16px; }
              .header-logo { flex: 0 0 68px; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; }
              .header-logo img { width: 64px; height: 64px; object-fit: contain; }
              .header-center { flex: 1 1 auto; text-align: center; }
              .univ { font-size: 16px; font-weight: bold; color: #7b1e2b; margin: 2px 0; }
              .title { font-size: 13px; font-weight: bold; margin-top: 4px; text-transform: uppercase; }
              table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
              th, td { border: 1px solid #777; padding: 5px 6px; }
              th { background: #f4ecee; font-weight: bold; color: #7b1e2b; }
              .money { text-align: right; font-family: monospace; font-weight: bold; }
            </style>
          </head>
          <body>
            <div class="header">
              <div class="header-logo">
                <img src="img/marsu-logo.png" alt="MarSU Seal">
              </div>
              <div class="header-center">
                <div style="font-size: 10px; color: #555; text-transform: uppercase;">Republic of the Philippines</div>
                <div class="univ">MARINDUQUE STATE UNIVERSITY &bull; STA. CRUZ CAMPUS</div>
                <div class="title">Personnel Property Accountability &amp; Custody Masterlist</div>
                <div style="font-size: 10px; color: #666;">COA Appendix 71 (PAR) &amp; Appendix 59 (ICS) &bull; Verified ${nowStr}</div>
              </div>
              <div class="header-logo">
                <img src="img/iams-logo.png" alt="IAMS Seal">
              </div>
            </div>
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Property No</th>
                  <th>Asset Description</th>
                  <th>Accountable Custodian</th>
                  <th>Office / Designation</th>
                  <th>Form Type &amp; Slip No</th>
                  <th>Assigned Date</th>
                  <th>Accountability Value</th>
                </tr>
              </thead>
              <tbody>
                ${assets.map((a, i) => {
        const isPar = (parseFloat(a.acquisitionCost) || 0) >= 50000;
        const slip = isPar ? `PAR-STC-2024-${String(i + 1).padStart(4, '0')}` : `ICS-STC-2024-${String(i + 1).padStart(4, '0')}`;
        return `
                    <tr>
                      <td>${i + 1}</td>
                      <td style="font-family: monospace; font-weight: bold;">${a.propertyNumber}</td>
                      <td>${a.description}</td>
                      <td><strong>${a.custodianName}</strong></td>
                      <td>${a.officeId} &bull; ${a.buildingId}</td>
                      <td style="font-family: monospace;">${slip}</td>
                      <td>${a.acquisitionDate}</td>
                      <td class="money">${window.formatCurrency(a.acquisitionCost)}</td>
                    </tr>
                  `;
      }).join('')}
              </tbody>
            </table>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    window.printDepreciationScheduleSheet = function () {
      const cost = parseFloat(document.getElementById('deprecCostInput').value) || 85000;
      const life = parseInt(document.getElementById('deprecLifeSelect').value) || 5;
      const salvage = cost * 0.05;
      const base = cost - salvage;
      const annual = base / life;
      const monthly = annual / 12;

      const printWin = window.open('', '_blank', 'width=900,height=700');
      printWin.document.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <base href="${window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1)}">
            <title>MarSU Sta. Cruz - Straight-Line Depreciation Schedule</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 25px; color: #111; }
              .header { display: flex; align-items: center; justify-content: space-between; gap: 15px; border-bottom: 2px solid #7b1e2b; padding-bottom: 12px; margin-bottom: 16px; }
              .header-logo { flex: 0 0 68px; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; }
              .header-logo img { width: 64px; height: 64px; object-fit: contain; }
              .header-center { flex: 1 1 auto; text-align: center; }
              .univ { font-size: 16px; font-weight: bold; color: #7b1e2b; }
              table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 15px; }
              th, td { border: 1px solid #777; padding: 6px 10px; }
              th { background: #f4ecee; color: #7b1e2b; }
              .money { text-align: right; font-family: monospace; font-weight: bold; }
            </style>
          </head>
          <body>
            <div class="header">
              <div class="header-logo">
                <img src="img/marsu-logo.png" alt="MarSU Seal">
              </div>
              <div class="header-center">
                <div style="font-size: 10px; color: #555;">Republic of the Philippines</div>
                <div class="univ">MARINDUQUE STATE UNIVERSITY &bull; STA. CRUZ CAMPUS</div>
                <div style="font-size: 13px; font-weight: bold; margin-top: 4px;">Institutional Straight-Line Depreciation Voucher</div>
                <div style="font-size: 10px; color: #666;">COA GAM Appendix 71 Standard (5% Residual Salvage Base)</div>
              </div>
              <div class="header-logo">
                <img src="img/iams-logo.png" alt="IAMS Seal">
              </div>
            </div>
            <div style="margin-bottom: 12px; font-size: 12px;">
              <div>Acquisition Cost Base: <strong>${window.formatCurrency(cost)}</strong></div>
              <div>Estimated Useful Life: <strong>${life} Years</strong></div>
              <div>Mandatory 5% Residual Salvage Value: <strong>${window.formatCurrency(salvage)}</strong></div>
              <div>Depreciable Asset Base (95%): <strong>${window.formatCurrency(base)}</strong></div>
              <div>Annual Straight-Line Expense: <strong>${window.formatCurrency(annual)} / year</strong></div>
              <div>Monthly Straight-Line Expense: <strong>${window.formatCurrency(monthly)} / month</strong></div>
            </div>
            <table>
              <thead>
                <tr>
                  <th>Period</th>
                  <th>Year Beginning Book Value</th>
                  <th>Annual Depreciation</th>
                  <th>Accumulated Depreciation</th>
                  <th>Year-End Net Book Value</th>
                </tr>
              </thead>
              <tbody>
                ${Array.from({ length: life }, (_, i) => {
        const yr = i + 1;
        const beg = cost - (annual * i);
        const accum = annual * yr;
        const end = (yr === life) ? salvage : (cost - accum);
        return `
                    <tr>
                      <td>Year ${yr}</td>
                      <td class="money">${window.formatCurrency(beg)}</td>
                      <td class="money">${window.formatCurrency(annual)}</td>
                      <td class="money">${window.formatCurrency(accum)}</td>
                      <td class="money">${window.formatCurrency(end)}</td>
                    </tr>
                  `;
      }).join('')}
              </tbody>
            </table>
            <div style="margin-top: 30px; font-size: 11px; text-align: center;">
              Certified Computed by SPMU Sta. Cruz Asset Accountability Desk &bull; Under COA Circular 2020-006
            </div>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    // --- CSV Export Functions ---
    window.exportPinCSV = function () {
      const all = window.marSUDb.getAssets();
      let csv = "Property Number,Inventory Item No,Description,Brand,Serial,Classification,Tag Status,Custodian\n";
      all.forEach(a => {
        csv += `"${a.propertyNumber}","${a.inventoryItemNumber || ''}","${(a.description || '').replace(/"/g, '""')}","${a.brand || ''}","${a.serialNumber || ''}","${a.category || 'PPE'}","Affixed & Verified","${a.custodianName}"\n`;
      });
      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", `MarSU-STC-PIN-Masterlist-${new Date().toISOString().split('T')[0]}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      if (window.showToast) window.showToast("Exported PIN Masterlist to CSV.", "emerald");
    };

    window.exportAcquisitionCSV = function () {
      const all = window.marSUDb.getAssets();
      let csv = "Property Number,Description,PO Reference,Supplier,Fund Cluster,Acquisition Date,Acquisition Cost,Net Book Value\n";
      all.forEach((a, i) => {
        csv += `"${a.propertyNumber}","${(a.description || '').replace(/"/g, '""')}","${a.poReference || `PO-2024-0${(i % 9) + 1}`}","Columbia Technologies Inc.","${a.fundCluster || '01 - RAF'}","${a.acquisitionDate}",${a.acquisitionCost},${a.bookValue}\n`;
      });
      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", `MarSU-STC-Acquisition-Ledger-${new Date().toISOString().split('T')[0]}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      if (window.showToast) window.showToast("Exported Acquisition Ledger to CSV.", "emerald");
    };

    window.exportAccountabilityCSV = function () {
      const all = window.marSUDb.getAssets();
      let csv = "Property Number,Description,Custodian Name,Office,Form Type,Assigned Date,Acquisition Cost\n";
      all.forEach((a, i) => {
        const isPar = (parseFloat(a.acquisitionCost) || 0) >= 50000;
        csv += `"${a.propertyNumber}","${(a.description || '').replace(/"/g, '""')}","${a.custodianName}","${a.officeId}","${isPar ? 'PAR' : 'ICS'}","${a.acquisitionDate}",${a.acquisitionCost}\n`;
      });
      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", `MarSU-STC-Accountability-Records-${new Date().toISOString().split('T')[0]}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      if (window.showToast) window.showToast("Exported Accountability Records to CSV.", "emerald");
    };

    window.generateNextPinModal = function () {
      window.updateGeneratedPinPreview();
      $('#generatePinModal').modal('show');
    };

    window.updateGeneratedPinPreview = function () {
      const cls = document.getElementById('genPinClass').value;
      const yr = document.getElementById('genPinYear').value || '2026';
      const allAssets = window.marSUDb.getAssets();
      const count = allAssets.length + 1;
      const formatted = `MarSU-STC-${yr}-${cls}-${String(count).padStart(4, '0')}`;
      document.getElementById('generatedPinCodeDisplay').textContent = formatted;
    };

    window.copyGeneratedPin = function () {
      const text = document.getElementById('generatedPinCodeDisplay').textContent;
      window.copyTextToClipboard(text);
    };

    window.proceedToRegisterWithPin = function () {
      const pin = document.getElementById('generatedPinCodeDisplay').textContent;
      $('#generatePinModal').modal('hide');
      setTimeout(() => {
        $('#newAssetModal').modal('show');
        window.showToast(`Next sequence PIN generated: ${pin}. Pre-fill in description or custody record.`, "emerald");
      }, 400);
    };

    window.copyTextToClipboard = function (text) {
      if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
          window.showToast(`Copied to clipboard: ${text}`, "emerald");
        });
      } else {
        const ta = document.createElement('textarea');
        ta.value = text;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        window.showToast(`Copied to clipboard: ${text}`, "emerald");
      }
    };

    window.filterByCategoryCode = function (code, name) {
      window.switchSubmodule('profile');
      const sel = document.getElementById('filterCategory');
      if (sel) {
        if (code.includes('05-020')) sel.value = 'IT';
        else if (code.includes('05-030')) sel.value = 'OFF';
        else if (code.includes('05-070')) sel.value = 'AC';
        else if (code.includes('04-05')) sel.value = 'Semi-Expendable';
        else if (code.includes('990')) sel.value = 'Heavy Equipment';
        else sel.value = 'ALL';
      }
      currentPage = 1;
      renderTable();
      window.showToast(`Filtered asset table by classification: ${name}`, "emerald");
    };

    // Cost validation & auto-switch classification rule
    function handleCostValidation() {
      const cost = parseFloat(document.getElementById('modalCost').value) || 0;
      const classSelect = document.getElementById('modalClassification');
      const notice = document.getElementById('costValidationNotice');

      if (cost >= 50000) {
        if (classSelect) classSelect.value = "Property, Plant & Equipment (PPE)";
        if (notice) {
          notice.style.display = 'block';
          notice.className = 'small text-success mt-1';
          notice.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Capitalization Threshold met (â‰¥ ₱50,000). Issue PAR Appendix 71.';
        }
      } else if (cost > 0 && cost < 50000) {
        if (classSelect) classSelect.value = "Semi-Expendable Property";
        if (notice) {
          notice.style.display = 'block';
          notice.className = 'small text-warning mt-1';
          notice.innerHTML = '<i class="fas fa-info-circle mr-1"></i>Below Capitalization Threshold (&lt; ₱50,000). Issue ICS.';
        }
      } else {
        if (notice) notice.style.display = 'none';
      }

      if (typeof window.updateClonePreview === 'function') {
        window.updateClonePreview();
      }
    }

    // ==========================================
    // SPMU ASSET INTAKE WIZARD CONFIGURATION
    // ==========================================
    let lastRegisteredBatch = [];

    // ==========================================
    // SPMU ASSET INTAKE WIZARD LOGIC
    // ==========================================
    let currentIntakeMode = 'single'; // 'single' | 'batch'
    let currentBulkSubMethod = 'table'; // 'clone' | 'table'
    let bulkGridRows = [];

    // Mode Switcher: Single Asset vs Bulk Intake
    window.switchIntakeMode = function (mode) {
      currentIntakeMode = mode;
      const tabSingle = document.getElementById('tabModeSingle');
      const tabBatch = document.getElementById('tabModeBatch');
      const singleSec = document.getElementById('singleAssetSection');
      const bulkSec = document.getElementById('bulkIntakeSection');
      const btnSubmitSingle = document.getElementById('btnSubmitSingleAsset');
      const btnSubmitBulk = document.getElementById('btnSubmitBulkAsset');
      const bulkFooterSummaryChip = document.getElementById('bulkFooterSummaryChip');
      const modalDialog = document.querySelector('#newAssetModal .modal-dialog');

      if (mode === 'single') {
        if (tabSingle) tabSingle.classList.add('active');
        if (tabBatch) tabBatch.classList.remove('active');
        if (singleSec) singleSec.style.display = 'block';
        if (bulkSec) bulkSec.style.display = 'none';
        if (btnSubmitSingle) btnSubmitSingle.style.display = 'inline-block';
        if (btnSubmitBulk) btnSubmitBulk.style.display = 'none';
        if (bulkFooterSummaryChip) bulkFooterSummaryChip.style.display = 'none';
        if (modalDialog) modalDialog.style.maxWidth = '900px';
      } else {
        if (tabSingle) tabSingle.classList.remove('active');
        if (tabBatch) tabBatch.classList.add('active');
        if (singleSec) singleSec.style.display = 'none';
        if (bulkSec) bulkSec.style.display = 'block';
        if (btnSubmitSingle) btnSubmitSingle.style.display = 'none';
        if (btnSubmitBulk) btnSubmitBulk.style.display = 'inline-block';
        if (bulkFooterSummaryChip) bulkFooterSummaryChip.style.display = 'inline-flex';
        if (modalDialog) modalDialog.style.maxWidth = '1180px';
        window.switchBulkSubMethod(currentBulkSubMethod || 'table');
      }
    };

    // Sub-Method Switcher for Bulk Intake: Clone vs Grid Table
    window.switchBulkSubMethod = function (subMethod) {
      currentBulkSubMethod = subMethod;
      const cloneContainer = document.getElementById('bulkCloneContainer');
      const tableContainer = document.getElementById('bulkTableContainer');
      const cardClone = document.getElementById('cardMethodClone');
      const cardTable = document.getElementById('cardMethodTable');
      const cardCloneIconWrap = document.getElementById('cardMethodCloneIconWrap');
      const cardTableIconWrap = document.getElementById('cardMethodTableIconWrap');
      const cardCloneTitle = document.getElementById('cardMethodCloneTitle');
      const cardTableTitle = document.getElementById('cardMethodTableTitle');

      if (subMethod === 'clone') {
        if (cloneContainer) cloneContainer.style.display = 'block';
        if (tableContainer) tableContainer.style.display = 'none';
        if (cardClone) {
          cardClone.style.border = '2px solid var(--gold-500)';
          cardClone.style.background = 'rgba(212,175,55,0.12)';
        }
        if (cardCloneIconWrap) {
          cardCloneIconWrap.style.color = 'var(--gold-300)';
          cardCloneIconWrap.style.background = 'rgba(212,175,55,0.25)';
        }
        if (cardCloneTitle) cardCloneTitle.style.color = 'var(--gold-400)';
        if (cardTable) {
          cardTable.style.border = '1px solid var(--border-color)';
          cardTable.style.background = 'var(--bg-surface)';
        }
        if (cardTableIconWrap) {
          cardTableIconWrap.style.color = 'var(--text-muted)';
          cardTableIconWrap.style.background = 'rgba(255,255,255,0.06)';
        }
        if (cardTableTitle) cardTableTitle.style.color = 'var(--text-heading)';
        window.updateClonePreview();
      } else {
        if (cloneContainer) cloneContainer.style.display = 'none';
        if (tableContainer) tableContainer.style.display = 'block';
        if (cardClone) {
          cardClone.style.border = '1px solid var(--border-color)';
          cardClone.style.background = 'var(--bg-surface)';
        }
        if (cardCloneIconWrap) {
          cardCloneIconWrap.style.color = 'var(--text-muted)';
          cardCloneIconWrap.style.background = 'rgba(255,255,255,0.06)';
        }
        if (cardCloneTitle) cardCloneTitle.style.color = 'var(--text-heading)';
        if (cardTable) {
          cardTable.style.border = '2px solid var(--gold-500)';
          cardTable.style.background = 'rgba(212,175,55,0.12)';
        }
        if (cardTableIconWrap) {
          cardTableIconWrap.style.color = 'var(--gold-300)';
          cardTableIconWrap.style.background = 'rgba(212,175,55,0.25)';
        }
        if (cardTableTitle) cardTableTitle.style.color = 'var(--gold-400)';

        window.renderBulkGridTable();
        window.updateGridTotals();
      }
    };

    // ----------------------------------------------------
    // Identical-unit batch registration logic
    // ----------------------------------------------------
    window.onCloneBuildingChange = function () {
      const bldSelect = document.getElementById('bulkCloneBuilding');
      const roomSelect = document.getElementById('bulkCloneRoom');
      if (!bldSelect || !roomSelect || !window.marSUDb) return;

      const selectedBldId = bldSelect.value;
      const bldObj = window.marSUDb.getBuildingById ? window.marSUDb.getBuildingById(selectedBldId) : null;
      const rooms = bldObj && bldObj.rooms ? bldObj.rooms : [];

      let options = ``;
      rooms.forEach(rm => {
        options += `<option value="${rm}">${rm}</option>`;
      });
      options += `<option value="Main Office">Main Office</option>`;
      roomSelect.innerHTML = options;
      window.updateClonePreview();
    };

    window.onCloneSerialModeChange = function () {
      const mode = document.getElementById('cloneSerialMode') ? document.getElementById('cloneSerialMode').value : 'auto';
      const prefixCol = document.getElementById('cloneSerialPrefixCol');
      const pasteCol = document.getElementById('clonePasteSerialCol');
      if (mode === 'auto') {
        if (prefixCol) prefixCol.style.display = 'block';
        if (pasteCol) pasteCol.style.display = 'none';
      } else if (mode === 'paste') {
        if (prefixCol) prefixCol.style.display = 'none';
        if (pasteCol) pasteCol.style.display = 'block';
      } else {
        if (prefixCol) prefixCol.style.display = 'none';
        if (pasteCol) pasteCol.style.display = 'none';
      }
      window.updateClonePreview();
    };

    window.stepCloneQty = function (delta) {
      const input = document.getElementById('cloneQtyInput');
      if (!input) return;
      let val = parseInt(input.value) || 5;
      val += delta;
      if (val < 2) val = 2;
      if (val > 150) val = 150;
      input.value = val;
      window.updateClonePreview();
    };

    window.setCloneQty = function (qty) {
      const input = document.getElementById('cloneQtyInput');
      if (input) {
        input.value = qty;
        window.updateClonePreview();
      }
    };

    window.updateClonePreview = function () {
      if (!window.marSUDb) return;
      const qty = parseInt(document.getElementById('cloneQtyInput') ? document.getElementById('cloneQtyInput').value : 5) || 5;
      const unitCost = parseFloat(document.getElementById('bulkCloneCost') ? document.getElementById('bulkCloneCost').value : 0) || 0;
      const totalCost = qty * unitCost;
      const cat = document.getElementById('bulkCloneCategory') ? document.getElementById('bulkCloneCategory').value : 'IT';
      const desc = (document.getElementById('bulkCloneDescription') ? document.getElementById('bulkCloneDescription').value.trim() : '') || 'Equipment Unit';
      const bld = document.getElementById('bulkCloneBuilding') ? document.getElementById('bulkCloneBuilding').value : 'BLD-IS';
      const room = document.getElementById('bulkCloneRoom') ? document.getElementById('bulkCloneRoom').value : 'RM-101';
      const custodian = document.getElementById('bulkCloneCustodian') ? document.getElementById('bulkCloneCustodian').value : 'Sanver Andrew H. Mapacpac';

      const year = new Date().getFullYear();
      const currentCount = (window.marSUDb && window.marSUDb.data.assets ? window.marSUDb.data.assets.length : 130);

      const pad = (num, size) => {
        let s = num + "";
        while (s.length < size) s = "0" + s;
        return s;
      };

      const startNo = `MarSU-STC-${cat.slice(0, 3).toUpperCase()}-${year}-${pad(currentCount + 1, 5)}`;
      const endNo = `MarSU-STC-${cat.slice(0, 3).toUpperCase()}-${year}-${pad(currentCount + qty, 5)}`;

      if (document.getElementById('cloneTotalValuationText')) {
        document.getElementById('cloneTotalValuationText').textContent = `₱${totalCost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      }
      if (document.getElementById('cloneSequenceRangeText')) {
        document.getElementById('cloneSequenceRangeText').textContent = `${startNo.slice(-5)} â†’ ${endNo.slice(-5)}`;
      }
      if (document.getElementById('cloneUnitsCountPreview')) {
        document.getElementById('cloneUnitsCountPreview').textContent = qty;
      }
      if (document.getElementById('bulkFooterCountBadge')) {
        document.getElementById('bulkFooterCountBadge').textContent = `${qty} Units`;
      }
      if (document.getElementById('bulkFooterTotalBadge')) {
        document.getElementById('bulkFooterTotalBadge').textContent = `₱${totalCost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      }
      if (document.getElementById('btnSubmitBulkText')) {
        document.getElementById('btnSubmitBulkText').textContent = `Confirm & Register ${qty} Assets`;
      }

      // Serial resolution
      const serialMode = document.getElementById('cloneSerialMode') ? document.getElementById('cloneSerialMode').value : 'auto';
      const prefix = (document.getElementById('cloneSerialPrefix') ? document.getElementById('cloneSerialPrefix').value.trim() : 'SN-2026-') || 'SN-';
      const pasted = document.getElementById('clonePastedSerials') ? document.getElementById('clonePastedSerials').value : '';
      const pastedLines = pasted.split(/[\n,]+/).map(s => s.trim()).filter(s => s.length > 0);

      // Render Preview Rows
      const tbody = document.getElementById('bulkClonePreviewTbody');
      if (tbody) {
        let rowsHtml = '';
        for (let i = 0; i < qty; i++) {
          const propNo = `MarSU-STC-${cat.slice(0, 3).toUpperCase()}-${year}-${pad(currentCount + i + 1, 5)}`;
          let serialVal = '';
          if (serialMode === 'auto') {
            const pad3 = (num) => (num < 10 ? '00' + num : num < 100 ? '0' + num : num);
            serialVal = `${prefix}${pad3(i + 1)}`;
          } else if (serialMode === 'paste') {
            serialVal = pastedLines[i] || `${prefix}${i + 1}`;
          } else {
            serialVal = 'LOT-SC-' + (currentCount + i + 1);
          }

          rowsHtml += `
            <tr>
              <td class="font-mono text-muted text-center">${i + 1}</td>
              <td><strong class="font-mono text-gold">${propNo}</strong></td>
              <td class="text-truncate" style="max-width: 200px;" title="${desc}">${desc} <span class="badge badge-secondary" style="font-size: 0.68rem;">Unit ${i + 1} of ${qty}</span></td>
              <td>
                <input type="text" class="form-control form-control-sm font-mono clone-serial-input"
                  data-unit-index="${i}" value="${serialVal}" style="height: 28px; font-size: 0.8rem; background: var(--bg-surface); border: 1px solid var(--border-color);">
              </td>
              <td class="font-mono">₱${unitCost.toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
              <td><small class="text-muted">${bld} &bull; ${room}</small></td>
            </tr>
          `;
        }
        tbody.innerHTML = rowsHtml;
      }
    };

    // ----------------------------------------------------
    // Multiple-item spreadsheet grid logic
    // ----------------------------------------------------
    window.onBulkEntryBuildingChange = function () {
      const buildingSelect = document.getElementById('bulkNewItemBuilding');
      const roomSelect = document.getElementById('bulkNewItemRoom');
      if (!buildingSelect || !roomSelect || !window.marSUDb) return;

      const building = window.marSUDb.getBuildingById ? window.marSUDb.getBuildingById(buildingSelect.value) : null;
      const rooms = building && Array.isArray(building.rooms) ? building.rooms : [];
      roomSelect.innerHTML = rooms.map(room => `<option value="${room}">${room}</option>`).join('') +
        '<option value="CUSTOM">+ Specify Custom Room / Other Area...</option>';
      window.onBulkEntryRoomChange();
    };

    window.onBulkEntryRoomChange = function () {
      const roomSelect = document.getElementById('bulkNewItemRoom');
      const customRoom = document.getElementById('bulkNewItemCustomRoom');
      if (!roomSelect || !customRoom) return;
      customRoom.style.display = roomSelect.value === 'CUSTOM' ? 'block' : 'none';
    };

    window.onBulkEntryCustodianChange = function () {
      const custodianSelect = document.getElementById('bulkNewItemCustodian');
      const customCustodian = document.getElementById('bulkNewItemCustomCustodian');
      if (!custodianSelect || !customCustodian) return;
      customCustodian.style.display = custodianSelect.value === 'CUSTOM' ? 'block' : 'none';
    };

    window.addBulkGridRow = function (initialData) {
      let newRow = initialData;

      if (!newRow) {
        const descriptionInput = document.getElementById('bulkNewItemDescription');
        const quantityInput = document.getElementById('bulkNewItemQuantity');
        const costInput = document.getElementById('bulkNewItemCost');
        const buildingInput = document.getElementById('bulkNewItemBuilding');
        const roomInput = document.getElementById('bulkNewItemRoom');
        const customRoomInput = document.getElementById('bulkNewItemCustomRoom');
        const custodianInput = document.getElementById('bulkNewItemCustodian');
        const customCustodianInput = document.getElementById('bulkNewItemCustomCustodian');
        const description = descriptionInput ? descriptionInput.value.trim() : '';
        const quantity = quantityInput ? parseInt(quantityInput.value) : 0;
        const unitCost = costInput ? parseFloat(costInput.value) : 0;

        if (!description) {
          window.showToast("Enter an item description before adding it.", "warning", "Description Required");
          if (descriptionInput) descriptionInput.focus();
          return;
        }
        if (!(quantity > 0) || quantity > 150) {
          window.showToast("Enter a quantity from 1 to 150.", "warning", "Check Quantity");
          if (quantityInput) quantityInput.focus();
          return;
        }
        if (!(unitCost > 0)) {
          window.showToast("Enter a unit cost greater than ₱0.", "warning", "Check Unit Cost");
          if (costInput) costInput.focus();
          return;
        }
        if (roomInput && roomInput.value === 'CUSTOM' && !customRoomInput.value.trim()) {
          window.showToast("Enter the destination room or area.", "warning", "Room Required");
          customRoomInput.focus();
          return;
        }
        if (custodianInput && custodianInput.value === 'CUSTOM' && !customCustodianInput.value.trim()) {
          window.showToast("Enter the accountable custodian's name.", "warning", "Custodian Required");
          customCustodianInput.focus();
          return;
        }

        newRow = {
          description,
          category: document.getElementById('bulkNewItemCategory')?.value || 'IT',
          brand: document.getElementById('bulkNewItemBrand')?.value.trim() || '',
          model: document.getElementById('bulkNewItemModel')?.value.trim() || '',
          quantity,
          unitCost,
          acquisitionDate: document.getElementById('bulkNewItemDate')?.value || new Date().toISOString().split('T')[0],
          fundCluster: document.getElementById('bulkNewItemFund')?.value || '01 - Regular Agency Fund',
          buildingId: buildingInput?.value || 'BLD-IS',
          roomId: roomInput?.value === 'CUSTOM' ? customRoomInput.value.trim() : roomInput?.value || 'RM-101',
          custodianName: custodianInput?.value === 'CUSTOM'
            ? customCustodianInput.value.trim()
            : custodianInput?.value || 'Sanver Andrew H. Mapacpac'
        };
      }

      bulkGridRows.push(newRow);
      window.renderBulkGridTable();
      window.updateGridTotals();

      if (!initialData) {
        document.getElementById('bulkNewItemDescription').value = '';
        document.getElementById('bulkNewItemCategory').value = 'IT';
        document.getElementById('bulkNewItemBrand').value = '';
        document.getElementById('bulkNewItemModel').value = '';
        document.getElementById('bulkNewItemQuantity').value = '1';
        document.getElementById('bulkNewItemCost').value = '';
        document.getElementById('bulkNewItemDate').value = new Date().toISOString().split('T')[0];
        document.getElementById('bulkNewItemFund').value = '01 - Regular Agency Fund';
        document.getElementById('bulkNewItemCustomRoom').value = '';
        document.getElementById('bulkNewItemCustomCustodian').value = '';
        window.onBulkEntryRoomChange();
        window.onBulkEntryCustodianChange();
        document.getElementById('bulkNewItemDescription').focus();
      }
    };

    window.removeBulkGridRow = function (index) {
      bulkGridRows.splice(index, 1);
      window.renderBulkGridTable();
      window.updateGridTotals();
    };

    window.onGridCellChange = function (idx, field, value) {
      if (!bulkGridRows[idx]) return;
      if (field === 'quantity') {
        bulkGridRows[idx].quantity = Math.max(1, parseInt(value) || 1);
      } else if (field === 'unitCost') {
        bulkGridRows[idx].unitCost = Math.max(0, parseFloat(value) || 0);
      } else {
        bulkGridRows[idx][field] = value;
      }

      // Update row total cell
      const totalCell = document.getElementById(`gridRowTotal_${idx}`);
      if (totalCell) {
        const rowTot = bulkGridRows[idx].quantity * bulkGridRows[idx].unitCost;
        totalCell.textContent = `₱${rowTot.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
      }

      window.updateGridTotals();
    };

    window.renderBulkGridTable = function () {
      const tbody = document.getElementById('bulkGridTableBody');
      if (!tbody) return;
      const escapeText = value => String(value || '').replace(/[&<>"']/g, character => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
      })[character]);

      if (!bulkGridRows || bulkGridRows.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="13" class="text-center py-4 text-muted small">
              <i class="fas fa-table fa-2x mb-2 text-gold d-block"></i>
              Added items will appear here. Enter the next item above and select Add item.
            </td>
          </tr>
        `;
        return;
      }

      tbody.innerHTML = bulkGridRows.map((r, idx) => {
        const rowTotal = (r.quantity || 1) * (r.unitCost || 0);
        const categoryNames = {
          IT: 'IT & Computing',
          OFF: 'Office Equipment',
          AC: 'Air Conditioning',
          SCI: 'Science & Laboratory',
          VEH: 'Motor Vehicle',
          MED: 'Health & Medical',
          ATH: 'Athletic & Sports'
        };
        return `
          <tr>
            <td class="font-mono text-muted text-center font-weight-bold">${idx + 1}</td>
            <td class="font-weight-bold">${escapeText(r.description)}</td>
            <td>${escapeText(categoryNames[r.category] || r.category || 'IT')}</td>
            <td>${escapeText([r.brand, r.model].filter(Boolean).join(' / ') || '—')}</td>
            <td class="text-center font-weight-bold">${r.quantity || 1}</td>
            <td class="font-mono text-right">₱${(r.unitCost || 0).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
            <td class="font-mono font-weight-bold text-gold text-right" id="gridRowTotal_${idx}">
              ₱${rowTotal.toLocaleString('en-US', { minimumFractionDigits: 2 })}
            </td>
            <td>${escapeText(r.acquisitionDate || '—')}</td>
            <td>${escapeText(r.fundCluster || '01 - Regular Agency Fund')}</td>
            <td>${escapeText(r.buildingId || '—')}</td>
            <td>${escapeText(r.roomId || '—')}</td>
            <td>${escapeText(r.custodianName || '—')}</td>
            <td class="text-center">
              <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="window.removeBulkGridRow(${idx})" title="Remove row">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        `;
      }).join('');
    };

    window.updateGridTotals = function () {
      let totalTypes = bulkGridRows.length;
      let totalUnits = 0;
      let totalValuation = 0;

      bulkGridRows.forEach(r => {
        const q = parseInt(r.quantity) || 1;
        const c = parseFloat(r.unitCost) || 0;
        totalUnits += q;
        totalValuation += q * c;
      });

      if (document.getElementById('gridTotalTypesText')) document.getElementById('gridTotalTypesText').textContent = totalTypes;
      if (document.getElementById('gridTotalUnitsText')) document.getElementById('gridTotalUnitsText').textContent = `${totalUnits} units`;
      if (document.getElementById('gridTotalValuationText')) {
        document.getElementById('gridTotalValuationText').textContent = `₱${totalValuation.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
      }

      if (currentBulkSubMethod === 'table') {
        if (document.getElementById('bulkFooterCountBadge')) {
          document.getElementById('bulkFooterCountBadge').textContent = `${totalUnits} Units (${totalTypes} Types)`;
        }
        if (document.getElementById('bulkFooterTotalBadge')) {
          document.getElementById('bulkFooterTotalBadge').textContent = `₱${totalValuation.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }
        if (document.getElementById('btnSubmitBulkText')) {
          document.getElementById('btnSubmitBulkText').textContent = `Confirm & Register All ${totalUnits} Assets in Table`;
        }
      }
    };

    // ----------------------------------------------------
    // INTAKE WIZARD SUBMISSIONS
    // ----------------------------------------------------
    // Submit Single Asset
    window.submitSingleAsset = function () {
      const desc = document.getElementById('modalDescription') ? document.getElementById('modalDescription').value.trim() : '';
      if (!desc) {
        window.showToast("Please enter an item description.", "warning", "Required Field");
        if (document.getElementById('modalDescription')) document.getElementById('modalDescription').focus();
        return;
      }

      const cost = parseFloat(document.getElementById('modalCost') ? document.getElementById('modalCost').value : 0) || 0;
      if (cost <= 0) {
        window.showToast("Please specify a valid acquisition cost.", "warning", "Invalid Valuation");
        if (document.getElementById('modalCost')) document.getElementById('modalCost').focus();
        return;
      }

      let roomId = document.getElementById('modalRoom') ? document.getElementById('modalRoom').value : 'RM-101';
      if (roomId === 'CUSTOM') {
        roomId = (document.getElementById('modalCustomRoom') && document.getElementById('modalCustomRoom').value.trim()) || 'Custom Space';
      }

      let custodianName = document.getElementById('modalCustodian') ? document.getElementById('modalCustodian').value : 'Sanver Andrew H. Mapacpac';
      if (custodianName === 'CUSTOM') {
        custodianName = (document.getElementById('modalCustomCustodian') && document.getElementById('modalCustomCustodian').value.trim()) || 'SPMU Designated Custodian';
      }

      const buildingId = document.getElementById('modalBuilding') ? document.getElementById('modalBuilding').value : 'BLD-IS';
      const category = document.getElementById('modalCategory') ? document.getElementById('modalCategory').value : 'IT';
      const brand = document.getElementById('modalBrand') ? document.getElementById('modalBrand').value.trim() : '';
      const model = document.getElementById('modalModel') ? document.getElementById('modalModel').value.trim() : '';
      const serial = (document.getElementById('modalSerial') && document.getElementById('modalSerial').value.trim()) || `SN-${Date.now().toString().slice(-4)}`;
      const acqDate = (document.getElementById('modalAcqDate') && document.getElementById('modalAcqDate').value) || new Date().toISOString().split('T')[0];
      const fundCluster = document.getElementById('modalFundCluster') ? document.getElementById('modalFundCluster').value : '01 - Regular Agency Fund';
      const conditionStatus = (document.getElementById('modalCondition') ? document.getElementById('modalCondition').value : 'Serviceable') || 'Serviceable';
      const notes = (document.getElementById('modalNotes') ? document.getElementById('modalNotes').value.trim() : '') || 'Encoded via SPMU Asset Intake Wizard.';

      const newAsset = {
        description: desc,
        category: category,
        brand: brand,
        model: model,
        serialNumber: serial,
        acquisitionCost: cost,
        acquisitionDate: acqDate,
        fundCluster: fundCluster,
        buildingId: buildingId,
        roomId: roomId,
        officeId: "OFF-" + buildingId.replace('BLD-', ''),
        custodianName: custodianName,
        accountableOfficer: custodianName,
        conditionStatus: conditionStatus,
        lifecycleStatus: cost >= 50000 ? "Issued via PAR" : "Issued via ICS",
        lastInspectedDate: acqDate,
        notes: notes
      };

      const saved = window.marSUDb.saveAsset(newAsset);
      $('#newAssetModal').modal('hide');
      window.showToast(`Asset registered successfully! Assigned Property No: ${saved.propertyNumber}`, "emerald", "Registration Confirmed");

      renderTable();
      renderPinTable();
      renderClassificationTable();
      renderAcquisitionTable();
      renderAccountabilityTable();
      window.viewAssetProfile(saved.id);
    };

    // Submit Bulk Intake (Clone or Grid Table)
    window.submitBulkIntake = function () {
      const batchAssetsToSave = [];
      const nowIso = new Date().toISOString().split('T')[0];

      if (currentBulkSubMethod === 'clone') {
        const qty = parseInt(document.getElementById('cloneQtyInput') ? document.getElementById('cloneQtyInput').value : 5) || 5;
        const desc = (document.getElementById('bulkCloneDescription') ? document.getElementById('bulkCloneDescription').value.trim() : '') || 'MarSU Campus Equipment';
        const cost = parseFloat(document.getElementById('bulkCloneCost') ? document.getElementById('bulkCloneCost').value : 0) || 0;
        const cat = document.getElementById('bulkCloneCategory') ? document.getElementById('bulkCloneCategory').value : 'IT';
        const brand = (document.getElementById('bulkCloneBrand') ? document.getElementById('bulkCloneBrand').value.trim() : '') || '';
        const model = (document.getElementById('bulkCloneModel') ? document.getElementById('bulkCloneModel').value.trim() : '') || '';
        const acqDate = (document.getElementById('bulkCloneDate') && document.getElementById('bulkCloneDate').value) || nowIso;
        const fund = document.getElementById('bulkCloneFund') ? document.getElementById('bulkCloneFund').value : '01 - Regular Agency Fund';
        const bld = document.getElementById('bulkCloneBuilding') ? document.getElementById('bulkCloneBuilding').value : 'BLD-IS';
        const room = document.getElementById('bulkCloneRoom') ? document.getElementById('bulkCloneRoom').value : 'RM-101';
        const custodian = document.getElementById('bulkCloneCustodian') ? document.getElementById('bulkCloneCustodian').value : 'Sanver Andrew H. Mapacpac';

        // Read serials from the preview table inputs if edited
        const serialInputs = document.querySelectorAll('#bulkClonePreviewTbody .clone-serial-input');

        for (let i = 0; i < qty; i++) {
          const serialFromInput = (serialInputs[i] && serialInputs[i].value.trim()) ? serialInputs[i].value.trim() : `SN-2026-${Date.now().toString().slice(-4)}-${i + 1}`;
          batchAssetsToSave.push({
            description: `${desc}${qty > 1 ? ` (Unit ${i + 1} of ${qty})` : ''}`,
            category: cat,
            brand: brand,
            model: model,
            serialNumber: serialFromInput,
            acquisitionCost: cost,
            acquisitionDate: acqDate,
            fundCluster: fund,
            buildingId: bld,
            roomId: room,
            officeId: "OFF-" + bld.replace('BLD-', ''),
            custodianName: custodian,
            accountableOfficer: custodian,
            conditionStatus: "Serviceable",
            lifecycleStatus: cost >= 50000 ? "Issued via PAR" : "Issued via ICS",
            lastInspectedDate: acqDate,
            notes: `Bulk cloned ${qty} units via SPMU Wizard.`
          });
        }
      } else {
        // Register each item from the grid.
        if (!bulkGridRows || bulkGridRows.length === 0) {
          window.showToast("The grid table is empty. Please add item rows before saving.", "warning", "No Items in Table");
          return;
        }

        const invalidRowIndex = bulkGridRows.findIndex(row =>
          !String(row.description || '').trim() ||
          !(parseFloat(row.unitCost) > 0) ||
          !(parseInt(row.quantity) > 0) ||
          parseInt(row.quantity) > 150
        );
        if (invalidRowIndex !== -1) {
          window.showToast(
            `Complete the item description, quantity (1–150), and unit cost above ₱0 in row ${invalidRowIndex + 1}.`,
            "warning",
            "Check Item Details"
          );
          const row = document.querySelectorAll('#bulkGridTableBody tr')[invalidRowIndex];
          if (row) {
            const item = bulkGridRows[invalidRowIndex];
            const descriptionInput = row.querySelector('input[type="text"]');
            const quantityInput = row.querySelector('input[type="number"]:not([step])');
            const costInput = row.querySelector('input[type="number"][step="0.01"]');

            if (!String(item.description || '').trim()) {
              descriptionInput?.focus();
            } else if (!(parseInt(item.quantity) > 0) || parseInt(item.quantity) > 150) {
              quantityInput?.focus();
            } else {
              costInput?.focus();
            }
          }
          return;
        }

        const acqDate = nowIso;
        bulkGridRows.forEach((r, rIdx) => {
          const rowQty = parseInt(r.quantity) || 1;
          const rowCost = parseFloat(r.unitCost) || 0;
          for (let i = 0; i < rowQty; i++) {
            batchAssetsToSave.push({
              description: `${r.description}${rowQty > 1 ? ` (Item ${i + 1}/${rowQty})` : ''}`,
              category: r.category || 'IT',
              brand: r.brand || '',
              model: r.model || '',
              serialNumber: `SN-${Date.now().toString().slice(-4)}-${rIdx + 1}${i + 1}`,
              acquisitionCost: rowCost,
              acquisitionDate: r.acquisitionDate || acqDate,
              fundCluster: r.fundCluster || '01 - Regular Agency Fund',
              buildingId: r.buildingId || 'BLD-IS',
              roomId: r.roomId || 'RM-101',
              officeId: "OFF-" + (r.buildingId || 'BLD-IS').replace('BLD-', ''),
              custodianName: r.custodianName || 'Sanver Andrew H. Mapacpac',
              accountableOfficer: r.custodianName || 'Sanver Andrew H. Mapacpac',
              conditionStatus: "Serviceable",
              lifecycleStatus: rowCost >= 50000 ? "Issued via PAR" : "Issued via ICS",
              lastInspectedDate: acqDate,
              notes: "Batch registered via SPMU Grid Table."
            });
          }
        });
      }

      if (batchAssetsToSave.length === 0) {
        window.showToast("No assets to register.", "warning");
        return;
      }

      const savedBatch = window.marSUDb.saveBatchAssets(batchAssetsToSave);
      lastRegisteredBatch = savedBatch;

      $('#newAssetModal').modal('hide');
      renderTable();
      renderPinTable();
      renderClassificationTable();
      renderAcquisitionTable();
      renderAccountabilityTable();

      showBatchSuccessDialog(savedBatch);
    };

    // Wizard preview update (Property Number tag in header)
    window.updateWizardPreview = function () {
      if (!window.marSUDb) return;
      const cat = document.getElementById('modalCategory') ? document.getElementById('modalCategory').value : 'IT';
      const year = new Date().getFullYear();
      const count = (window.marSUDb.data.assets || []).length + 1;
      const pad = (num, size) => {
        let s = num + "";
        while (s.length < size) s = "0" + s;
        return s;
      };
      const preview = `MarSU-STC-${cat.slice(0, 3).toUpperCase()}-${year}-${pad(count, 5)}`;
      if (document.getElementById('wizardNextControlNo')) {
        document.getElementById('wizardNextControlNo').textContent = preview;
      }
    };

    // Dynamic Buildings and Rooms Dropdown Population
    window.populateWizardDropdowns = function () {
      if (!window.marSUDb) return;

      const buildings = window.marSUDb.getBuildings ? window.marSUDb.getBuildings() : [];
      const users = window.marSUDb.getUsers ? window.marSUDb.getUsers() : [];
      const offices = window.marSUDb.data.offices || [];

      // 1. Single Mode Building
      const bldSelect = document.getElementById('modalBuilding');
      if (bldSelect) {
        bldSelect.innerHTML = buildings.map(b => `
          <option value="${b.id}">${b.id} &mdash; ${b.name}</option>
        `).join('');
      }
      window.onBuildingChange();

      // 2. Single Mode Custodian
      const custodianSelect = document.getElementById('modalCustodian');
      if (custodianSelect) {
        let custodianOptions = `<optgroup label="Official Custodians &amp; Personnel">`;
        users.forEach(u => {
          custodianOptions += `<option value="${u.name}">${u.name} &mdash; ${u.designation}</option>`;
        });
        custodianOptions += `</optgroup><optgroup label="Department &amp; College Heads">`;
        offices.forEach(o => {
          if (o.head && !users.some(u => u.name === o.head)) {
            custodianOptions += `<option value="${o.head}">${o.head} &mdash; Head, ${o.name}</option>`;
          }
        });
        custodianOptions += `</optgroup><option value="CUSTOM">+ Specify Other Custodian / Employee...</option>`;
        custodianSelect.innerHTML = custodianOptions;
        if (users.length > 0) custodianSelect.value = users[0].name;
      }

      // 3. Bulk Clone Building
      const cloneBld = document.getElementById('bulkCloneBuilding');
      if (cloneBld) {
        cloneBld.innerHTML = buildings.map(b => `
          <option value="${b.id}">${b.id} &mdash; ${b.name}</option>
        `).join('');
      }
      window.onCloneBuildingChange();

      // 4. Bulk Clone Custodian
      const cloneCust = document.getElementById('bulkCloneCustodian');
      if (cloneCust) {
        cloneCust.innerHTML = users.map(u => `
          <option value="${u.name}">${u.name} &mdash; ${u.designation}</option>
        `).join('');
        if (users.length > 0) cloneCust.value = users[0].name;
      }

      // 5. Multiple-item form destination and custodian
      const bulkEntryBuilding = document.getElementById('bulkNewItemBuilding');
      if (bulkEntryBuilding) {
        bulkEntryBuilding.innerHTML = buildings.map(b => `
          <option value="${b.id}">${b.id} &mdash; ${b.name}</option>
        `).join('');
      }
      const bulkEntryCustodian = document.getElementById('bulkNewItemCustodian');
      if (bulkEntryCustodian && custodianSelect) {
        bulkEntryCustodian.innerHTML = custodianSelect.innerHTML;
        if (users.length > 0) bulkEntryCustodian.value = users[0].name;
      }
      window.onBulkEntryBuildingChange();
      window.onBulkEntryCustodianChange();

      // Default dates
      const todayIso = new Date().toISOString().split('T')[0];
      if (document.getElementById('modalAcqDate') && !document.getElementById('modalAcqDate').value) {
        document.getElementById('modalAcqDate').value = todayIso;
      }
      if (document.getElementById('bulkCloneDate') && !document.getElementById('bulkCloneDate').value) {
        document.getElementById('bulkCloneDate').value = todayIso;
      }
      if (document.getElementById('bulkNewItemDate') && !document.getElementById('bulkNewItemDate').value) {
        document.getElementById('bulkNewItemDate').value = todayIso;
      }

      window.updateWizardPreview();
      window.updateClonePreview();
    };

    // Cascading Room Dropdown for Single Mode
    window.onBuildingChange = function () {
      const bldSelect = document.getElementById('modalBuilding');
      const roomSelect = document.getElementById('modalRoom');
      if (!bldSelect || !roomSelect || !window.marSUDb) return;

      const selectedBldId = bldSelect.value;
      const bldObj = window.marSUDb.getBuildingById ? window.marSUDb.getBuildingById(selectedBldId) : null;
      const rooms = bldObj && bldObj.rooms ? bldObj.rooms : [];

      let options = ``;
      if (rooms.length > 0) {
        options += `<optgroup label="Certified Rooms (${selectedBldId})">`;
        rooms.forEach(rm => {
          options += `<option value="${rm}">${rm}</option>`;
        });
        options += `</optgroup>`;
      }
      options += `<option value="CUSTOM">+ Specify Custom Room / Other Area...</option>`;
      roomSelect.innerHTML = options;
      window.onRoomChange();
    };

    window.onRoomChange = function () {
      const roomSelect = document.getElementById('modalRoom');
      const customContainer = document.getElementById('modalCustomRoomContainer');
      const customInput = document.getElementById('modalCustomRoom');
      if (roomSelect && customContainer) {
        if (roomSelect.value === 'CUSTOM') {
          customContainer.style.display = 'block';
          if (customInput) customInput.focus();
        } else {
          customContainer.style.display = 'none';
        }
      }
    };

    window.onCustodianChange = function () {
      const custodianSelect = document.getElementById('modalCustodian');
      const customContainer = document.getElementById('modalCustomCustodianContainer');
      const customInput = document.getElementById('modalCustomCustodian');
      if (custodianSelect && customContainer) {
        if (custodianSelect.value === 'CUSTOM') {
          customContainer.style.display = 'block';
          if (customInput) customInput.focus();
        } else {
          customContainer.style.display = 'none';
        }
      }
    };

    // Print batch Avery sticker sheet for newly registered items
    window.printBatchQrSheet = function (batch) {
      const items = batch && batch.length ? batch : lastRegisteredBatch;
      if (!items || !items.length) {
        window.showToast("No registered items found to print.", "warning");
        return;
      }

      const printWin = window.open('', '_blank', 'width=900,height=750');
      printWin.document.write(`
        <html>
          <head>
            <title>MarSU Sta. Cruz - Batch Property QR Sticker Sheet</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 15px; color: #111; }
              .header-title { text-align: center; color: #6a0f27; margin-bottom: 2px; }
              .sub-title { text-align: center; font-size: 11px; color: #555; margin-top: 0; margin-bottom: 15px; }
              .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
              .sticker { border: 1.5px solid #6a0f27; padding: 8px; border-radius: 6px; text-align: center; background: #fff; page-break-inside: avoid; }
              .inst { font-size: 9px; font-weight: bold; color: #6a0f27; text-transform: uppercase; }
              .unit { font-size: 8px; color: #333; margin-bottom: 4px; }
              .prop-no { font-family: monospace; font-size: 10.5px; font-weight: bold; margin-top: 3px; color: #000; }
              .desc { font-size: 8px; color: #444; max-height: 22px; overflow: hidden; margin-top: 2px; }
              .loc { font-size: 7.5px; color: #666; margin-top: 2px; font-weight: 600; }
            </style>
          </head>
          <body>
            <h3 class="header-title">Marinduque State University &bull; Sta. Cruz Campus</h3>
            <p class="sub-title">Supply and Property Management Unit &mdash; Batch Asset QR Identification Tags (COA Appendix 71/ICS)</p>
            <div class="grid">
              ${items.map(a => `
                <div class="sticker">
                  <div class="inst">MarSU Sta. Cruz Campus</div>
                  <div class="unit">Property &amp; Supply Unit</div>
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=95x95&data=${encodeURIComponent(a.propertyNumber)}" width="95" height="95" style="margin: 2px 0;" />
                  <div class="prop-no">${a.propertyNumber}</div>
                  <div class="desc">${(a.description || '').substring(0, 45)}</div>
                  <div class="loc">${a.buildingId || ''} &bull; ${a.roomId || ''} &bull; ${a.serialNumber ? 'SN: ' + a.serialNumber : ''}</div>
                </div>
              `).join('')}
            </div>
            <script>window.onload = function() { window.print(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    function showBatchSuccessDialog(savedBatch) {
      if (!savedBatch || !savedBatch.length) return;
      const totalCost = savedBatch.reduce((sum, a) => sum + (parseFloat(a.acquisitionCost) || 0), 0);

      if (document.getElementById('batchSuccessHeading')) {
        document.getElementById('batchSuccessHeading').textContent = `Successfully Registered ${savedBatch.length} Campus Assets!`;
      }
      if (document.getElementById('batchSuccessSubtext')) {
        document.getElementById('batchSuccessSubtext').textContent = `Total Batch Valuation: ₱${totalCost.toLocaleString('en-US', { minimumFractionDigits: 2 })} • Allocated to ${savedBatch[0].buildingId} (${savedBatch[0].roomId})`;
      }

      const tbody = document.getElementById('batchSuccessTableBody');
      if (tbody) {
        tbody.innerHTML = savedBatch.map(a => `
          <tr>
            <td>
              <strong class="font-mono text-gold">${a.propertyNumber}</strong>
              <div class="small text-muted"><i class="fas fa-barcode mr-1"></i>QR Active</div>
            </td>
            <td>${a.description}</td>
            <td class="font-mono small">${a.serialNumber || '—'}</td>
            <td class="font-mono font-weight-bold">₱${parseFloat(a.acquisitionCost || 0).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
            <td><small>${a.custodianName}<br><span class="text-muted">${a.buildingId} &bull; ${a.roomId}</span></small></td>
            <td class="text-center">
              <button class="btn btn-sm btn-marsu-outline py-1 px-2" onclick="window.viewAssetProfile('${a.id}')" title="View Profile">
                <i class="fas fa-eye text-gold"></i>
              </button>
            </td>
          </tr>
        `).join('');
      }

      const printBtn = document.getElementById('btnPrintBatchSheetBtn');
      if (printBtn) {
        printBtn.onclick = function () {
          window.printBatchQrSheet(savedBatch);
        };
      }

      $('#batchSuccessModal').modal('show');
      window.showToast(`Batch intake complete: ${savedBatch.length} items registered!`, "emerald", "Batch Confirmed");
    }

    // Print Avery QR Sheet
    window.printAveryStickerSheet = function () {
      const paged = (filteredAssets.length ? filteredAssets : window.marSUDb.getAssets()).slice(0, 12);
      const printWin = window.open('', '_blank', 'width=900,height=700');
      printWin.document.write(`
        <html>
          <head>
            <title>MarSU Sta. Cruz - Avery QR Sticker Sheet</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 20px; }
              .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
              .sticker { border: 1.5px solid #7b1e2b; padding: 10px; border-radius: 6px; text-align: center; }
              .header { font-size: 10px; font-weight: bold; color: #7b1e2b; }
              .sub { font-size: 8px; color: #555; }
              .prop { font-family: monospace; font-size: 11px; font-weight: bold; margin-top: 4px; }
              .desc { font-size: 8px; color: #222; margin-top: 3px; max-height: 24px; overflow: hidden; }
            </style>
          </head>
          <body>
            <h3 style="text-align: center; color: #7b1e2b; margin-bottom: 5px;">Marinduque State University &bull; Sta. Cruz Campus</h3>
            <p style="text-align: center; font-size: 11px; color: #666; margin-top: 0;">SPMU Official Property QR Code Tag Sheet (COA Appendix 71/ICS Layout)</p>
            <div class="grid">
              ${paged.map(a => `
                <div class="sticker">
                  <div class="header">MarSU Sta. Cruz Campus</div>
                  <div class="sub">Property & Supply Management Unit</div>
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=${encodeURIComponent(a.propertyNumber)}" width="90" height="90" style="margin: 4px 0;" />
                  <div class="prop">${a.propertyNumber}</div>
                  <div class="desc">${(a.description || '').substring(0, 45)}...</div>
                </div>
              `).join('')}
            </div>
            <script>window.onload = function() { window.print(); window.close(); };<\/script>

</body>
        </html>
      `);
      printWin.document.close();
    };

    // Export CSV
    window.exportAssetsToCSV = function () {
      const all = filteredAssets.length ? filteredAssets : window.marSUDb.getAssets();
      let csv = "Property Number,Inventory Item No,Classification,Category,Description,Brand,Serial,Cost,Book Value,Building,Room,Custodian,Condition\n";
      all.forEach(a => {
        csv += `"${a.propertyNumber}","${a.inventoryItemNumber || ''}","${a.classification}","${a.category}","${(a.description || '').replace(/"/g, '""')}","${a.brand || ''}","${a.serialNumber || ''}",${a.acquisitionCost},${a.bookValue},"${a.buildingId}","${a.roomId}","${a.custodianName}","${a.conditionStatus}"\n`;
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", `MarSU-SC-Asset-Registry-${new Date().toISOString().split('T')[0]}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      window.showToast("Exported assets to CSV format successfully.", "emerald");
    };

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function () {
      // Check URL parameters (e.g. ?building=BLD-IS)
      const urlParams = new URLSearchParams(window.location.search);
      const bldParam = urlParams.get('building');
      if (bldParam && document.getElementById('filterBuilding')) {
        document.getElementById('filterBuilding').value = bldParam;
      }

      // This page contains only the asset profile workspace.
      window.switchSubmodule('profile');

      if (urlParams.get('tab') === 'create' || urlParams.get('action') === 'new') {
        window.switchIntakeMode('single');
        setTimeout(() => $('#newAssetModal').modal('show'), 350);
      }
      // Search listeners for Pane 1
      const assetSearchInput = document.getElementById('assetSearchInput');
      const assetSearchClear = document.getElementById('assetSearchClear');
      if (assetSearchInput) assetSearchInput.addEventListener('input', () => {
        if (assetSearchClear) assetSearchClear.hidden = !assetSearchInput.value;
        currentPage = 1;
        renderTable();
      });
      if (assetSearchInput && assetSearchClear) assetSearchClear.addEventListener('click', () => {
        assetSearchInput.value = '';
        assetSearchClear.hidden = true;
        assetSearchInput.focus();
        currentPage = 1;
        renderTable();
      });
      if (document.getElementById('filterCategory')) document.getElementById('filterCategory').addEventListener('change', () => { currentPage = 1; renderTable(); });
      if (document.getElementById('filterBuilding')) document.getElementById('filterBuilding').addEventListener('change', () => { currentPage = 1; renderTable(); });
      if (document.getElementById('filterCondition')) document.getElementById('filterCondition').addEventListener('change', () => { currentPage = 1; renderTable(); });

      // Search listeners for Pane 2, 4, 5
      const pinSearchInput = document.getElementById('pinSearchInput');
      const pinSearchClear = document.getElementById('pinSearchClear');
      if (pinSearchInput) pinSearchInput.addEventListener('input', () => {
        if (pinSearchClear) pinSearchClear.hidden = !pinSearchInput.value;
        renderPinTable();
      });
      if (pinSearchInput && pinSearchClear) pinSearchClear.addEventListener('click', () => {
        pinSearchInput.value = '';
        pinSearchClear.hidden = true;
        pinSearchInput.focus();
        renderPinTable();
      });
      const acqSearchInput = document.getElementById('acqSearchInput');
      const acqSearchClear = document.getElementById('acqSearchClear');
      if (acqSearchInput) acqSearchInput.addEventListener('input', () => {
        if (acqSearchClear) acqSearchClear.hidden = !acqSearchInput.value;
        renderAcquisitionTable();
      });
      if (acqSearchInput && acqSearchClear) acqSearchClear.addEventListener('click', () => {
        acqSearchInput.value = '';
        acqSearchClear.hidden = true;
        acqSearchInput.focus();
        renderAcquisitionTable();
      });
      const accountabilitySearchInput = document.getElementById('accountabilitySearchInput');
      const accountabilitySearchClear = document.getElementById('accountabilitySearchClear');
      if (accountabilitySearchInput) accountabilitySearchInput.addEventListener('input', () => {
        if (accountabilitySearchClear) accountabilitySearchClear.hidden = !accountabilitySearchInput.value;
        renderAccountabilityTable();
      });
      if (accountabilitySearchInput && accountabilitySearchClear) accountabilitySearchClear.addEventListener('click', () => {
        accountabilitySearchInput.value = '';
        accountabilitySearchClear.hidden = true;
        accountabilitySearchInput.focus();
        renderAccountabilityTable();
      });
      if (document.getElementById('accountabilityFilterOffice')) document.getElementById('accountabilityFilterOffice').addEventListener('change', renderAccountabilityTable);

      if (document.getElementById('prevPageBtn')) document.getElementById('prevPageBtn').addEventListener('click', () => { if (currentPage > 1) { currentPage--; renderTable(); } });
      if (document.getElementById('nextPageBtn')) document.getElementById('nextPageBtn').addEventListener('click', () => { currentPage++; renderTable(); });

      // Populate wizard dropdowns on modal open and initial load
      $('#newAssetModal').on('show.bs.modal', function () {
        if (typeof window.populateWizardDropdowns === 'function') {
          window.populateWizardDropdowns();
        }
      });
      if (typeof window.populateWizardDropdowns === 'function') {
        window.populateWizardDropdowns();
      }

      // Handle New Asset Form Submission (Delegates to Single or Bulk Intake Handler)
      if (document.getElementById('newAssetForm')) {
        document.getElementById('newAssetForm').addEventListener('submit', function (e) {
          e.preventDefault();
          if (currentIntakeMode === 'batch') {
            window.submitBulkIntake();
          } else {
            window.submitSingleAsset();
          }
        });
      }
    });

document.addEventListener('DOMContentLoaded', function() {
      if (typeof window.switchSubmodule === 'function') {
        try { window.switchSubmodule('profile'); } catch(e) {}
      }
      try { renderTable(); } catch(e) { console.warn(e); }
    });
  </script>
</body>
</html>
