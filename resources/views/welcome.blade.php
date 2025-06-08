<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Laundry - Bersih Cepat Terpercaya</title>
    <meta name="description" content="Layanan laundry profesional, cepat, dan terpercaya untuk semua kebutuhan Anda. Coba sekarang dan nikmati layanan terbaik kami!">
    
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Animated Background */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><radialGradient id="bubble" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1)"/><stop offset="100%" style="stop-color:rgba(255,255,255,0)"/></radialGradient></defs><circle cx="20" cy="20" r="3" fill="url(%23bubble)"/><circle cx="80" cy="40" r="2" fill="url(%23bubble)"/><circle cx="40" cy="80" r="4" fill="url(%23bubble)"/><circle cx="90" cy="70" r="2.5" fill="url(%23bubble)"/><circle cx="10" cy="60" r="3.5" fill="url(%23bubble)"/></svg>') repeat;
            animation: float 20s infinite linear;
            opacity: 0.3;
        }

        @keyframes float {
            0% { transform: translateY(0px) translateX(0px); }
            33% { transform: translateY(-30px) translateX(20px); }
            66% { transform: translateY(-20px) translateX(-20px); }
            100% { transform: translateY(0px) translateX(0px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: slideInUp 1s ease-out;
        }

        .hero .lead {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        .btn-custom {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navbar */
        .navbar {
            background: rgba(255,255,255,0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #667eea !important;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #667eea !important;
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: #f8f9fa;
            position: relative;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102,126,234,0.05) 0%, transparent 70%);
            transition: transform 0.5s ease;
            transform: scale(0);
        }

        .feature-card:hover::before {
            transform: scale(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
        }

        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
            position: relative;
            z-index: 2;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        /* Services Section */
        .services {
            padding: 100px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .service-item {
            text-align: center;
            padding: 30px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .service-item:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-5px);
        }

        .service-item i {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #fff;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: #fff;
            position: relative;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 60px 0 20px;
        }

        .footer h5 {
            color: #ecf0f1;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer ul li a:hover {
            color: #3498db;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #3498db;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #2980b9;
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero .lead {
                font-size: 1.1rem;
            }
            
            .btn-custom {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-tshirt me-2"></i>ZIA LAUNDRY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#keunggulan">Keunggulan</a></li>
                <li class="nav-item"><a class="nav-link btn btn-outline-primary rounded-pill px-3 ms-2" href="{{route('login')}}">Login</a></li>
                <li class="nav-item"><a class="nav-link btn btn-outline-primary rounded-pill px-3 ms-2" href="{{route('register')}}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold">Laundry Mudah & Cepat</h1>
                    <p class="lead">Solusi terbaik untuk pakaian bersih dan wangi tanpa ribet. Nikmati layanan laundry profesional dengan teknologi modern dan pelayanan terdepan.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{route('register')}}" class="btn btn-light btn-custom">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{route('login')}}" class="btn btn-outline-light btn-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <i class="fas fa-tshirt" style="font-size: 15rem; opacity: 0.2; animation: float 3s ease-in-out infinite;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="keunggulan" class="features">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold mb-3 fade-in">Mengapa Memilih Kami?</h2>
                <p class="lead text-muted fade-in">Kami berkomitmen memberikan layanan terbaik dengan standar kualitas tinggi</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h5>Bersih & Wangi</h5>
                    <p>Menggunakan deterjen berkualitas tinggi yang aman untuk semua jenis kain. Pakaian Anda akan kembali bersih, wangi, dan terawat dengan baik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5>Cepat & Tepat Waktu</h5>
                    <p>Proses pencucian hanya 1–3 hari Kami selalu tepat waktu dan dapat diandalkan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h5>Harga Terjangkau</h5>
                    <p>Biaya laundry mulai dari Rp5.000 per kilogram. Harga yang kompetitif dan cocok untuk semua kalangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="layanan" class="services">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold mb-3">Layanan Kami</h2>
                <p class="lead">Berbagai pilihan layanan untuk memenuhi kebutuhan Anda</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <i class="fas fa-wash"></i>
                    <h5>Cuci Reguler</h5>
                    <p>Layanan cuci standar untuk pakaian sehari-hari</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <i class="fas fa-iron"></i>
                    <h5>Cuci + Setrika</h5>
                    <p>Pakaian dicuci bersih dan disetrika rapi</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <i class="fas fa-truck"></i>
                    <h5>Antar Jemput</h5>
                    <p>Layanan antar jemput gratis dalam radius 5km</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <i class="fas fa-star"></i>
                    <h5>Express</h5>
                    <p>Layanan kilat 24 jam untuk kebutuhan mendesak</p>
                </div>
            </div>

               <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link text-start">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

<script>
  
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
</script>

</body>
</html>