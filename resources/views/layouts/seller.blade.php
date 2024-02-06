<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/yazy.png" type="image/png">
    <title>Yazu</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex-grow: 1;
    }
</style>
<body>
    <main>
    <div id="app">
        <div class="top-bar bg-info text-white">
            <div class="container justify-content-between">
                <span class="mr-3" style="font-weight:bold;">Call us: +1-123-456-7890</span>
            </div>
        </div>
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/seller/dashboard') }}">
                    <img src="/images/yazy.png" alt="yazu" height="40px" width="45px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto ">
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link font-weight-bold" href="{{url('/seller/product')}}"style="font-size: 18px;">Products</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link" href="{{url('/seller/orders')}}" style="font-size: 18px;">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/seller/tickets')}}" style="font-size: 18px;">Support</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        
                        
                        <li>
                            <a href="/seller/MyAccountPage">
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/hbvyhtse.json"
    trigger="hover"
    colors="primary:#121331"
    style="width:30px;height:30px">
</lord-icon>
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    </main>
    <footer class="bg-dark text-light">
    
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h6>About Us</h6>
                    <p>Welcome to Yazu, your premier destination for premium food supplements. We believe in elevating your health and empowering you to live your best life. Discover a world of wellness and shop now to unleash your full potential with Yazu.</p>
                </div>
                <div class="col-md-4">
                    <h6>Contact Us</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i> 28,rue abderahman sbaa,belle vue , El harrach , alger</li>
                        <li><i class="fas fa-phone-alt"></i> 0542228931</li>
                        <li><i class="fas fa-envelope"></i> yazu@gmail.com</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Follow Us</h6>
                    <ul class="list-inline social-icons">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-secondary text-center py-2">
            <p>&copy; {{ date('Y') }} Yazu. All rights reserved.</p>
        </div>
    </footer> 
</body>

</html>
