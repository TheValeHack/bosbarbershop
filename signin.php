<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Bos Barbershop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #1a1a1a;
            color: white;
            font-family: 'Poppins', sans-serif  !important;
            position: relative;
        }

        .background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path d="M30,50 L70,50 M50,30 L50,70" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>') repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .register-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-register {
            background-color: #ff0000;
            color: white;
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 8px;
            margin-top: 1rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-register:hover {
            background-color: #cc0000;
            color: white;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
        }

        .sign-in-text {
            text-align: center;
            margin-top: 1rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .sign-in-text a {
            color: white;
            text-decoration: none;
        }

        .sign-in-text a:hover {
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="background-pattern"></div>
    
    <div class="container">
        <div class="register-container">
            <div class="logo">
                <h2>BOS BARBERSHOP</h2>
                <p>Sign In to get your member number</p>
            </div>
            <?php
            session_start();

            if (isset($_SESSION['user_id'])) {
                header('Location: account.php');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require 'config/database.php';

                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                if (empty($email) || empty($password)) {
                    echo '<div class="alert alert-danger">Please fill in all fields.</div>';
                } else {
                    try {
                        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                        $stmt->execute([$email]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($user && password_verify($password, $user['password'])) {
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['user_name'] = $user['name'];

                            echo '<div class="alert alert-success">Login successful! Redirecting...</div>';
                            header("Refresh: 2; url=account.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-danger">Invalid email or password.</div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    }
                }
            }
            ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-register">Sign in</button>

                <div class="sign-in-text">
                    Don't have an account yet? <a href="register.php">Create Account</a>
                </div>
            </form>

            <div class="footer-text">
                Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
