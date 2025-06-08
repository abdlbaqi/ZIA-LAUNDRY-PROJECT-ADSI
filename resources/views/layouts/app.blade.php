
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laundry App')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            margin: 2px 0;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .main-content {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .stats-card {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
        }
        .stats-card.success {
            background: linear-gradient(135deg, #4ecdc4, #26de81);
        }
        .stats-card.warning {
            background: linear-gradient(135deg, #feca57, #ff9ff3);
        }
        .stats-card.info {
            background: linear-gradient(135deg, #54a0ff, #2e86de);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
                @if(auth()->user()->isAdmin())
                    <!-- Admin Sidebar -->
                    <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                        <div class="position-sticky pt-3">
                            <div class="text-center mb-4">
                                <h5 class="text-white">Admin Panel</h5>
                                <small class="text-white-50">{{ auth()->user()->name }}</small>
                            </div>
                            
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.orders.index') }}">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Pesanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.services.index') }}">
                                        <i class="fas fa-cogs me-2"></i>
                                        Layanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.customers.index') }}">
                                        <i class="fas fa-users me-2"></i>
                                        Pelanggan
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.pembayaran*') ? 'active' : '' }}" 
                                       href="{{ route('admin.pembayaran.index') }}">
                                   <i class="bi bi-credit-card me-2"></i>
                                        Pembayaran
                                    </a>
                                </li>

                                <li class="nav-item mt-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link text-start">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                @else
                    <!-- Customer Sidebar -->
                    <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                        <div class="position-sticky pt-3">
                            <div class="text-center mb-4">
                                <h5 class="text-white">Menu</h5>
                                <small class="text-white-50">{{ auth()->user()->name }}</small>
                            </div>
                            
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" 
                                       href="{{ route('customer.dashboard') }}">
                                        <i class="fas fa-home me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}" 
                                       href="{{ route('customer.orders.index') }}">
                                        <i class="fas fa-list me-2"></i>
                                        Pesanan Saya
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('customer.layanan.*') ? 'active' : '' }}" 
                                       href="{{ route('customer.layanan.index') }}">
                                        <i class="fas fa-list me-2"></i>
                                        Lihat Layanan
                                    </a>
                                </li>

                                
                                
                            
                                <li class="nav-item mt-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link text-start">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                @endif
                
                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            @else
                <!-- Guest layout - full width -->
                <main class="col-12">
            @endauth
            
            <div class="py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
            </main>
            
            @auth
        </div>
    </div>
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>