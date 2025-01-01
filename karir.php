<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Jobs - Bos Barbershop</title>
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

        .clear-filters {
            text-align: right;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .clear-filters a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .clear-filters a:hover {
            text-decoration: underline;
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

        .apply-btn {
            margin-top: 0.5rem;
            width: 100%;
        }

        .apply-btn a {
            width: 100%;
            text-decoration: none;
            color: white;
            background-color: #ff0000;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }

        .apply-btn a:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <?php
    require 'config/database.php';

    $barbershops = $pdo->query("SELECT id, name FROM barbershops")->fetchAll(PDO::FETCH_ASSOC);

    $locations = $pdo->query("SELECT id, name FROM locations")->fetchAll(PDO::FETCH_ASSOC);

    $categories = $pdo->query("SELECT id, title FROM jobs")->fetchAll(PDO::FETCH_ASSOC);

    $cities = $pdo->query("SELECT id, name FROM cities")->fetchAll(PDO::FETCH_ASSOC);

    $results = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $barbershop = $_POST['barbershop'] ?? '';
        $location = $_POST['location'] ?? '';
        $category = $_POST['category'] ?? '';
        $city = $_POST['city'] ?? '';

        $query = "SELECT job_vacancies.id AS vacancy_id, jobs.title, CONCAT(locations.name, ', ', cities.name) AS location_city, job_vacancies.max_applicants 
                  FROM job_vacancies 
                  INNER JOIN jobs ON job_vacancies.job_id = jobs.id 
                  INNER JOIN locations ON job_vacancies.location_id = locations.id 
                  INNER JOIN cities ON locations.city_id = cities.id 
                  WHERE 1=1";

        $params = [];

        if ($barbershop) {
            $query .= " AND job_vacancies.barbershop_id = ?";
            $params[] = $barbershop;
        }

        if ($location) {
            $query .= " AND locations.id = ?";
            $params[] = $location;
        }

        if ($category) {
            $query .= " AND jobs.id = ?";
            $params[] = $category;
        }

        if ($city) {
            $query .= " AND cities.id = ?";
            $params[] = $city;
        }

        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $results = 'Error: ' . $e->getMessage();
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

    <div class="container-acc mt-5">
        <h1>Search Jobs Now</h1>
        <form method="POST" id="searchForm">
            <select name="barbershop" class="form-control">
                <option value="" disabled selected>Choose Barbershop</option>
                <?php foreach ($barbershops as $barbershop): ?>
                    <option value="<?php echo htmlspecialchars($barbershop['id']); ?>">
                        <?php echo htmlspecialchars($barbershop['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="location" class="form-control">
                <option value="" disabled selected>Choose Location</option>
                <?php foreach ($locations as $location): ?>
                    <option value="<?php echo htmlspecialchars($location['id']); ?>">
                        <?php echo htmlspecialchars($location['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="category" class="form-control">
                <option value="" disabled selected>Choose Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['id']); ?>">
                        <?php echo htmlspecialchars($category['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="city" class="form-control">
                <option value="" disabled selected>Choose City</option>
                <?php foreach ($cities as $city): ?>
                    <option value="<?php echo htmlspecialchars($city['id']); ?>">
                        <?php echo htmlspecialchars($city['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="clear-filters">
                <a href="#" id="clearFilters">Clear Filters</a>
            </div>

            <button type="submit" class="btn-search">Search</button>
        </form>

        <div class="mt-5">
            <?php if ($results): ?>
                <?php if (is_array($results) && count($results) > 0): ?>
                    <h3 class="fw-bolder">Available Jobs</h3>
                    <ul class="list-unstyled">
                        <?php foreach ($results as $job): ?>
                            <li class="result mb-2 d-flex flex-column">
                                <h3 class="fw-bold"><?php echo htmlspecialchars($job['title']); ?></h3> 
                                <div class="flex align-items-center">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        <g id="SVGRepo_iconCarrier">
                                        <path fill="#ffffff" fill-rule="evenodd" d="M11.291 21.706 12 21l-.709.706zM12 21l.708.706a1 1 0 0 1-1.417 0l-.006-.007-.017-.017-.062-.063a47.708 47.708 0 0 1-1.04-1.106 49.562 49.562 0 0 1-2.456-2.908c-.892-1.15-1.804-2.45-2.497-3.734C4.535 12.612 4 11.248 4 10c0-4.539 3.592-8 8-8 4.408 0 8 3.461 8 8 0 1.248-.535 2.612-1.213 3.87-.693 1.286-1.604 2.585-2.497 3.735a49.583 49.583 0 0 1-3.496 4.014l-.062.063-.017.017-.006.006L12 21zm0-8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" clip-rule="evenodd"/>
                                        </g>
                                    </svg>
                                    <?php echo htmlspecialchars($job['location_city']); ?>
                                </div>
                                <div class="flex align-items-center">
                                    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" 
                                            width="20px" height="20px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                        <g>
                                            <path d="M42,22.3c-2.8-1.1-3.2-2.2-3.2-3.3s0.8-2.2,1.8-3c1.7-1.4,2.6-3.5,2.6-5.8c0-4.4-2.9-8.2-8-8.2
                                                c-4.7,0-7.5,3.2-7.9,7.1c0,0.4,0.2,0.7,0.5,0.9c3.8,2.4,6.1,6.6,6.1,11.7c0,3.8-1.5,7.2-4.2,9.6c-0.2,0.2-0.2,0.6,0,0.8
                                                c0.7,0.5,2.3,1.2,3.3,1.7c0.3,0.1,0.5,0.2,0.8,0.2h12.1c2.3,0,4.1-1.9,4.1-4v-0.6C50,25.9,46.2,24,42,22.3z"/>
                                            <path d="M28.6,36.2c-3.4-1.4-3.9-2.6-3.9-3.9c0-1.3,1-2.6,2.1-3.6c2-1.7,3.1-4.1,3.1-6.9c0-5.2-3.4-9.7-9.6-9.7
                                                c-6.1,0-9.6,4.5-9.6,9.7c0,2.8,1.1,5.2,3.1,6.9c1.1,1,2.1,2.3,2.1,3.6c0,1.3-0.5,2.6-4,3.9c-5,2-9.9,4.3-9.9,8.5V45v1
                                                c0,2.2,1.8,4,4.1,4h27.7c2.3,0,4.2-1.8,4.2-4v-1v-0.4C38,40.5,33.6,38.2,28.6,36.2z"/>
                                        </g>
                                    </svg>
                                    Max <?php echo htmlspecialchars($job['max_applicants']); ?> recruitments
                                </div> 
                                <div class="apply-btn">
                                    <a href="apply_job.php?id=<?php echo htmlspecialchars($job['vacancy_id']); ?>">Apply Now</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No jobs found matching your criteria.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="footer-text">
            Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
        </div>
    </div>

    <script>
        document.getElementById('clearFilters').addEventListener('click', function(e) {
            e.preventDefault();
            const selects = document.querySelectorAll('select');
            selects.forEach(select => select.selectedIndex = 0);
        });
    </script>
    </body>
</html>