@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-content">

                            <div class="detail">

                                <div class="col-sm-12">

                                    <div class="product-inner">
                                        <h2 class="product-name">{{ $order->customer_name }}</h2>
                                        <div style="display: flex;"><b>Phone:</b> &ensp; <p>{{ $order->customer_phone }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Email:</b> &ensp; <p>{{ $order->customer_email }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Date:</b> &ensp; <p>{{ $order->created_date }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Address:</b> &ensp; <p>{{ $order->address }}</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- hết  -->
                        </div>

                        &emsp;

                        <div class="widget-content">

                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="widget-content">
                                                    <table style="width:100%" class="table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th style="width:5%; text-align: center;">No</th>
                                                                <th style="width:15%; text-align: center;">Image</th>
                                                                <th style="width:38%;">Product name</th>
                                                                <th style="width:12%; text-align: center;">Price</th>
                                                                <th style="width:10%; text-align: center;">Quantity</th>
                                                                <th style="width:10%; text-align: center;">Amount</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($itemOrder as $key => $itemOrderData)
                                                            <tr>
                                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                                <td style="text-align: center;"><img src="../images/{{ $itemOrderData->product_image }}" height="50px" width="150px" alt="Khong tai duoc"></td>
                                                                <td>{{ $itemOrderData->product_name }}</td>
                                                                <td style="text-align: right;">${{ number_format($itemOrderData->product_price) }}</td>
                                                                <td style="text-align: center;">{{ $itemOrderData->product_quantity }}</td>
                                                                <td style="text-align: right;">${{ number_format($itemOrderData->product_price * $itemOrderData->product_quantity) }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>

                                                    </table>

                                                    <div style="margin-left: 80%;">
                                                        <div style="display: flex;"><b>Total product:</b> &ensp; <p>{{ $order->total_products }}</p></div>
                                                        <div style="display: flex;"><b>Total money:</b> &ensp; $<p>{{ number_format($order->total_money) }}</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="extra">
    <div class="extra-inner">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <h4>
                        About Free Admin Template</h4>
                    <ul>
                        <li><a href="javascript:void(0);">EGrappler.com</a></li>
                        <li><a href="javascript:void(0);">Web Development Resources</a></li>
                        <li><a href="javascript:void(0);">Responsive HTML5 Portfolio Templates</a></li>
                        <li><a href="javascript:void(0);">Free Resources and Scripts</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Support</h4>
                    <ul>
                        <li><a href="javascript:void(0);">Frequently Asked Questions</a></li>
                        <li><a href="javascript:void(0);">Ask a Question</a></li>
                        <li><a href="javascript:void(0);">Video Tutorial</a></li>
                        <li><a href="javascript:void(0);">Feedback</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Something Legal</h4>
                    <ul>
                        <li><a href="javascript:void(0);">Read License</a></li>
                        <li><a href="javascript:void(0);">Terms of Use</a></li>
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Open Source jQuery Plugins</h4>
                    <ul>
                        <li><a href="">Open Source jQuery Plugins</a></li>
                        <li><a href="">HTML5 Responsive Tempaltes</a></li>
                        <li><a href="">Free Contact Form Plugin</a></li>
                        <li><a href="">Flat UI PSD</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
                <!-- /span12 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /footer-inner -->
</div>
<!-- /footer -->