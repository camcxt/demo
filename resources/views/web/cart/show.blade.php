@include('header')

<style>
.checkOut {
    background: none repeat scroll 0 0 #5a88ca;
    border: medium none;
    color: #fff;
    padding: 13.5px 22px;
    text-transform: uppercase;
    color: #FFFFFF;
    text-decoration: none;
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
                    <h2>Shopping Cart</h2>
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

                <div>
                    @if (session()->has('messageCartEmpty'))
                    <div class="alert alert-danger">
                        {{ session('messageCartEmpty') }}
                    </div>
                    @endif
                    @if (session()->has('messageAmount'))
                    <div class="alert alert-danger">
                        {{ session('messageAmount') }}
                    </div>
                    @endif
                    <div id="messError">

                    </div>
                </div>

                <div class="product-content-right">
                    <div class="woocommerce">

                        <table style="width:100%" cellspacing="0" class="shop_table cart">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="product-remove">&nbsp;</th>
                                    <th style="width:15%" class="product-thumbnail">&nbsp;</th>
                                    <th style="width:30%" class="product-name">Product</th>
                                    <th style="width:10%" class="product-price">Price</th>
                                    <th style="width:30%" class="product-quantity">Quantity</th>
                                    <th style="width:10%" class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row"></tr>

                                @foreach ($carts as $cartList)
                                <tr class="cart_item">

                                    <td class="product-remove" style="text-align: center;">
                                        <button title="Remove this item"
                                            data-url="{{ route('deleteCart', $cartList->rowId) }}"
                                            data-name="{{ $cartList->name }}" data-id="{{ $cartList->rowId }}"
                                            class="remove btn-delete btn btn-danger">x</button>
                                    </td>

                                    <td class="product-thumbnail" style="text-align: center;">
                                        <a href=""><img width="145" height="145" alt="poster_1_up"
                                                class="shop_thumbnail"
                                                src="/phone/public/images/{{ $cartList->options->image }}"></a>
                                    </td>

                                    <td class="product-name" style="text-align: center;">
                                        <a href="{{ route('showProduct', $cartList->id) }}">{{ $cartList->name }}</a>
                                    </td>

                                    <td class="product-price" style="text-align: center;">
                                        <span class="amount">${{ number_format($cartList->price) }}</span>
                                    </td>

                                    <td class="product-quantity" style="text-align: center;">
                                        <div class="quantity buttons_added">
                                            <ul>
                                                <button data-url="{{ route('quantityPlus') }}"
                                                    data-urlDelete="{{ route('deleteCart', $cartList->rowId) }}"
                                                    data-status="minusCart" data-id="{{ $cartList->rowId }}"
                                                    class="btn btn-primary minus quantityUpdate">-</button>
                                                <input type="number" size="3" id="quantity-{{ $cartList->rowId }}"
                                                    class="input-text qty text" title="Qty"
                                                    data-qty="{{ $cartList->qty }}" data-id="{{ $cartList->rowId }}"
                                                    data-product="{{ $cartList->id }}"
                                                    name="quantity[{{ $cartList->rowId }}]" value="{{ $cartList->qty }}"
                                                    min="0" step="1">
                                                <button data-url="{{ route('quantityPlus') }}"
                                                    data-urlDelete="{{ route('deleteCart', $cartList->rowId) }}"
                                                    data-status="addCart" data-id="{{ $cartList->rowId }}"
                                                    class="btn btn-primary plus quantityUpdate">+</button>
                                            </ul>
                                        </div>
                                    </td>

                                    <td class="product-subtotal" style="text-align: center;">
                                        <span id="cost-{{ $cartList->rowId }}"
                                            class="amount">${{ number_format($cartList->price * $cartList->qty ) }}
                                        </span>
                                    </td>

                                </tr>
                                @endforeach

                                <tr>

                                    <td class="actions" colspan="6">
                                        <div class="coupon">
                                            <label for="coupon_code">Coupon:</label>
                                            <input type="text" placeholder="Coupon code" value="" id="coupon_code"
                                                class="input-text" name="coupon_code">
                                            <input type="submit" value="Apply Coupon" name="apply_coupon"
                                                class="button">
                                        </div>
                                        <input type="submit" value="Update Cart" data-url="{{ route('update_Cart') }}"
                                            name="update_cart" class="button button-update">
                                        <a class="checkOut" href="{{ route('createOrder') }}">Check Out</a>
                                    </td>

                                </tr>
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
                                <h2>Cart Totals</h2>
                                <table cellspacing="0">
                                    <tbody>

                                        <tr class="cart-subtotal">
                                            <th>Total quantity</th>
                                            <td><span class="total">{{ $quantity }}</span></td>
                                        </tr>

                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount totalCart">${{ number_format($totalMoney) }}</span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span
                                                        class="amount totalCart">${{ number_format($totalMoney)}}</span></strong>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
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
<script src="/phone/resources/js/cartJS.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var url = $(this).attr('data-url');
            var itemName = $(this).data('name');
            var _this = $(this);
            if (confirm('Do you want to delete item ' + itemName + '?')) {
                $.ajax({
                    method: 'GET',
                    url: url,
                    type: 'delete',
                    success: function(response) {
                        _this.parent().parent().remove()
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            }
        })
    });

    $('.button-update').on('click', function() {
        var url = $(this).data('url');
        listCart = [];
        var total = 0;

        $('table tbody tr td').each(function() {
            $(this).find('input.qty').each(function() {
                var data = {
                    key: $(this).data('id'),
                    value: $(this).val()
                };
                listCart.push(data);
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                data: listCart,
            },
            success: function(response) {
                $.each(response.carts, function(key, item) {
                    total = item.price * item.qty;
                    $('#cost-' + item.rowId).text(new Intl.NumberFormat().format(total));
                    console.log(item.rowId);
                });
            }
        });
    });
</script> -->