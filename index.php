<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bos Barbershop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif  !important;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background-color: black;
            position: relative;
            background-image: url('img/menu.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            padding: 20px;
            color: #fff;
    
        }
        
        /* About Section */
        .about {
            background-color: #212529;
            color: white;
            padding: 4rem 0;
        }
        
        /* Location Section */
        .location {
            padding: 4rem 0;
            background-color: #f8f9fa;
        }
        
        .business-hours {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        
        /* Testimonials Section */
        .testimonials {
            padding: 4rem 0;
            background-color: white;
        }
        
        .testimonial-card {
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        
        /* Footer */
        footer {
            background-color: #212529;
            color: white;
            padding: 2rem 0;
        }
        
        .star-rating {
            color: #ffd700;
        }

        @media screen and (min-width:768px){
            .hero {
                background-image: url('img/home-desktop.jpg');
            }
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
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
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
        <div class="hero-content">
            <h1 class="display-4 fw-bolder"><span>WELCOME TO BOS BARBERSHOP</span></h1>
            <p class="lead">Come for the Grooming. Stay for the Booze</p>
            <a href="menu.php" class="btn btn-dark btn-lg">LETS GO</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">BOS BARBERSHOP</h2>
                    <p>Kami hadir untuk memberikan pengalaman perawatan rambut terbaik bagi Anda. Bos Barbershop adalah tempat di mana kenyamanan, kualitas, dan kepuasan pelanggan menjadi prioritas utama. Dengan tim profesional dan suasana yang nyaman, kami berkomitmen untuk membantu Anda tampil lebih percaya diri.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Hours Section -->
    <section id="location" class="location">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="business-hours">
                        <h3>Business Hours</h3>
                        <ul class="list-unstyled">
                            <li>Monday: 9:00am - 8:00PM</li>
                            <li>Tuesday: 9:00AM - 8:00PM</li>
                            <li>Wednesday: 9:00AM - 8:00PM</li>
                            <li>Thursday: 9:00AM - 8:00PM</li>
                            <li>Friday: 9:00AM - 8:00PM</li>
                            <li>Saturday: 9:00AM - 8:00PM</li>
                            <li>Sunday: 9:00AM - 4:00PM</li>
                        </ul>
                        <p>Contact: 085-742-346-929</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Location</h3>
                    <p>Jl. Resi Bayu Jl. Kelurahan MKM 02A Condii Kpg, Siaman</p>
                    <div class="map-placeholder bg-secondary" style="height: 300px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31629.037207847676!2d110.408573!3d-7.7228249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5ea55b0c32a1%3A0xb6e4fb3655e80131!2sBos%20Barbershop%20Besi!5e0!3m2!1sid!2sid!4v1735723050100!5m2!1sid!2sid"  style="border:0;width:100%;height:100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <h2 class="text-center mb-5">THEY PEOPLE HAVE SPOKEN</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <h5>Alexander <span class="star-rating">★★★★</span></h5>
                        <p>Barbershop langganan saya, 20 k udah dapat styling rambut, kecamas, pijat kepala. Hanya saja untuk parker disini cukup sulit untuk mobil karena Parkingnya sangat sempit.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <h5>Devandra <span class="star-rating">★★★★★</span></h5>
                        <p>Salah satu barbershop yang ada di jalan Kalurung tepatnya di km 13 simpang 3 besi janjang sleman Yogyakarta, stylist ramah dan berpengalaman, harga murah mulai dari 20rb</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Account</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Account</a></li>
                        <li><a href="#" class="text-white">Appointments</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="services.php" class="text-white">Services</a></li>
                        <li><a href="#" class="text-white">Memberships</a></li>
                        <li><a href="#" class="text-white">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Resources</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Franchising</a></li>
                        <li><a href="#" class="text-white">Group & Events</a></li>
                        <li><a href="#" class="text-white">Privacy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>