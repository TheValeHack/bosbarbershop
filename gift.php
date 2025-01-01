<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Cards - Bos Barbershop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: black;
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            width: 100vw;
            overflow: hidden;
            position: relative;
            background-image: url('img/gift.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-items: center;
            align-items: center;
        }
 
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">BOS BARBERSHOP</a>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container overflow-hidden w-100">
            <div  class="mb-5">
                <h1 class="text-white text-md-center fw-bolder">VIP PERKS & SERVICE(S)</h1>
                <p class="text-white text-md-center">Gift Voucher and Discount for Membership</p>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-5">
                <div class="d-flex flex-md-column justify-content-md-center align-items-md-center">
                    <img src="img/Dollar Coin.png" width="100px"/>
                    <div>
                        <h2 class="fw-bold text-white text-md-center">FREEUPKEEPS</h2>
                        <div class="text-white text-md-center">
                            Pembayaran yang dilakukan oleh pelanggan sudah mencapai 300.000
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-md-column justify-content-md-center align-items-md-center">
                    <img src="img/Checked Identification Documents.png" width="100px"/>
                    <div>
                        <h2 class="fw-bold text-white text-md-center">MEMBER EVENT</h2>
                        <div class="text-white text-md-center">
                            Dapat digunakan ketika terdapat event tertentu
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-md-column justify-content-md-center align-items-md-center">
                    <img src="img/Sale Price Tag.png" width="100px"/>
                    <div>
                        <h2 class="fw-bold text-white text-md-center">SPECIAL DISCOUNTS</h2>
                        <div class="text-white text-md-center">
                            Pemberian diskon yang diberikan untuk pelanggan special
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="footer-text w-100 text-center text-white position-absolute bottom-0 mb-5 px-2">
            Nikmati kenyamanan potong rambut bersama Bos Barbershop! 🎉
        </div>
    </section>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>