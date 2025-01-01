<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Bos Barbershop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #1a1a1a;
            color: white;
            font-family: 'Poppins', sans-serif  !important;
            position: relative;
            background-image: url('img/membership.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container-acc {
            max-width: 500px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1) !important;
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
            box-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-search {
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.8rem;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        .btn-search:hover {
            background-color: #cc0000;
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
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: signin.php');
        exit();
    }

    require 'config/database.php';

    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT name, email, phone_number, member_number FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_destroy();
        header('Location: signin.php');
        exit();
    }
    ?>

    <!-- Navigation -->
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


    <div class="container-acc mt-5">
        <h1>Account Profile</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="text-sm-start">Name</label>
                <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" class="form-control mt-2" name="name" disabled>
            </div>
            <div class="mb-3">
                <label class="text-sm-start">Email</label>
                <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control mt-2" name="email" disabled>
            </div>
            <div class="mb-3">
                <label class="text-sm-start">Phone Number</label>
                <input type="text" value="<?php echo htmlspecialchars($user['phone_number']); ?>" class="form-control mt-2" name="phone" disabled>
            </div>
            <div class="mb-3">
                <label class="text-sm-start">Member Number</label>
                <input type="text" value="<?php echo htmlspecialchars($user['member_number']); ?>" class="form-control mt-2" name="member_number" disabled>
            </div>
            <button type="submit" class="btn-search">LOGOUT</button>
        </form>
        <div class="footer-text">
            Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
