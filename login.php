<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | TechSimple ICT</title>
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
    </style>
</head>

<body style="background: #f1f5f9;">
    <div class="login-container">
        <div class="login-header">
            <h2>Admin Login</h2>
            <p>Enter your credentials to manage trainings</p>
        </div>

        <div id="errorMsg" class="error-msg">Invalid username or password.</div>

        <form id="loginForm">
            <div class="form-group">
                <label>Gmail</label>
                <input type="email" id="email" placeholder="admin@gmail.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" placeholder="••••••••" required>
            </div>
            <div style="text-align: right; margin-bottom: 1.5rem;">
                <a href="forgot-password.html" style="color: #3b82f6; font-size: 0.85rem; text-decoration: none;">Forgot
                    Password?</a>
            </div>
            <button type="submit" class="btn" style="width: 100%; padding: 0.9rem; font-size: 1rem;">Sign In</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 0.5rem;">Don't have an account? <a
                    href="signup.html" style="color: #10b981; text-decoration: none; font-weight: 600;">Sign Up</a></p>
            <a href="trainings.html" style="color: #64748b; font-size: 0.85rem; text-decoration: none;">← Back to
                Trainings</a>
        </div>
    </div>

    <script src="js/data.js"></script>
    <script>
        const form = document.getElementById('loginForm');
        const errorMsg = document.getElementById('errorMsg');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const result = await DataManager.admin.login(email, password);

            if (result.success) {
                // We use session cookies now, so sessionStorage is optional but can be kept for frontend logic
                sessionStorage.setItem('isAdminAuthenticated', 'true');
                window.location.href = 'index.php';
            } else {
                errorMsg.textContent = result.error || 'Invalid credentials';
                errorMsg.style.display = 'block';
            }
        });
    </script>
</body>

</html>