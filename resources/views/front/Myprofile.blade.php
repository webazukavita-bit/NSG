@extends('front.layouts.dashboard')
@section('main')

<main class="container py-4">
    <!-- Title Section -->
    <div class="text-center mb-4">
        <h3 class="fw-bold">MONTHLY PERFORMANCE OVERVIEW</h3>
        <p class="text-muted fs-5">For January 2026</p>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-4">
        <!-- City-Wise Ranking -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0">City-Wise Ranking</h3>
                    <svg class="text-danger" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                
                <div class="stat-box mb-3">
                    <p class="small text-muted mb-2">Your Rank in Lucknow</p>
                    <p class="display-4 fw-bold text-primary mb-0">46</p>
                </div>
                
                <div class="stat-box">
                    <p class="small text-muted mb-1">Total Active Printers in Lucknow</p>
                    <p class="small text-secondary mb-2">(Who Place Orders Directly on Our Website)</p>
                    <p class="display-6 fw-bold text-primary mb-0">253</p>
                </div>
            </div>
        </div>

        <!-- State-Wise Ranking -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0">State-Wise Ranking</h3>
                    <svg class="text-danger" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                
                <div class="stat-box mb-3">
                    <p class="small text-muted mb-2">Your Rank in UTTAR PRADESH</p>
                    <p class="display-4 fw-bold text-primary mb-0">480</p>
                </div>
                
                <div class="stat-box">
                    <p class="small text-muted mb-1">Active Printers in UTTAR PRADESH state</p>
                    <p class="small text-secondary mb-2">(Who Place Orders Directly on Our Website)</p>
                    <p class="display-6 fw-bold text-primary mb-0">3577</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0">Order Summary</h3>
                    <svg class="text-danger" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                
                <div class="stat-box mb-3">
                    <p class="small text-muted mb-2">Visiting Card Orders in December 2025</p>
                    <p class="display-4 fw-bold text-primary mb-0">₹4165.00</p>
                </div>
                
                <div class="stat-box">
                    <p class="small text-muted mb-1">Total Orders in December 2025</p>
                    <p class="small text-secondary mb-2">(Including Visiting Card + other categories)</p>
                    <p class="display-6 fw-bold text-primary mb-0">₹4165.00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Activity Level -->
    <div class="stat-card mb-4">
        <div class="text-center">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <h3 class="h4 fw-bold text-danger me-3 mb-0">Business Activity Level</h3>
                <svg class="text-danger" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            
            <div class="my-4">
                <p class="display-1 fw-bold text-success fst-italic mb-0">High</p>
            </div>
            
            <div class="mx-auto" style="max-width: 768px;">
                <p class="fs-5 fw-semibold text-dark mb-2">Compared with All Printers Across India</p>
                <p class="small text-muted">(This performance is based on December 2025 business activity data analyzed through our AI-powered performance evaluation tool. We compare your order volume, frequency, and value against all active printers nationwide to provide you with this ranking.)</p>
            </div>

            <!-- Activity Badge -->
            <div class="mt-4">
                <div class="activity-badge">
                    <span class="pulse-dot"></span>
                    <span class="text-success fw-semibold">Active Business Performance</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->

</main>

@endsection