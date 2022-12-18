@include('header')

<style>
    button,
    input,
    select,
    textarea {
        margin: 0;
        font-size: 100%;
        vertical-align: middle;
    }
</style>

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
                    <li><a href="{{ route('shop') }}">Product</a></li>
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
                    <h2>Order</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

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
                    <div class="woocommerce">

                        <div class="col-3">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail" style="width: 30%;">Name</th>
                                        <th class="product-name" style="width: 10%;">Phone</th>
                                        <th class="product-price" style="width: 40%;">Product</th>
                                        <th class="product-quantity" style="width: 10%;">Total</th>
                                        <th class="product-subtotal" style="width: 10%;">Actiton</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $orderList)
                                    @if (isset($orderList->user_id))
                                    <tr class="cart_item">

                                        <td class="product-thumbnail">
                                            <a href="{{ route('showItem', $orderList->id) }}">{{ $orderList->customer_name }}</a>
                                        </td>

                                        <td class="product-name">
                                            <a href="{{ route('showItem', $orderList->id) }}">{{ $orderList->customer_phone }}</a>
                                        </td>

                                        <td class="product-price" style="text-align: left;">
                                            @foreach ($orderItem as $items)
                                            @if ($orderList->id == $items->order_id)
                                            <p>- {{ $items->product_name }} (<span>{{ $items->product_quantity }}</span>)</p>
                                            @endif
                                            @endforeach
                                        </td>

                                        <td class="product-quantity">
                                            <span class="amount">${{ number_format($orderList->total_money) }}</span>
                                        </td>

                                        <td>
                                            <a href="{{ route('showItem', $orderList->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
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