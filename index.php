<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Training Admin Panel</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .btn-delete {
      background: #ef4444 !important;
    }

    .btn-delete:hover {
      background: #dc2626 !important;
    }
  </style>
  <script>
    async function logout() {
      // Simple logout by redirecting to a logout script or just clearing session on server
      window.location.href = 'api/logout.php';
    }
  </script>
</head>

<body>
  <div class="layout">
    <div class="sidebar">
      <h2>TechSimple Admin</h2>
      <nav>
        <a href="#dashboard">Dashboard</a>
        <a href="#training">Trainings</a>
        <a href="#offers">Offers</a>
        <a href="#registrations">Registrations</a>
        <a href="javascript:void(0)" onclick="logout()" style="margin-top: 1rem; color: #ef4444;">Logout</a>
        <a href="trainings.html" style="margin-top: 2rem; border: 1px solid #10b981;">View Frontend</a>
      </nav>
    </div>

    <main class="main">
      <header id="dashboard">
        <h1>Training Management Admin Panel</h1>
        <p>Control center for programs and participants</p>
      </header>

      <section class="stats">
        <div class="card">
          <h3>Trainings</h3>
          <p id="statTrainings">0</p>
        </div>
        <div class="card">
          <h3>Active Offers</h3>
          <p id="statOffers">0</p>
        </div>
        <div class="card">
          <h3>Registrations</h3>
          <p id="statRegs">0</p>
        </div>
      </section>

      <section id="training" class="panel">
        <div class="panel-header">
          <h2>Training Management</h2>
        </div>

        <div class="card-info">
          <form id="trainingForm" class="card-1">
            <h3>Training Details</h3>
            <input type="hidden" id="editTrainingId">

            <label>Title</label>
            <input type="text" id="tTitle" required placeholder="Full Stack Bootcamp">

            <label>Code</label>
            <input type="text" id="tCode" required placeholder="TS-001">

            <label>Category</label>
            <select id="tCategory">
              <option>Certification</option>
              <option>Professional</option>
              <option>Corporate</option>
            </select>

            <label>Fee (BDT)</label>
            <input type="number" id="tFee" required>

            <label>Start Date</label>
            <input type="date" id="tStartDate" required>

            <label>Deadline</label>
            <input type="date" id="tDeadline" required>

            <label>Status</label>
            <select id="tStatus">
              <option>Upcoming</option>
              <option>Ongoing</option>
              <option>Closed</option>
            </select>

            <label>Instructor</label>
            <input type="text" id="tInstructor" required>

            <label>Description</label>
            <textarea id="tDesc" rows="3" required></textarea>

            <button class="btn" type="submit" id="saveTrainingBtn">Save Training</button>
          </form>

          <div class="card-info-1">
            <h3>Training List</h3>
            <div style="display: flex;">
              <input type="search" id="trainingSearch" placeholder="Search training"
                style="flex: 1; padding: 0.5rem; border-radius: 6px; border: 1px solid #ddd;">
            </div>

            <table class="training-table">
              <thead class="table-header">
                <tr>
                  <th>Title</th>
                  <th>Code</th>
                  <th>Fee</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="trainingTableBody" class="table-body">
                <!-- Dynamic Rows -->
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <section id="offers" class="panel-1">
        <div class="panel-header">
          <h2>Offers & Discounts</h2>
        </div>

        <div class="card-info">
          <form id="offerForm" class="offer-info-card">
            <h3>Offer Form</h3>
            <label>Offer Name</label>
            <input type="text" id="oName" required placeholder="New Year Discount">

            <label>Training</label>
            <select id="oTraining" required>
              <!-- Dynamic Options -->
            </select>

            <label>Discount Type</label>
            <select id="oType">
              <option>Percentage</option>
              <option>Fixed</option>
            </select>

            <label>Value</label>
            <input type="number" id="oValue" required>

            <label>Start Date</label>
            <input type="date" id="oStartDate" required>

            <label>End Date</label>
            <input type="date" id="oEndDate" required>

            <button class="btn" type="submit">Save Offer</button>
          </form>

          <div class="card-info-1">
            <h3>Active Offers</h3>
            <table class="training-table">
              <thead class="table-header">
                <tr>
                  <th>Offer</th>
                  <th>Training</th>
                  <th>Value</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="offerTableBody" class="table-body">
                <!-- Dynamic Rows -->
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <section id="registrations" class="panel-2">
        <div class="panel-header">
          <h2>Registrations</h2>
        </div>

        <div class="card"></div>
          <table class="registration-table">
            <thead class="table-header">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Training</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody id="regTableBody">
              <!-- Dynamic Rows -->
            </tbody>
          </table>
        </div>
      </section>

      <footer>
        <p>Dynamic Training Management System</p>
        <p>© 2026 TechSimple ICT</p>
      </footer>
    </main>
  </div>

  <script src="js/data.js"></script>
  <script src="js/logic.js"></script>
  <script>
    // State management for UI
    const trainingForm = document.getElementById('trainingForm');
    const offerForm = document.getElementById('offerForm');

    async function updateUI() {
      const trainings = await DataManager.admin.getTrainings();
      const offers = await DataManager.admin.getOffers();
      const regs = await DataManager.admin.getRegistrations();
      const cats = await DataManager.getClassifications();

      // Update Stats
      document.getElementById('statTrainings').textContent = trainings.length;
      document.getElementById('statOffers').textContent = offers.length;
      document.getElementById('statRegs').textContent = regs.length;

      // Update Category Select
      const tCat = document.getElementById('tCategory');
      tCat.innerHTML = '';
      cats.forEach(c => {
        tCat.innerHTML += `<option value="${c.id}">${c.name}</option>`;
      });

      // Render Training Table
      const tBody = document.getElementById('trainingTableBody');
      tBody.innerHTML = '';
      trainings.forEach(t => {
        tBody.innerHTML += `
                <tr>
                    <td>${t.title}</td>
                    <td>${t.code || 'N/A'}</td>
                    <td>৳${parseFloat(t.price).toLocaleString()}</td>
                    <td>${t.status || 'Active'}</td>
                    <td>
                        <button class="btn" onclick="editTraining('${t.id}')">Edit</button>
                        <button class="btn btn-delete" onclick="deleteTraining('${t.id}')">Delete</button>
                    </td>
                </tr>
            `;
      });

      // Update Offer Select & Table
      const oSelect = document.getElementById('oTraining');
      const oBody = document.getElementById('offerTableBody');
      oSelect.innerHTML = '';
      oBody.innerHTML = '';
      trainings.forEach(t => {
        oSelect.innerHTML += `<option value="${t.id}">${t.title}</option>`;
      });
      offers.forEach(o => {
        oBody.innerHTML += `
                <tr>
                    <td>${o.offer_name || 'Offer'}</td>
                    <td>${o.training_title}</td>
                    <td>${o.discount_value}${o.discount_type === 'percentage' ? '%' : ' BDT'}</td>
                    <td><button class="btn btn-delete" onclick="deleteOffer('${o.id}')">Remove</button></td>
                </tr>
            `;
      });

      // Render Registration Table
      const rBody = document.getElementById('regTableBody');
      rBody.innerHTML = '';
      regs.forEach(r => {
        rBody.innerHTML += `
                <tr>
                    <td>${r.full_name}</td>
                    <td>${r.email}</td>
                    <td>${r.training_title}</td>
                    <td>${LogicManager.getFormattedDate(r.registration_date)}</td>
                </tr>
            `;
      });
    }

    // Handlers
    trainingForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const editId = document.getElementById('editTrainingId').value;

      const newTraining = {
        id: editId || null,
        title: document.getElementById('tTitle').value,
        price: parseFloat(document.getElementById('tFee').value),
        instructor: document.getElementById('tInstructor').value,
        description: document.getElementById('tDesc').value,
        classification_id: document.getElementById('tCategory').value,
        deadline: document.getElementById('tDeadline').value,
        schedule: 'N/A' // Default for now
      };

      await DataManager.admin.saveTraining(newTraining);
      trainingForm.reset();
      document.getElementById('editTrainingId').value = '';
      updateUI();
    });

    offerForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const newOffer = {
        training_id: document.getElementById('oTraining').value,
        discount_type: document.getElementById('oType').value.toLowerCase(),
        discount_value: parseFloat(document.getElementById('oValue').value),
        start_date: document.getElementById('oStartDate').value,
        end_date: document.getElementById('oEndDate').value
      };
      await DataManager.admin.saveOffer(newOffer);
      offerForm.reset();
      updateUI();
    });

    window.editTraining = async (id) => {
      const trainings = await DataManager.admin.getTrainings();
      const t = trainings.find(t => t.id == id);
      document.getElementById('editTrainingId').value = t.id;
      document.getElementById('tTitle').value = t.title;
      document.getElementById('tFee').value = t.price;
      document.getElementById('tInstructor').value = t.instructor;
      document.getElementById('tDesc').value = t.description;
      document.getElementById('tCategory').value = t.classification_id;
      document.getElementById('tDeadline').value = t.deadline.split(' ')[0];
      window.scrollTo(0, document.getElementById('training').offsetTop);
    };

    window.deleteTraining = async (id) => {
      if (confirm('Delete this training?')) {
        await DataManager.admin.deleteTraining(id);
        updateUI();
      }
    };

    window.deleteOffer = async (id) => {
      await DataManager.admin.deleteOffer(id);
      updateUI();
    };

    updateUI();
  </script>
</body>

</html>