@include('header')
@section('title') {{'Page Title Goes Here'}} @endsection

<body>
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
                        @if (url()->full() == "http://localhost:7882/phone/public/showbyView/1")
                        <h2>Top Sellers</h2>
                        @elseif (url()->full() == "http://localhost:7882/phone/public/showbyView/2")
                        <h2>Recently Viewed</h2>
                        @elseif (url()->full() == "http://localhost:7882/phone/public/showbyView/3")
                        <h2>Top New</h2>
                        @else
                        <h2>Product</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @foreach ( $products as $productList )
                <form action="{{ route('addCart') }}" method="post">
                    @csrf
                    <div class="col-md-3 col-sm-6" style='height:400px;'>
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="/phone/public/images/{{ $productList->image }}" style='height:200px; width: 100%;' alt="không tải được">
                            </div>
                            <h2 style="height: 50px;"><a href="{{route('showProduct', $productList->id)}}">{{ $productList->name }}</a></h2>
                            <div class="product-carousel-price">
                                <ins>${{ number_format($productList->price) }}</ins> @if($productList->old_price != 0)<del>${{ number_format($productList->old_price) }}</del>@endif
                            </div>

                            <div class="product-option-shop">

                                <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>

                            </div>
                        </div>
                    </div>
                    @if (isset(Auth::user()->id))
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <input type="hidden" value="{{ $productList->id }}" name="product_id">
                    <input type="hidden" value="1" name="quantity">
                    <input type="hidden" value="{{ $productList->name }}" name="product_name">
                    <input type="hidden" value="{{ $productList->image }}" name="product_image">
                    <input type="hidden" value="{{ $productList->price }}" name="product_price">
                    @else
                    <input type="hidden" value="{{ $productList->id }}" name="product_id">
                    <input type="hidden" value="1" name="quantity">
                    <input type="hidden" value="{{ $productList->name }}" name="product_name">
                    <input type="hidden" value="{{ $productList->image }}" name="product_image">
                    <input type="hidden" value="{{ $productList->price }}" name="product_price">
                    @endif
                </form>
                @endforeach

                <div class="row">
                    <div class="col-md-12">
                        <div class="product-pagination text-center">
                            <nav>
                                <ul class="pagination">
                                    @if (Request::route()->getName() != "showbyView")
                                        <li> {!! $products->links() !!}</li>
                                    @endif
                                </ul>
                            </nav>
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
</body>