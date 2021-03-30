<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/font-awesome.min.css">
    <link rel="stylesheet" href="/home/css/animate.css">
    <link rel="stylesheet" href="/home/css/owl.carousel.css">
    <link rel="stylesheet" href="/home/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="/home/css/tooplate-style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<section class="preloader">
    <div class="spinner">
        <span class="spinner-rotate"></span>
    </div>
</section>

<!-- HEADER -->
<header>
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-5">
                <p>Ласкаво просимо</p>
            </div>

            <div class="col-md-8 col-sm-7 text-align-right">
                <span class="phone-icon"><i class="fa fa-phone"></i> +380-67-111-333</span>
                <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 9:00 - 18:00 (Пн-Сб)</span>
                <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">info@company.com</a></span>
                @guest
                    <span class="login-icon"><i class="fa"></i> <a href="{{route('login')}}">Увійти</a></span>
                    <span class="register-icon"><i class="fa"></i> <a href="{{route('register')}}">Зареєструватися</a></span>
                @else

                @endguest
            </div>
        </div>
    </div>
</header>

<!-- MENU -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <!-- lOGO TEXT HERE -->
            <a href="{{route('root')}}" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
        </div>

        <!-- MENU LINKS -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('root')}}" class="smoothScroll">Домашня сторінка</a></li>
                <li><a href="#about" class="smoothScroll">Про нас</a></li>
                <li><a href="{{route('doctors.show')}}" class="smoothScroll">Лікарі</a></li>
                <li><a href="#news" class="smoothScroll">Новини</a></li>
                <li><a href="#google-map" class="smoothScroll">Контакти</a></li>
                <li class="appointment-btn"><a href="{{route('doctors.show')}}">Записатися на прийом</a></li>
                @guest
                @else
                    <li><a class="smoothScroll" href="{{ route('user.profile',Auth::user()->id) }}"><b>МІЙ КАБІНЕТ</b></a></li>
                    <li><a class="smoothScroll" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                            <b>ВИХІД</b>
                    </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </div>
</section>


<!-- HOME -->
<div class="main_container">
    @yield('content')
</div>

<!-- GOOGLE MAP -->
@yield('google_map')


<!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container">
        <div class="row">
            @yield('pre_footer')
            <div class="col-md-12 col-sm-12 border-top">
                <div class="col-md-4 col-sm-6">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2021 Your Company</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-link">
                        <a href="#">Laboratory Tests</a>
                        <a href="#">Departments</a>
                        <a href="#">Insurance Policy</a>
                        <a href="#">Вакансии</a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 text-align-center">
                    <div class="angle-up-btn">
                        <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="/home/js/jquery.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script src="/home/js/jquery.sticky.js"></script>
<script src="/home/js/jquery.stellar.min.js"></script>
<script src="/home/js/wow.min.js"></script>
<script src="/home/js/smoothscroll.js"></script>
<script src="/home/js/owl.carousel.min.js"></script>
<script src="/home/js/custom.js"></script>
</body>

