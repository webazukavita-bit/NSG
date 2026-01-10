<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>{{ config('app.name') }}</title>
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/config/'.config('app.auth_logo')) }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/assets/css/dashboard.css')}}">
    
</head>
<body>
    <!-- Header -->
    <header class="header-custom">
        <div class="container-fluid px-4 py-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo-container">
                    <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="logo-img">
                </div>
                
                <div class="text-white user-info">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="text-end">
                            <p class="small fw-medium">Welcome {{Auth::user()->name}}</p>
                            <p class="small opacity-75">User ID: {{Auth::user()->code}}</p>
                            <p class="small opacity-75">A/c balance: {{Auth::user()->wallet->main_balance ?? '0'}}</p>
                        </div>
                        <div>
                            <button class="logout-btn">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
             <div class="logos">
                    <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="logo-img">
                </div>
               <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
                   <div class="collapse navbar-collapse" id="navbarNav">
                <button class="sidebar-close d-lg-none" onclick="closeSidebar()">
                    <i class="fas fa-times"></i>
                </button>
               
                <ul class="navbar-nav py-2" style="gap:10px;">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                     
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings / Setup
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                
                                <a class="dropdown-item" href="{{route('changepwd')}}">
                                    <i class="fas fa-key"></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('editprofile')}}">
                                    <i class="fas fa-user"></i>
                                    <span>Edit My Profile</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>

                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('fund-add')}}">Add Money</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rate List</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">Add Order</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order Status</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Support
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/contact-us">
                                    <i class="fas fa-envelope"></i>
                                    <span>Contact us</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/terms-and-conditions">
                                    <i class="fas fa-file-contract"></i>
                                    <span>Term & Condition</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="container my-4">
        @yield('main')
    </div>

    <!-- Footer -->
    {{-- <footer class="footer-custom">
        <div class="container text-center">
            <p class="small">© 2026 New Select Graphix. All rights reserved.</p>
            <p class="small text-secondary mt-2">Complete work press house</p>
        </div>
    </footer> --}}
    	@stack('scripts')
	
	

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>