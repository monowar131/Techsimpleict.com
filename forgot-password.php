<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | TechSimple ICT</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #1e293b;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #475569;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .error-msg {
            color: #ef4444;
            background: #fef2f2;
            padding: 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            display: none;
            border: 1px solid #fee2e2;
        }

        .success-msg {
            color: #166534;
            background: #dcfce7;
            padding: 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            display: none;
            border: 1px solid #bbfc7e;
        }
    </style>
</head>

<body style="background: #f1f5f9;">
    <div class="login-container">
        <div class="login-header">
            <h2>Recover Password</h2>
            <p>Enter your Gmail to reset your password</p>
        </div>

        <div id="errorMsg" class="error-msg">Email not found.</div>
        <div id="successMsg" class="success-msg">Password reset successful! Redirecting...</div>

        <form id="recoverForm">
            <div class="form-group">
                <label>Gmail</label>
                <input type="email" id="email" placeholder="admin@gmail.com" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" id="newPassword" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn" style="width: 100%; padding: 0.9rem; font-size: 1rem;">Reset
                Password</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="login.html" style="color: #64748b; font-size: 0.85rem; text-decoration: none;">← Back to Login</a>
        </div>
    </div>

    <script src="js/data.js"></script>
    <script>
        const form = document.getElementById('recoverForm');
        const errorMsg = document.getElementById('errorMsg');
        const successMsg = document.getElementById('successMsg');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const newPassword = document.getElementById('newPassword').value;

            const result = await DataManager.admin.forgotPassword(email, newPassword);

            if (result.success) {
                successMsg.style.display = 'block';
                errorMsg.style.display = 'none';
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            } else {
                errorMsg.textContent = result.error || 'Email not found.';
                errorMsg.style.display = 'block';
                successMsg.style.display = 'none';
            }
        });
    </script>
</body>

</html>