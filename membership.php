<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Member - Bos Barbershop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif  !important;
            color: white;
            position: relative;
            background-image: url('img/membership.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .result {
            margin-top: 1.5rem;
        }

        .result p {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <?php
    $result = null;
    $invoices = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'config/database.php';

        $member_number = trim($_POST['number_member']);

        if (!empty($member_number)) {
            try {
                $stmt = $pdo->prepare("SELECT id, name, email, phone_number, member_number FROM users WHERE member_number = ?");
                $stmt->execute([$member_number]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $user_id = $result['id'];
                    $stmt = $pdo->prepare("SELECT invoice_date, service FROM invoices WHERE user_id = ? ORDER BY invoice_date DESC");
                    $stmt->execute([$user_id]);
                    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = 'Member not found.';
                }
            } catch (PDOException $e) {
                $result = 'Error: ' . $e->getMessage();
            }
        } else {
            $result = 'Please enter a member number.';
        }
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

    <div class="background-pattern"></div>
    
    <div class="container mt-5">
        <div class="register-container">
            <div class="logo">
                <h2>WELCOME PARTNERS BOS BARBERSHOP</h2>
                <p>Search Member Data</p>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <input type="number" class="form-control" name="number_member" placeholder="Nomor Member" required>
                </div>
                <button type="submit" class="btn btn-register">SEARCH</button>
            </form>

            <div class="result">
                <?php if ($result): ?>
                    <?php if (is_array($result)): ?>
                        <p class="mb-4"><strong>Name</strong> <br/><?php echo htmlspecialchars($result['name']); ?></p>
                        <p class="mb-4"><strong>Member Number</strong><br/><?php echo htmlspecialchars($result['member_number']); ?></p>
                    <?php else: ?>
                        <p><?php echo htmlspecialchars($result); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php if ($invoices): ?>
                <div>
                    <p><strong>History Invoice</strong></p>
                    <ul class="list-unstyled">
                        <?php foreach ($invoices as $invoice): ?>
                            <?php $formatted_date = (new DateTime($invoice['invoice_date']))->format('d/m/Y'); ?>
                            <li>
                                <div class="d-flex gap-4">
                                    <div>
                                        <?php echo htmlspecialchars($formatted_date); ?>
                                    </div>
                                    <div>
                                        <?php echo htmlspecialchars($invoice['service']); ?>
                                    </div>
                                </div>
                                
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="footer-text">
                Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
