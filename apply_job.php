<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Job - Bos Barbershop</title>
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

    <div class="container">
        <div class="register-container">
            <div class="logo">
            <?php
                require 'config/database.php';

                $job_vacancy_id = $_GET['id'] ?? '';
                $job_data = null;

                if ($job_vacancy_id) {
                    $stmt = $pdo->prepare("SELECT jobs.title AS job, barbershops.name AS barbershop, CONCAT(locations.name, ', ', cities.name) AS location_city FROM job_vacancies
                                        INNER JOIN jobs ON job_vacancies.job_id = jobs.id
                                        INNER JOIN locations ON job_vacancies.location_id = locations.id
                                        INNER JOIN cities ON locations.city_id = cities.id
                                        INNER JOIN barbershops ON job_vacancies.barbershop_id = barbershops.id
                                        WHERE job_vacancies.id = ?");
                    $stmt->execute([$job_vacancy_id]);
                    $job_data = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = $_POST['name'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $phone = $_POST['phone'] ?? '';
                    $birth_place = $_POST['birth_place'] ?? '';
                    $birth_date = $_POST['birth_date'] ?? '';
                    $age = $_POST['age'] ?? '';
                    $gender = $_POST['gender'] ?? '';
                    $address = $_POST['address'] ?? '';
                    $document = $_FILES['document'] ?? null;

                    $allowed_extensions = ['webp', 'jpg', 'png', 'jpeg', 'pdf', 'docx'];
                    $allowed_mime_types = [
                        'image/webp', 'image/jpeg', 'image/png', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];

                    $upload_dir = 'uploads/';
                    $uploaded_file = $upload_dir . basename($document['name']);
                    $file_extension = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));

                    if (!in_array($file_extension, $allowed_extensions) || !in_array(mime_content_type($document['tmp_name']), $allowed_mime_types)) {
                        echo '<div class="alert alert-danger">Invalid file type. Only images (webp, jpg, png, jpeg) and documents (pdf, docx) are allowed.</div>';
                    } else {
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }

                        if (move_uploaded_file($document['tmp_name'], $uploaded_file)) {
                            try {
                                $stmt = $pdo->prepare("INSERT INTO job_applications (job_vacancy_id, name, email, phone, birth_place, birth_date, age, gender, address, document_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->execute([$job_vacancy_id, $name, $email, $phone, $birth_place, $birth_date, $age, $gender, $address, $uploaded_file]);

                                $to = $email;
                                $subject = "Thank You for Applying!";
                                $message = "<h1>Thank You for Applying!</h1>
                                            <p>Dear $name,</p>
                                            <p>Thank you for applying for the position of <strong>{$job_data['job']}</strong> at <strong>{$job_data['barbershop']}</strong> in <strong>{$job_data['location_city']}</strong>.</p>
                                            <p>Here is a summary of your application:</p>
                                            <ul>
                                                <li><strong>Name:</strong> $name</li>
                                                <li><strong>Email:</strong> $email</li>
                                                <li><strong>Phone:</strong> $phone</li>
                                                <li><strong>Birth Place:</strong> $birth_place</li>
                                                <li><strong>Birth Date:</strong> $birth_date</li>
                                                <li><strong>Age:</strong> $age</li>
                                                <li><strong>Gender:</strong> $gender</li>
                                                <li><strong>Address:</strong> $address</li>
                                            </ul>
                                            <p>We will review your application and get back to you soon.</p>
                                            <p>Best regards,<br>Bos Barbershop Team</p>";
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                $headers .= "From: Bos Barbershop <no-reply@bosbarbershop.com>" . "\r\n";

                                if (mail($to, $subject, $message, $headers)) {
                                    echo '<div class="alert alert-success">Application submitted successfully! Please check your email for review!</div>';
                                } else {
                                    echo '<div class="alert alert-warning">Application submitted, but email could not be sent.</div>';
                                }

                            } catch (PDOException $e) {
                                echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Failed to upload document.</div>';
                        }
                    }
                }
                ?>


                <h2>Apply Job</h2>
                <?php if ($job_data): ?>
                    <p>Fill in this fields to apply job as <strong><?php echo htmlspecialchars($job_data['job']); ?></strong> at <strong><?php echo htmlspecialchars($job_data['barbershop']); ?></strong> in <strong><?php echo htmlspecialchars($job_data['location_city']); ?></strong></p>
                <?php else: ?>
                    <p>Job information could not be retrieved.</p>
                <?php endif; ?>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="birth_place" placeholder="Birth Place" required>
                </div>

                <div class="mb-3">
                    <input type="date" class="form-control" name="birth_date" placeholder="Birth Date" required>
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                </div>

                <div class="mb-3">
                    <select name="gender" class="form-control" required>
                        <option value="laki-laki" style="color:black;">Laki-laki</option>
                        <option value="perempuan" style="color:black;">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="document" placeholder="Document" required>
                </div>

                <button type="submit" class="btn btn-register">Apply</button>
            </form>

            <div class="footer-text">
                Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
