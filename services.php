<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Bos Barbershop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: 'Poppins', sans-serif  !important;
            font-family: 'Poppins', sans-serif;
        }

        .services-container {
            margin: 0 auto;
            padding: 2rem 1rem;
            text-align: center; /* Untuk teks berada di tengah */
            display: flex; /* Gunakan flexbox */
            flex-direction: column; /* Tata letak kolom */
            justify-content: center; /* Pusatkan secara vertikal */
            align-items: center; /* Pusatkan secara horizontal */
            min-height: 100vh; /* Isi tinggi layar sepenuhnya */
            background-image: url('img/menu.jpg'); /* Ganti dengan URL gambar */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .page-title {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 2.5rem;
            color: #fff;
        }

        .service-type {
            background-color: #ff0000; /* Warna latar belakang */
            color: white; /* Warna teks */
            padding: 1rem; /* Jarak dalam */
            border-radius: 8px; /* Sudut membulat */
            margin-bottom: 2rem; /* Tambahkan jarak antar elemen */
            width: 100%; /* Sesuaikan dengan lebar kontainer */
            max-width: 400px; /* Batas maksimum lebar */
            font-weight: bold; /* Teks tebal */
            text-decoration: none; /* Hilangkan garis bawah */
            text-align: center; /* Teks di tengah */
            transition: background-color 0.3s; /* Efek hover */
            cursor: pointer; /* Tunjukkan bahwa elemen dapat diklik */
        }

        .service-type:hover {
            background-color: #cc0000;
        }

        .haircuts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .haircut-card {
            text-align: center;
        }

        .haircut-image {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .haircut-name {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-style: italic;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .navbar-toggler {
            border: none;
        }

        @media (max-width: 576px) {
            .haircuts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                Bos Barbershop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="services-container">
        <h1 class="page-title">Service</h1>
    
        <!-- Service Types -->
        <a class="service-type" href="person_service.php">
            Person service in barbershop
        </a><br>
        <a class="service-type" href="home_service.php">
            Home service
        </a>
    </div>
    

        <!-- Haircut Styles -->
        <div class="haircuts-grid">
            <div class="haircut-card">
                <img src="img/potongan/french.jpg" alt="French Crop" class="haircut-image">
                <div class="haircut-name">French crop</div>
            </div>

            <div class="haircut-card">
                <img src="img/potongan/texture.jpg" alt="Texture Crop" class="haircut-image">
                <div class="haircut-name">Texture crop</div>
            </div>

            <div class="haircut-card">
                <img src="img/potongan/undercut.jpg" alt="Undercut" class="haircut-image">
                <div class="haircut-name">Undercut</div>
            </div>

            <div class="haircut-card">
                <img src="img/potongan/korean.jpg" alt="Korean Perm" class="haircut-image">
                <div class="haircut-name">Korean perm</div>
            </div>
        </div>

        <div class="footer-text">
            Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>