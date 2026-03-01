<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TechSimple ICT</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .reg-container {
            max-width: 600px;
            margin: 4rem auto;
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
        }

        .success-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            z-index: 100;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body style="background: #f8fafc; padding: 0;">
    <nav style="background: #1e293b; padding: 1rem 2rem; color: white;">
        <h1><a href="trainings.html" style="color: white; text-decoration: none;">TechSimple ICT</a></h1>
    </nav>

    <div class="reg-container">
        <h2 style="margin-bottom: 0.5rem;">Join the Program</h2>
        <p id="trainingTitle" style="color: #64748b; margin-bottom: 2.5rem; font-weight: 500;">Loading training info...
        </p>

        <form id="regForm">
            <input type="hidden" id="trainingId">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="fullName" required placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="email" required placeholder="john@example.com">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" id="phone" required placeholder="+880 1XXX XXXXXX">
            </div>
            <div class="form-group">
                <label>Occupation</label>
                <select id="occupation">
                    <option>Student</option>
                    <option>Professional</option>
                    <option>Other</option>
                </select>
            </div>
            <button type="submit" class="btn"
                style="width: 100%; padding: 1rem; font-size: 1.1rem; margin-top: 1rem;">Complete Registration</button>
        </form>
    </div>

    <div id="successOverlay" class="success-overlay">
        <div
            style="background: #dcfce7; color: #166534; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1.5rem;">
            ✓</div>
        <h2 style="font-size: 2rem; color: #1e293b;">Registration Successful!</h2>
        <p style="color: #64748b; margin-bottom: 2rem;">You have been registered for the program. We will contact you
            soon.</p>
        <a href="trainings.html" class="btn">Back to Trainings</a>
    </div>

    <script src="js/data.js"></script>
    <script src="js/logic.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const tId = urlParams.get('id');
        const form = document.getElementById('regForm');
        const titleEl = document.getElementById('trainingTitle');

        let currentTraining = null;

        async function init() {
            currentTraining = await DataManager.getTrainingDetails(tId);

            if (!currentTraining || currentTraining.error || !LogicManager.isRegistrationOpen(currentTraining)) {
                alert('Registration is closed for this program or it does not exist.');
                window.location.href = 'trainings.php';
            } else {
                titleEl.textContent = `Registering for: ${currentTraining.title}`;
                document.getElementById('trainingId').value = tId;
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append('training_id', tId);
            formData.append('full_name', document.getElementById('fullName').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);

            const result = await DataManager.saveRegistration(formData);
            if (result.success) {
                document.getElementById('successOverlay').style.display = 'flex';
            } else {
                alert('Error: ' + result.error);
            }
        });

        init();
    </script>
</body>

</html>