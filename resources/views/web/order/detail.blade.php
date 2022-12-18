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
                            <img style="width: 30%;" src="/phone/public/images/{{ $productGetData->image }}"
                                class="recent-thumb" alt="">
                            <h2 style="width: 70;"><a
                                    href="{{route('showProduct', $productGetData->id)}}">{{ $productGetData->name }}</a>
                            </h2>
                            <div class="product-sidebar-price">
                                <ins>${{ number_format($productGetData->price) }}</ins> @if ($productGetData->old_price
                                != 0) <del>${{ number_format($productGetData->old_price) }}</del> @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <div>
                            <h4><b>Customer's name: </b><span>{{ $order->customer_name }}</span></h4>
                            <p><b>Phone: </b><span>{{ $order->customer_phone }}</span></p>
                            <p><b>Email: </b><span>{{ $order->customer_email }}</span></p>
                            <p><b>Address: </b><span>{{ $order->address }}</span></p>
                        </div>

                        &emsp;

                        <div class="col-3">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemOrder as $orderItemList)
                                    <tr class="cart_item">

                                        <td class="product-thumbnail">
                                            <a href="{{ route('showProduct', $orderItemList->product_id) }}"><img
                                                    width="145" height="145" alt="poster_1_up" class="shop_thumbnail"
                                                    src="/phone/public/images/{{ $orderItemList->product_image }}"></a>
                                        </td>

                                        <td class="product-name">
                                            <a
                                                href="{{ route('showProduct', $orderItemList->product_id) }}">{{ $orderItemList->product_name }}</a>
                                        </td>

                                        <td class="product-price">
                                            <span
                                                class="amount">${{ number_format($orderItemList->product_price) }}</span>
                                        </td>

                                        <td>
                                            <span>{{ $orderItemList->product_quantity }}</span>
                                            <input type="hidden" size="3" class="input-text qty text" title="Qty"
                                                name="quantity" value="{{ $orderItemList->product_quantity }}" min="0"
                                                step="1">
                                        </td>

                                        <td class="product-subtotal">
                                            <span
                                                class="amount">${{ number_format($orderItemList->product_price * $orderItemList->product_quantity ) }}
                                            </span>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="cart-collaterals">
                                <div class="cross-sells">
                                    <h2>You may be interested in...</h2>
                                    <ul class="products">
                                        @foreach($productBestSell as $productBestSellData)
                                        <li class="product">
                                            <a href="{{ route('showProduct', $productBestSellData->id) }}">
                                                <img style="height: 100px;" alt="T_4_front"
                                                    class="attachment-shop_catalog wp-post-image"
                                                    src="/phone/public/images/{{ $productBestSellData->image }}">
                                                <h3 style="height: 60px;">{{ $productBestSellData->name }}</h3>
                                                <span class="price"><span
                                                        class="amount">${{ number_format($productBestSellData->price) }}</span></span>
                                            </a>
                                            <a class="add_to_cart_button" data-quantity="1" data-product_sku=""
                                                data-product_id="22" rel="nofollow"
                                                href="{{ route('showProduct', $productBestSellData->id) }}">Select
                                                options</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="cart_totals ">
                                    <h2>Order Totals</h2>
                                    <table cellspacing="0">
                                        <tbody>

                                            <tr class="cart-subtotal">
                                                <th>Total quantity</th>
                                                <td><span class="total">{{ $quantityOrder }}</span></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>Free Shipping</td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span
                                                            class="amount totalCart">${{ number_format($totalMoneyOrder)}}</span></strong>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table> <br>

                                </div>

                            </div>

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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam
                        laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure
                        eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis
                        magni at?</p>
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
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your
                        inbox!</p>
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
                    <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com"
                            target="_blank">freshDesignweb.com</a></p>
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