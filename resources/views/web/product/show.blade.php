<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHOP TECHNOLOGY | Product details</title>

    <!-- Google Fonts -->
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

<style>
    label.error {
        color: red;
    }
</style>

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
                        <h1><a href="{{ route('trangchu') }}"><img src="/phone/public/images/logo.png"></a></h1>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="shopping-item">

                        <a href="{{route('show_Cart')}}">Cart - <span class="cart-amunt">${{ number_format($totalMoney) }}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{$quantity}}</span></a>

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
                        <li><a href="{{ route('trangchu') }}">Home</a></li>
                        @endif
                        <li class="active"><a href="{{ route('shop') }}">Product</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Product detail</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <input type="text" name="search" class="searchInput" placeholder="Search products...">
                        <input type="submit" value="Search" data-url="{{ route('searchName') }}" id="btnSearch">
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        <div id="list">
                            @foreach($products as $productGetData)
                            <div class="thubmnail-recent">
                                <img style="width: 30%;" src="/phone/public/images/{{ $productGetData->image }}" class="recent-thumb" alt="">
                                <h2 style="width: 70;"><a href="{{route('showProduct', $productGetData->id)}}">{{ $productGetData->name }}</a></h2>
                                <div class="product-sidebar-price">
                                    <ins>${{ number_format($productGetData->price) }}</ins> @if ($productGetData->old_price != 0) <del>${{ number_format($productGetData->old_price) }}</del> @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="/phone/public/images/{{ $product->image }}" style="height: 200px;" alt="">
                                    </div>
                                    <div class="product-gallery">
                                        @foreach ($productImg as $productImgList)
                                        <img src="/phone/public/images/{{ $productImgList->image_url }}" alt="">
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{ $product->name }}</h2>
                                    <div class="product-inner-price">
                                        <ins>${{ number_format($product->price) }}</ins> @if ($product->old_price != 0) <del>${{ number_format($product->old_price) }}</del> @endif
                                    </div>

                                    <form action="{{ route('addCart') }}" method="post" class="cart">
                                        @csrf
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $product->name }}" name="product_name">
                                        <input type="hidden" value="{{ $product->image }}" name="product_image">
                                        <input type="hidden" value="{{ $product->price }}" name="product_price">
                                        <input type="submit" class="add_to_cart_button" value="ADD Cart">
                                    </form>


                                    @if (isset($product->tags))
                                    <div class="product-inner-category">
                                        <p> Tags: <a href="{{ route('showbyTag', $product->tags) }}">{{ $product->tags }}</a> </p>
                                    </div>
                                    @endif

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            @if (isset(Auth::user()->id))
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <form id="frmProductShow" action="{{ route('storeComment') }}" method="post" class="cart">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="user_name" value="{{ Auth::user()->username }}">
                                                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                        <p><label for="name">Name</label> <input name="name" value="{{ Auth::user()->username }}" disabled type="text"></p>
                                                        <p><label for="review">Your review</label> <textarea name="comments" id="" cols="30" rows="10"></textarea></p>
                                                        <p><input type="submit" value="Submit"></p>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="related-products-wrapper">
                                <h2 class="related-products-title">Related Products</h2>
                                <div class="related-products-carousel">
                                    @foreach($productTag as $productTagByBrand)
                                    @if($productTagByBrand->id != $product->id)
                                    <form action="{{ route('addCart') }}" method="post">
                                        @csrf
                                        <div class="single-product">
                                            <div class="product-f-image">
                                                <img src="/phone/public/images/{{ $productTagByBrand->image }}" alt="">
                                                <div class="product-hover">
                                                    <a href="{{ route('showProduct', $productTagByBrand->id) }}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                                </div>
                                            </div>
                                            <h2><a href="{{ route('showProduct', $productTagByBrand->id) }}">{{ $productTagByBrand->name }}</a></h2>
                                            <div class="product-carousel-price">
                                                <ins>${{ number_format($productTagByBrand->price) }}</ins> @if ($productTagByBrand->old_price != 0) <del>${{ number_format($productTagByBrand->old_price) }}</del> @endif
                                            </div>
                                            <div class="product-option-shop">
                                                <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                            </div>
                                        </div>

                                        <input type="hidden" value="{{ $productTagByBrand->id }}" name="product_id">
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $productTagByBrand->name }}" name="product_name">
                                        <input type="hidden" value="{{ $productTagByBrand->image }}" name="product_image">
                                        <input type="hidden" value="{{ $productTagByBrand->price }}" name="product_price">

                                    </form>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="related-products-wrapper">
                                <h2 class="related-products-title">Comment</h2>
                                @foreach ($comments as $commentList)
                                @if (isset(Auth::user()->id))
                                @if ($commentList->user_id == Auth::user()->id)
                                <form action="{{ route('updateComment') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $commentList->id }}" name="id">
                                    <input type="hidden" value="{{ $commentList->product_id }}" name="product_id">
                                    <p><span style="color: red;">You: </span> <input style="border: 2px hidden #b1154a;" type="text" name="comment" value="{{ $commentList->comments }}"> <button style=" border: none; background-color: #f4f4f4">Sửa</button> </p>
                                </form>
                                @else
                                <p><span style="color: blue;">{{ $commentList->user_name }}: </span> {{ $commentList->comments }} </p>
                                @endif
                                @else
                                <p><span>{{ $commentList->user_name }}: </span> {{ $commentList->comments }} </p>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                            <li><a href="">My account</a></li>
                            <li><a href="">Order history</a></li>
                            <li><a href="">Wishlist</a></li>
                            <li><a href="">Vendor contact</a></li>
                            <li><a href="">Front page</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="">Mobile Phone</a></li>
                            <li><a href="">Home accesseries</a></li>
                            <li><a href="">LED TV</a></li>
                            <li><a href="">Computer</a></li>
                            <li><a href="">Gadets</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </div>

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

</body>

</html>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $("#frmProductShow").validate({
            rules: {
                comments: "required",
            }
        });
    });
</script>