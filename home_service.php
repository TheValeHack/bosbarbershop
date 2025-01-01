<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Service - Bos Barbershop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #000000;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .logo a {
            text-decoration: none;
        }

        .menu-icon {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .menu-icon a {
            text-decoration: none;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .price-list-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .price-list-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            text-align: center;
            font-size: 0.9rem;
            color: #666666;
            margin: 20px 0;
        }

        footer span {
            font-weight: 600;
            color: #000000;
        }

        footer .emoji {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo"><a href="index.php">Bos Barbershop</a></div>
        <div class="menu-icon"><a href="menu.php">☰</a></div>
    </header>
    <main>
        <h1>Person Service</h1>
        <div class="price-list-container">
            <img src="img/SnK.jpg" alt="Price List">
            <a href="http://wa.me/62895364911317" class="btn btn-success px-5 py-3 mt-4" style="font-size:20px; border-radius:100px">Chat Whatsapp</a>
        </div>
        <footer>
            Nikmati kenyamanan potong rambut bersama <span>Bos Barbershop</span>! <span class="emoji">🎉</span>
        </footer>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
