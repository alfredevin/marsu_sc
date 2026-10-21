 <!-- ============ INTERVENTION LOG ============ -->
          <section class="page-section" id="page-interventions">
            <div class="page-head">
              <div>
                <div class="eyebrow">Case Handling</div>
                <h1>Intervention Documentation</h1>
                <p>Record of guidance, health, and welfare interventions provided to students, and their outcomes.
                </p>
              </div>
              <button class="btn btn-maroon" onclick="openModal('modalIntervention')"><i class="fa-solid fa-plus"></i>
                Log Intervention</button>
            </div>
            <div class="section-card">
              <div class="section-toolbar">
                <div class="search"><i class="fa-solid fa-magnifying-glass"></i><input id="searchInterventions"
                    oninput="filterTable('searchInterventions','tblInterventions')"
                    placeholder="Search student or case no..."></div>
              </div>
              <div class="table-wrap">
                <table id="tblInterventions">
                  <thead>
                    <tr>
                      <th>Intervention No.</th>
                      <th>Case No.</th>
                      <th>Student</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Provided By</th>
                      <th>Outcome</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>IV-0731</td>
                      <td>CM-2026-0246</td>
                      <td class="cell-name">Villanueva, Kim D.</td>
                      <td>Crisis Intervention</td>
                      <td>Sep 12, 2026</td>
                      <td>J. Marasigan</td>
                      <td><span class="badge ongoing">Monitoring</span></td>
                    </tr>
                    <tr>
                      <td>IV-0730</td>
                      <td>CM-2026-0248</td>
                      <td class="cell-name">Dela Cruz, Angelo M.</td>
                      <td>Academic Coaching</td>
                      <td>Sep 10, 2026</td>
                      <td>G. Panganiban</td>
                      <td><span class="badge ongoing">In progress</span></td>
                    </tr>
                    <tr>
                      <td>IV-0729</td>
                      <td>CM-2026-0247</td>
                      <td class="cell-name">Reyes, Maricel S.</td>
                      <td>Financial Assistance Facilitation</td>
                      <td>Sep 08, 2026</td>
                      <td>E. Rodelas</td>
                      <td><span class="badge referred">Referred out</span></td>
                    </tr>
                    <tr>
                      <td>IV-0728</td>
                      <td>CM-2026-0245</td>
                      <td class="cell-name">Santos, Paolo R.</td>
                      <td>Family Consultation</td>
                      <td>Aug 30, 2026</td>
                      <td>E. Rodelas</td>
                      <td><span class="badge resolved">Effective</span></td>
                    </tr>
                    <tr>
                      <td>IV-0727</td>
                      <td>CM-2026-0244</td>
                      <td class="cell-name">Ramos, Bea J.</td>
                      <td>Behavioral Contract</td>
                      <td>Aug 27, 2026</td>
                      <td>G. Panganiban</td>
                      <td><span class="badge resolved">Effective</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-foot"><span>Showing 5 of 73 interventions</span><span>Page 1 of 15</span></div>
            </div>
          </section>