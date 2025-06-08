@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .dashboard-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-gradient);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        animation: float 3s ease-in-out infinite;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transition: height 0.3s ease;
    }

    .stat-card.primary::before { background: var(--primary-gradient); }
    .stat-card.success::before { background: var(--success-gradient); }
    .stat-card.warning::before { background: var(--warning-gradient); }
    .stat-card.info::before { background: var(--info-gradient); }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .stat-card:hover::before {
        height: 8px;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-title {
        font-size: 1rem;
        font-weight: 600;
        color: #64748b;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        position: relative;
    }

    .stat-card.primary .stat-icon { background: var(--primary-gradient); }
    .stat-card.success .stat-icon { background: var(--success-gradient); }
    .stat-card.warning .stat-icon { background: var(--warning-gradient); }
    .stat-card.info .stat-icon { background: var(--info-gradient); }

    .stat-number {
        font-size: 2.8rem;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
        line-height: 1;
        transition: all 0.3s ease;
    }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .stat-change.positive { color: #10b981; }
    .stat-change.negative { color: #ef4444; }

    .quick-actions {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon {
        width: 35px;
        height: 35px;
        background: var(--primary-gradient);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem;
        background: white;
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        text-decoration: none;
    }

    .action-btn.primary:hover { border-color: #667eea; }
    .action-btn.success:hover { border-color: #11998e; }
    .action-btn.info:hover { border-color: #4facfe; }
    .action-btn.warning:hover { border-color: #ff9a9e; }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: white;
        margin-bottom: 1rem;
    }

    .action-btn.primary .action-icon { background: var(--primary-gradient); }
    .action-btn.success .action-icon { background: var(--success-gradient); }
    .action-btn.info .action-icon { background: var(--info-gradient); }
    .action-btn.warning .action-icon { background: var(--warning-gradient); }

    .action-text {
        font-weight: 600;
        color: #1e293b;
        text-align: center;
        margin: 0;
    }

    .recent-orders {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .view-all-btn {
        background: var(--primary-gradient);
        color: white;
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .view-all-btn:hover {
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
    }

    .orders-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .orders-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table th {
        background: #f8fafc;
        padding: 1rem;
        font-weight: 600;
        color: #475569;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }

    .orders-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }

    .orders-table tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-processing { background: #dbeafe; color: #1e40af; }
    .status-ready { background: #d1fae5; color: #065f46; }
    .status-completed { background: #e0e7ff; color: #3730a3; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .order-code {
        font-weight: 700;
        color: #667eea;
    }

    .detail-btn {
        background: var(--info-gradient);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .detail-btn:hover {
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #64748b;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .counter-animation {
        animation: countUp 2s ease-out;
    }

    @keyframes countUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .dashboard-title {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .orders-table {
            overflow-x: auto;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <div class="title-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            Dashboard Admin
        </h1>
        <p class="welcome-text">Selamat datang kembali! Berikut adalah ringkasan aktivitas terbaru.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card primary" onclick="animateNumber(this)">
            <div class="stat-header">
                <div>
                    <h3 class="stat-title">Total Pesanan</h3>
                    <h2 class="stat-number counter-animation" data-target="{{ $totalOrders ?? 0 }}">0</h2>
                    <div class="stat-change positive">
                      
                      
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="stat-card success" onclick="animateNumber(this)">
            <div class="stat-header">
                <div>
                    <h3 class="stat-title">Pesanan Selesai</h3>
                    <h2 class="stat-number counter-animation" data-target="{{ $completedOrders ?? 0 }}">0</h2>
                    <div class="stat-change positive">
                      
                        
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div class="stat-card warning" onclick="animateNumber(this)">
            <div class="stat-header">
                <div>
                    <h3 class="stat-title">Pesanan Proses</h3>
                    <h2 class="stat-number counter-animation" data-target="{{ $processingOrders ?? 0 }}">0</h2>
                    <div class="stat-change negative">
                      
                      
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <div class="stat-card info" onclick="animateNumber(this)">
            <div class="stat-header">
                <div>
                    <h3 class="stat-title">Total Customer</h3>
                    <h2 class="stat-number counter-animation" data-target="{{ $totalCustomers ?? 0 }}">0</h2>
                    <div class="stat-change positive">
                      
                     
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2 class="section-title">
            <div class="section-icon">
                <i class="fas fa-bolt"></i>
            </div>
            Aksi Cepat
        </h2>
        <div class="actions-grid">
            <a href="{{ route('admin.orders.index') }}" class="action-btn primary">
                <div class="action-icon">
                    <i class="fas fa-list"></i>
                </div>
                <p class="action-text">Kelola Pesanan</p>
            </a>
            <a href="{{ route('admin.services.index') }}" class="action-btn success">
                <div class="action-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <p class="action-text">Kelola Layanan</p>
            </a>
            <a href="{{ route('admin.customers.index') }}" class="action-btn info">
                <div class="action-icon">
                    <i class="fas fa-users"></i>
                </div>
                <p class="action-text">Kelola Customer</p>
            </a>
            
            {{-- <a href="{{ route('admin.reports.index') }}" class="action-btn warning"> --}}
                <div class="action-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <p class="action-text">Laporan</p>
            </a>
        </div>
    </div>

<script>
// Counter Animation
function animateCounter(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 20);
}

// Animate all counters on page load
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.stat-number');
    
    // Observer for scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target);
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    });

    counters.forEach(counter => {
        observer.observe(counter);
    });
});

</script>
@endsection