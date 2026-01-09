<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Helpdesk Pro') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .auth-bg { background-color: #ffffff; }
        .auth-right { 
            position: relative; 
            overflow: hidden;
            background-color: #f1f1f1; /* Fallback color */
        }
        .carousel-item { height: 100vh; }
        .carousel-item img { 
            object-fit: cover; 
            height: 100%; 
            width: 100%; 
            filter: brightness(0.6); 
        }
        .carousel-caption {
             bottom: 20%; 
             text-align: left; 
             left: 10%; 
             right: 10%;
             text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        .form-control-solid {
            background-color: #f5f8fa;
            border-color: #f5f8fa;
            color: #5e6278;
            transition: color 0.2s ease, background-color 0.2s ease;
        }
        .form-control-solid:focus {
            background-color: #eef3f7;
            border-color: #eef3f7;
            box-shadow: none;
        }
        
        /* Custom Input Icon Styling */
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper .svg-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            z-index: 10;
            font-size: 1.2rem;
            color: #a1a5b7;
        }
        .input-icon-wrapper input {
            padding-left: 45px !important; /* Force padding for icon */
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #a1a5b7;
            transition: color 0.2s;
        }
        .password-toggle:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body class="overflow-hidden">
    <div class="row g-0 vh-100">
        <!-- Left Side: Form -->
        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center auth-bg shadow-sm position-relative z-index-2">
            <div class="w-100 p-5 p-lg-10" style="max-width: 500px;">
                <!-- Logo -->
                <div class="text-center mb-10">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h1 class="fw-bolder fs-2x text-dark mb-5" style="letter-spacing: -1px;">
                            <span class="text-primary">HELPDESK</span> PRO
                        </h1>
                    </a>
                </div>

                @yield('content')
            </div>
             <div class="position-absolute bottom-0 start-50 translate-middle-x py-4 text-muted small">
                 &copy; {{ date('Y') }} Helpdesk Pro System
             </div>
        </div>

        <!-- Right Side: Slider -->
        <div class="col-lg-6 d-none d-lg-block auth-right">
            <div id="authCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
                <div class="carousel-indicators mb-5">
                    <button type="button" data-bs-target="#authCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#authCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#authCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner h-100">
                    <div class="carousel-item active">
                        <img src="https://picsum.photos/id/1/800/1200" class="d-block w-100" alt="Support">
                        <div class="carousel-caption">
                            <h2 class="display-4 fw-bold mb-4">Expert Support</h2>
                            <p class="fs-4 fw-light">Our dedicated team is ready to assist you 24/7 with any technical issues.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/id/180/800/1200" class="d-block w-100" alt="Teamwork">
                         <div class="carousel-caption">
                            <h2 class="display-4 fw-bold mb-4">Collaborative Solutions</h2>
                            <p class="fs-4 fw-light">Seamless communication between departments for faster resolution.</p>
                        </div>
                    </div>
                     <div class="carousel-item">
                        <img src="https://picsum.photos/id/3/800/1200" class="d-block w-100" alt="Tech">
                         <div class="carousel-caption">
                            <h2 class="display-4 fw-bold mb-4">Advanced Tools</h2>
                            <p class="fs-4 fw-light">Powered by the latest technology to ensure system reliability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.password-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            });
        });
    </script>
</body>
</html>
