@include ('admin.index')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">

                <!-- /span6 -->
                <div class="span6">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-bookmark"></i>
                            <h3>SHORTCUT</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="shortcuts"> <a href="{{ route('showCate') }}" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label"> Categories
                                    </span> </a><a href="{{ route('showBrand') }}" class="shortcut"><i class="shortcut-icon icon-bookmark"></i><span class="shortcut-label">Brands</span>
                                </a><a href="{{ route('indexProduct') }}" class="shortcut"><i class="shortcut-icon icon-inbox"></i> <span class="shortcut-label">Products
                                    </span> </a><a href="{{ route('indexBanners') }}" class="shortcut"> <i class="shortcut-icon icon-align-justify"></i><span class="shortcut-label">Banners
                                    </span> </a><a href="{{ route('indexUser') }}" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Accounts
                                    </span> </a><a href="{{ route('indexReport') }}" class="shortcut"><i class="shortcut-icon icon-bullhorn"></i><span class="shortcut-label">Report</span>
                                </a><a href="{{ route('indexOrder') }}" class="shortcut"><i class="shortcut-icon icon-shopping-cart"></i>
                                    <span class="shortcut-label">Orders</span> </div>
                            <!-- /widget-content -->
                        </div><!-- /widget -->
                    </div>
                    <!-- /span12 -->
                    <div class="widget-content">
                        <h3>BEST SELL</h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">No</th>
                                    <th style="width: 50%; text-align: center;">Product Name</th>
                                    <th style="width: 25%; text-align: center;">Image</th>
                                    <th style="width: 20%; text-align: center;">Total Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orderList)
                                <tr>
                                    <td style="text-align: center;">{{ $key + 1 }}</td>
                                    <td style="text-align: center;"><a href="{{ route('showImage', $orderList->product_id) }}">{{ $orderList->product_name }}</a></td>
                                    <td style="text-align: center;"><img src="/phone/public/images/{{ $orderList->product_image }}" height="50px" width="200px" alt="Khong tai duoc"></td>
                                    <td style="text-align: center;">{{ $orderList->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="span6">

                    <div class="widget">
                        <div class="widget-content">
                            <h3>TOP ORDER</h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;"> Number </th>
                                        <th style="width: 50%; text-align: left;"> Customer </th>
                                        <th style="width: 15%; text-align: center;"> Total </th>
                                        <th style="width: 30%; text-align: center;"> Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderData as $key => $orderListTop)
                                    <tr>
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td style="text-align: left;"><a href="{{ route('showbyId', $orderListTop->id) }}">{{ $orderListTop->customer_name }}</a></td>
                                        <td style="text-align: right;">${{ number_format($orderListTop->total_money) }}</td>
                                        <td style="text-align: center;">{{ $orderListTop->created_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="widget-content">
                        <h3> Review</h3>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <ul class="messages_layout">
                                @foreach ($comment as $commentList)
                                <li class="from_user left">
                                    <a href="#" class="avatar"><img style="width: 30%;" src="/phone/public/images/anhdaidien.jfif" /></a>
                                    <div class="message_wrap">
                                        <div class="info"> <a class="name">{{ $commentList->user_name }}</a> <span class="time">about: </span> &nbsp; <span><a href="{{ route('showProduct', $commentList->product_id) }}" target="_blank"><b>{{ $commentList->product_name }}</b></a></span>
                                            <div class="options_arrow">
                                                <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                                                    <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                                                        <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                                                        <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                                                        <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text">{{ $commentList->comments }} </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /widget-content -->
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /main-inner -->
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

<script>
    var doughnutData = [{
            value: 30,
            color: "#F7464A"
        },
        {
            value: 50,
            color: "#46BFBD"
        },
        {
            value: 100,
            color: "#FDB45C"
        },
        {
            value: 40,
            color: "#949FB1"
        },
        {
            value: 120,
            color: "#4D5360"
        }

    ];

    var myDoughnut = new Chart(document.getElementById("donut-chart").getContext("2d")).Doughnut(doughnutData);
</script>