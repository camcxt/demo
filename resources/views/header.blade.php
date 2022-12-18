<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if (Request::route()->getName() == "shop")
    <title>SHOP TECHNOLOGY | Shop</title>
    @elseif (Request::route()->getName() == "showbyView")
        @if (url()->full() == "http://localhost:7882/phone/public/showbyView/1")
            <title>SHOP TECHNOLOGY | Top Sellers </title>
        @elseif (url()->full() == "http://localhost:7882/phone/public/showbyView/2")
            <title>SHOP TECHNOLOGY | Recently Viewed </title>
        @elseif (url()->full() == "http://localhost:7882/phone/public/showbyView/3")
            <title>SHOP TECHNOLOGY | Top New </title>
        @endif
    @elseif (Request::route()->getName() == "show_Cart")
        <title>SHOP TECHNOLOGY | Shopping Cart</title>
    @elseif (Request::route()->getName() == "showOrder")
        <title>SHOP TECHNOLOGY | Order</title>
    @elseif (Request::route()->getName() == "showItem")
        <title>SHOP TECHNOLOGY | Order</title>
    @elseif (Request::route()->getName() == "createOrder")
        <title>SHOP TECHNOLOGY | Check Out</title>
    @else
        <title>SHOP TECHNOLOGY</title>
    @endif

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/phone/resources/css/cssfe/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/phone/resources/css/cssfe/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/phone/resources/css/cssfe/owl.carousel.css">
    <link rel="stylesheet" href="/phone/resources/css/cssfe/style.css">
    <link rel="stylesheet" href="/phone/resources/css/cssfe/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">

    <!-- 
    [if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->

</head>

<body>

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            @if (isset(Auth::user()->username))
                            <li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->username }} </a></li>
                            <li><a href="{{ route('show_Cart') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                            <li><a href="{{ route('showOrder', Auth::user()->email) }}"><i class="fa fa-suitcase"></i> My Order</a></li>
                            @else
                            <li><a href="#"><i class="fa fa-heart"></i> My Account</a></li>
                            @endif

                            @if (isset(Auth::user()->username))
                            <li> <i class="fa-solid fa-arrow-right-from-bracket"></i><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @else
                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        @if (isset(Auth::user()->username))
                        <h1><a href="./home"><img src="/phone/public/images/logo.png"></a></h1>
                        @else
                        <h1><a href="./"><img src="/phone/public/images/logo.png"></a></h1>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="shopping-item">

                        <a href="{{route('show_Cart')}}">Cart - <span id="totalCost" class="cart-amunt">${{ number_format($totalMoney) }}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count total">{{ $quantity }}</span></a>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

</body>
<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="/phone/resources/js/js/owl.carousel.min.js"></script>
<script src="/phone/resources/js/js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="/phone/resources/js/js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="/phone/resources/js/js/main.js"></script>

<!-- Slider -->
<script type="text/javascript" src="/phone/resources/js/js/bxslider.min.js"></script>
<script type="text/javascript" src="/phone/resources/js/js/script.slider.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/phone/resources/js/searchbyName.js"></script>