<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bos Barbershop</title>
    <!-- Link Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Mengatur font global */
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('img/menu.jpg'); /* Ganti dengan URL gambar */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .menu-card {
            background-color: #000000;
            width: 100%;
            max-width: 280px;
            padding: 20px;
            border-radius: 10px;
        }
        
        .location-header {
            color: #ffffff;
            margin-bottom: 30px;
            padding: 10px 0;
            display: flex;
            align-items: center;
            font-weight: 600;
        }
        
        .location-icon {
            color: #ff0000;
            margin-right: 8px;
        }
        
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            margin-bottom: 15px;
        }
        
        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            padding: 8px 0;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #ff0000;
        }
        
        .footer-text {
            color: #666666;
            font-size: 0.8rem;
            text-align: center;
            margin-top: 30px;
            font-weight: 300;
        }
    </style>
</head>
<body>
    <div class="menu-card">
        <div class="location-header">
            <span class="location-icon">📍</span>
            <span>Yogyakarta</span>
        </div>
        
        <nav>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="services.php" class="nav-link">Service</a>
                </li>
                <li class="nav-item">
                    <a href="membership.php" class="nav-link">Membership</a>
                </li>
                <li class="nav-item">
                    <a href="gift.php" class="nav-link">Gift Cards</a>
                </li>
                <li class="nav-item">
                    <a href="karir.php" class="nav-link">Careers</a>
                </li>
                <li class="nav-item">
                    <a href="account.php" class="nav-link">Account</a>
                </li>
                <?php
                session_start();
                require 'config/database.php';
                require 'config/admins.php';

                if (isset($_SESSION['user_id'])) {
                    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $user_email = $stmt->fetchColumn();
                } else {
                    $user_email = null;
                }

                if ($user_email && in_array($user_email, $admins)) {
                    echo '
                    <li class="nav-item">
                    <a href="menu_admin.php" class="nav-link">Menu Admin</a>
                </li>
                    ';
                }
                ?>
            </ul>
        </nav>

        <div class="footer-text">
            Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
        </div>
    </div>
</body>
</html>
