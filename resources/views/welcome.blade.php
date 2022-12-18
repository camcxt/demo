<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
</script>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHOP TECHNOLOGY | Home</title>

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


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

                        <a href="{{ route('show_Cart') }}">Cart - <span class="cart-amunt">${{ number_format($totalMoney) }}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{$quantity}}</span></a>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @if (isset(Auth::user()->id))
                        <li><a href="{{ route('home') }}">Home</a></li>
                        @else
                        <li class="active"><a href="{{ route('trangchu') }}">Home</a></li>
                        @endif
                        <li><a href="{{ route('shop') }}">Product</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                @foreach ($banners as $bannerData)

                <li>
                    <img style="height: 500px;" src="/phone/public/images/{{ $bannerData->image_url }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            {{ $bannerData->title }}
                        </h2>
                        <h4 class="caption subtitle">{{ $bannerData->content }}</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>

                @endforeach
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel" style="height: 400px;">
                            @foreach ($products as $productData)
                            <form action="{{ route('addCart') }}" method="post">
                                @csrf
                                <div class="single-product">
                                    <div class="product-f-image" style="height: 200px;">
                                        <img src="/phone/public/images/{{ $productData->image }}" style="text-align: center;" alt="">
                                        <div class="product-hover">
                                            <a href="{{route('showProduct', $productData->id)}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2 style="height: 65px;"><a href="{{route('showProduct', $productData->id)}}">{{ $productData->name }}</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>${{ number_format($productData->price) }}</ins> @if ($productData->old_price != 0) <del>${{ number_format($productData->old_price) }}</del> @endif
                                    </div>
                                    <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                </div>
                                @if (isset(Auth::user()->id))
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                <input type="hidden" value="{{ $productData->id }}" name="product_id">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $productData->name }}" name="product_name">
                                <input type="hidden" value="{{ $productData->image }}" name="product_image">
                                <input type="hidden" value="{{ $productData->price }}" name="product_price">
                                @else
                                <input type="hidden" value="{{ $productData->id }}" name="product_id">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $productData->name }}" name="product_name">
                                <input type="hidden" value="{{ $productData->image }}" name="product_image">
                                <input type="hidden" value="{{ $productData->price }}" name="product_price">
                                @endif
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            @foreach ($brands as $brandList)
                            <img src="/phone/public/images/{{$brandList->image_url}}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="{{ route('showbyView', 1) }}" name="topSell" class="wid-view-more">View All</a>
                        @foreach ($best_sell as $best)
                        <div class="single-wid-product">
                            <a href="{{ route('showProduct',$best->id) }}"><img src="/phone/public/images/{{ $best->image }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ route('showProduct', $best->id) }}">{{ $best->name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>${{ number_format($best->price) }}</ins> @if ($best->old_price != 0) <del>${{ number_format($best->old_price) }}</del> @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Recently Viewed</h2>
                        <a href="{{ route('showbyView', 2) }}" name="viewRecently" class="wid-view-more">View All</a>
                        @if (session()->has('productReviewData'))
                        @foreach (array_reverse(session()->get('productReviewData')) as $key => $productReview)
                        @if ($key < 3) <div class="single-wid-product">
                            <a href="{{route('showProduct', $productReview->id)}}"><img src="/phone/public/images/{{ $productReview->image }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{route('showProduct', $productReview->id)}}">{{ $productReview->name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>${{ number_format($productReview->price) }}</ins> @if ($productReview->old_price != 0) <del>${{ number_format($productReview->old_price) }}</del> @endif
                            </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="{{ route('showbyView', 3) }}" name="newProduct" class="wid-view-more">View All</a>

                    @foreach ($new as $newProduct)
                    <div class="single-wid-product">
                        <a href="{{route('showProduct', $newProduct->id)}}"><img src="/phone/public/images/{{ $newProduct->image }}" alt="" class="product-thumb"></a>
                        <h2><a href="{{route('showProduct', $newProduct->id)}}">{{ $newProduct->name }}</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>${{ number_format($newProduct->price) }}</ins> @if ($newProduct->old_price != 0) <del>${{ number_format($newProduct->old_price) }}</del> @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div> <!-- End product widget area -->

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Order history</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Vendor contact</a></li>
                            <li><a href="#">Front page</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="#">Mobile Phone</a></li>
                            <li><a href="#">Home accesseries</a></li>
                            <li><a href="#">LED TV</a></li>
                            <li><a href="#">Computer</a></li>
                            <li><a href="#">Gadets</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->

    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->

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

</html>