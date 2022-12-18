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
                        <form name="frmAddCart" method="post" action="{{ route('storeOrder') }}">
                            @csrf
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
                                        @foreach ($carts as $cartList)
                                        <tr class="cart_item">

                                            <td class="product-thumbnail">
                                                <a href="{{ route('showProduct', $cartList->id) }}"><img width="145"
                                                        height="145" alt="poster_1_up" class="shop_thumbnail"
                                                        src="/phone/public/images/{{ $cartList->options->image }}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="{{ route('showProduct', $cartList->id) }}">{{ $cartList->name }}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">${{ number_format($cartList->price) }}</span>
                                            </td>

                                            <td>
                                                <span>{{ $cartList->qty }}</span>
                                                <input type="hidden" size="3" class="input-text qty text" title="Qty"
                                                    name="quantity" value="{{ $cartList->qty }}" min="0" step="1">
                                            </td>

                                            <td class="product-subtotal">
                                                <span
                                                    class="amount">${{ number_format($cartList->price * $cartList->qty ) }}
                                                </span>
                                            </td>

                                        </tr>
                                        <input type="hidden" name="idc[{{ $cartList->id }}]"
                                            value="{{ $cartList->id }}">
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-5">
                                <div class="woocommerce-billing-fields">
                                    <h3>Billing Details</h3>
                                    @if (isset(Auth::user()->id))
                                    <input type="hidden" value="{{ Auth::user()->id }}" placeholder="" id="user_id"
                                        name="user_id" class="input-text">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input type="input" disabled style="width: 50%" required
                                            value="{{ Auth::user()->username }}" class="form-control"
                                            placeholder="Enter Name">
                                        <input type="hidden" style="width: 50%" required name="customer_name"
                                            value="{{ Auth::user()->username }}" class="form-control"
                                            placeholder="Enter Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input style="width: 50%" required name="customer_phone" class="form-control"
                                            value="{{ Auth::user()->phone }}" placeholder="Enter Phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input style="width: 50%" disabled value="{{ Auth::user()->email }}" required
                                            class="form-control">
                                        <input style="width: 50%" type="hidden" value="{{ Auth::user()->email }}"
                                            required name="customer_email" class="form-control">
                                    </div>

                                    <input type="hidden" value="{{ Auth::user()->id }}" placeholder="" id="user_id"
                                        name="user_id" class="input-text ">
                                    @else
                                    <input type="hidden" placeholder="" id="user_id" name="user_id" class="input-text">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input style="width: 50%" required name="customer_name" class="form-control"
                                            aria-describedby="emailHelp" placeholder="Enter Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input style="width: 50%" required name="customer_phone" class="form-control"
                                            aria-describedby="emailHelp" placeholder="Enter Phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input style="width: 50%" value="" required name="customer_email"
                                            class="form-control">
                                    </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total Product <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input type="hidden" style="width: 50%" value="{{ $quantity }}" required
                                            name="total_products" class="form-control">
                                        <input disabled style="width: 50%" value="{{ $quantity }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total <abbr title="required"
                                                class="required">*</abbr></label>
                                        <input type="hidden" style="width: 50%" value="{{ $totalMoney }}" required
                                            name="total_money" class="form-control">
                                        <input disabled style="width: 50%" value="${{ number_format($totalMoney) }}"
                                            class="form-control">
                                    </div>

                                    <h3>Address</h3>

                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Provinces <abbr title="required"
                                                class="required">*</abbr>
                                        </label>
                                        <select name="provinces" style="width: 50%" id="provinces"
                                            class="form-control country_to_state country_select choose provinces">
                                            <option value="">---Select provinces---</option>
                                            @foreach ($provinces as $provinceData)
                                            <option value="{{ $provinceData->id }}">{{ $provinceData->name }}</option>
                                            @endforeach
                                        </select>
                                    </p>

                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label for="exampleInputEmail1">Districts <abbr title="required"
                                                class="required">*</abbr></label>
                                        <select name="districts" style="width: 50%" id="districts"
                                            class="form-control country_to_state country_select choose districts">

                                            <option value="">---Select districts---</option>

                                        </select>
                                    </p>

                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Wards <abbr title="required"
                                                class="required">*</abbr> </label>
                                        <select name="wards" style="width: 50%" id="wards"
                                            class="form-control country_to_state country_select wards">

                                            <option value="">---Select wards---</option>

                                        </select>
                                    </p>

                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Address </label>
                                        <input type="text" placeholder="" style="width: 50%" id="billing_address_1"
                                            name="address" required class="input-text form-control">
                                    </p>

                                </div>
                            </div>

                            <div class="form-row place-order col-8">
                                <input type="submit" data-value="Place order" value="Place order" id="place_order"
                                    name="woocommerce_checkout_place_order" class="button alt">
                            </div>

                        </form>
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

<script type="text/javascript">
$(document).ready(function() {
    $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = "";
        if (action == 'provinces') {
            result = 'districts';
        } else {
            result = 'wards';
        }
        $.ajax({
            url: "{{route('select-delivery')}}",
            method: 'POST',
            data: {
                action: action,
                id: id,
                _token: _token
            },
            success: function(data) {
                $('#' + result).html(data);
            },
        });
    })
});
</script>