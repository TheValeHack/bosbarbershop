<?php
require 'config/database.php';
session_start();
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

$job_vacancy_id = $_GET['id'] ?? '';
$job_data = null;
$applications = [];

if ($job_vacancy_id) {
    $stmt = $pdo->prepare("SELECT jobs.title AS job, barbershops.name AS barbershop, CONCAT(locations.name, ', ', cities.name) AS location_city FROM job_vacancies
                        INNER JOIN jobs ON job_vacancies.job_id = jobs.id
                        INNER JOIN locations ON job_vacancies.location_id = locations.id
                        INNER JOIN cities ON locations.city_id = cities.id
                        INNER JOIN barbershops ON job_vacancies.barbershop_id = barbershops.id
                        WHERE job_vacancies.id = ?");
    $stmt->execute([$job_vacancy_id]);
    $job_data = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT name, email, phone, birth_place, birth_date, age, gender, address, document_path FROM job_applications WHERE job_vacancy_id = ?");
    $stmt->execute([$job_vacancy_id]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Job Applications - Bos Barbershop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif !important;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .result {
            margin-top: 2rem;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 8px;
        }

        a {
            color: #ff0000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="background-pattern"></div>

    <div class="container">
        <div class="register-container">
            <div class="logo">
                <h2>Review Job Applications</h2>
                <?php if ($job_data): ?>
                    <p>Review job applications as <strong><?php echo htmlspecialchars($job_data['job']); ?></strong> at <strong><?php echo htmlspecialchars($job_data['barbershop']); ?></strong> in <strong><?php echo htmlspecialchars($job_data['location_city']); ?></strong>.</p>
                <?php else: ?>
                    <p>Job information could not be retrieved.</p>
                <?php endif; ?>
            </div>

            <?php if (!empty($applications)): ?>
                <?php foreach ($applications as $application): ?>
                    <div class="result">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($application['name']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($application['email']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control" value="<?php echo htmlspecialchars($application['phone']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Birth Place</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($application['birth_place']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Birth Date</label>
                            <input type="date" class="form-control" value="<?php echo htmlspecialchars($application['birth_date']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Age</label>
                            <input type="number" class="form-control" value="<?php echo htmlspecialchars($application['age']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Gender</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($application['gender']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($application['address']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Attachment</label>
                            <div>
                                <a href="<?php echo htmlspecialchars($application['document_path']); ?>" target="_blank">See Document</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No applications found for this job vacancy.</p>
            <?php endif; ?>

            <div class="footer-text">
                Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
