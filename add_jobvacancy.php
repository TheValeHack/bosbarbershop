<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job Vacancy - Bos Barbershop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif  !important;
            color: white;
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

    <!-- Navigation -->
    <?php
        session_start();
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">BOS BARBERSHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="register-container">
            <div class="logo">
                <h2>ADD JOB VACANCY</h2>
                <p>Add job vacancy</p>
            </div>
            <form method="POST">
            <?php
                require 'config/database.php';
                require 'config/admins.php';
            
                if (isset($_SESSION['user_id'])) {
                    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $user_email = $stmt->fetchColumn();
                } else {
                    $user_email = null;
                }
            
                if (!$user_email || !in_array($user_email, $admins)) {
                    header('Location: index.php');
                    exit;
                }

                $barbershops = $pdo->query("SELECT id, name FROM barbershops")->fetchAll(PDO::FETCH_ASSOC);
                $locations = $pdo->query("SELECT id, name FROM locations")->fetchAll(PDO::FETCH_ASSOC);
                $jobs = $pdo->query("SELECT id, title FROM jobs")->fetchAll(PDO::FETCH_ASSOC);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $barbershop_id = $_POST['barbershop'] ?? '';
                    $location_id = $_POST['location'] ?? '';
                    $job_id = $_POST['job'] ?? '';
                    $max_applicants = $_POST['max_applicants'] ?? '';

                    if ($barbershop_id && $location_id && $job_id && $max_applicants) {
                        try {
                            $stmt = $pdo->prepare("INSERT INTO job_vacancies (barbershop_id, location_id, job_id, max_applicants) VALUES (?, ?, ?, ?)");
                            $stmt->execute([$barbershop_id, $location_id, $job_id, $max_applicants]);
                            echo '<div class="alert alert-success">Job vacancy added successfully!</div>';
                        } catch (PDOException $e) {
                            echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">All fields are required.</div>';
                    }
                }
                ?>

                <div class="mb-3">
                    <select name="barbershop" class="form-control" required>
                        <option value="" disabled selected>Choose Barbershop</option>
                        <?php foreach ($barbershops as $barbershop): ?>
                            <option style="color:black;" value="<?php echo htmlspecialchars($barbershop['id']); ?>">
                                <?php echo htmlspecialchars($barbershop['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <select name="location" class="form-control" required>
                        <option value="" disabled selected>Choose Location</option>
                        <?php foreach ($locations as $location): ?>
                            <option style="color:black;" value="<?php echo htmlspecialchars($location['id']); ?>">
                                <?php echo htmlspecialchars($location['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <select name="job" class="form-control" required>
                        <option value="" disabled selected>Choose Job</option>
                        <?php foreach ($jobs as $job): ?>
                            <option style="color:black;" value="<?php echo htmlspecialchars($job['id']); ?>">
                                <?php echo htmlspecialchars($job['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="max_applicants" placeholder="Max Applicants" required>
                </div>

                <button type="submit" class="btn btn-register">Add</button>
            </form>

            <div class="footer-text">
                Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
