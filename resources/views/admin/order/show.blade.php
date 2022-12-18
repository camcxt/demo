@include ('admin.index')

<style>
.search-element {
    display: flex;
    justify-content: flex-start;
    width: 100%;
}

.search {
    display: flex;
    flex-direction: column;
    align-content: space-between;
    height: 15%;
    width: 100%;
    margin-left: 6%;
}

.detail {
    display: flex;
    align-items: center;
}

th {
    text-align: center;
}

.detail-left {
    width: 30%;
}

.detail-right {
    width: 60%;
}
</style>

<div class="main">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    <div class="card-header">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item" style="width: 90%;"><i class="icon-shopping-cart"></i> ORDERS
                                &emsp; &emsp;</li>
                            <li>
                                &emsp14;
                                <div>
                                    <form action="{{route('exportOrder')}}" method="get">
                                        <input type="hidden" name="name" value="{{$dataSearch['name']}}">
                                        <input type="hidden" name="phone" value="{{$dataSearch['phone']}}">
                                        <input type="hidden" name="email" value="{{$dataSearch['email']}}">
                                        <input type="hidden" name="status" value="{{$dataSearch['status']}}">
                                        <button type="submit" class="btn btn-primary">Export</button>
                                    </form>
                                </div>
                            </li>
                        </ol>
                    </div>

                    <div class="widget-content">

                        <form action=" {{ route('indexOrder') }} " method="get">
                            <div class="search"> &emsp;

                                <div class="search-element">

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Customer's name</label>
                                        <input id='searchInput' style="width: 57%;" class="form-control"
                                            name="inputName" type='text' placeholder="Customer's name" />
                                    </div>

                                    <div class="control-group detail" style="width: 25%;">
                                        <label class="form-control detail-left">Phone</label>
                                        <input style="width: 57%;" class="form-control" name="inputPhone" type='text'
                                            placeholder='Phone' />
                                    </div>

                                    <div class="control-group detail" style="width: 25%;">
                                        <label class="form-control detail-left">Email</label>
                                        <input style="width: 57%;" class="form-control" name="inputEmail" type='text'
                                            placeholder='Email' />
                                    </div>

                                    <div class="control-group" style="width: 10%; height: 90%;">
                                        <button class="btn btn-secondary" name="btnSearch" value="btnSearch"
                                            style="color: black ;border-radius: 20px; height: 90%;"><i
                                                class="icon-search"></i></button> &emsp;
                                        <a href="{{ route('indexOrder') }}" class="btn btn-secondary"
                                            style="color: black ;border-radius: 20px; height: 70%;"><i
                                                class="icon-retweet"></i></a>
                                    </div>

                                </div>

                            </div>
                        </form>

                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%; text-align: center;">No</th>
                                    <th style="width:15%; text-align: left;">Customer's name</th>
                                    <th style="width:10%; text-align: left;">Email</th>
                                    <th style="width:5%; text-align: center;">Phone</th>
                                    <th style="width:10%; text-align: center;">Total</th>
                                    <th style="width:10%; text-align: center;">Date</th>
                                    <th style="width:25%; text-align: center;">Items</th>
                                    <th style="width:10%; text-align: center;">Status</th>
                                    <th style="width:10%; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $orderList)
                                <tr>
                                    <td style="text-align: center;">{{ $key+1 }}</td>
                                    <td style="text-align: left;">{{ $orderList->customer_name }}</td>
                                    <td style="text-align: left;">{{ $orderList->customer_email }}</td>
                                    <td style="text-align: center;">{{ $orderList->customer_phone }}</td>
                                    <td style="text-align: right;">${{ number_format($orderList->total_money) }}</td>
                                    <td style="text-align: center;">{{ $orderList->created_date }}</td>
                                    <td style="text-align: left;">
                                        @foreach ($itemOrder as $items)
                                        @if ($orderList->id == $items->order_id)
                                        <p>- {{ $items->product_name }} (<span>{{ $items->product_quantity }}</span>)
                                        </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    @if($orderList->status == 0)
                                    <td style="text-align: center;">Unpaid</td>
                                    @else
                                    <td style="text-align: center;">Paid</td>
                                    @endif
                                    <td style="text-align: center;">
                                        <a href="{{ route('showbyId', $orderList->id) }}" class="btn btn-primary"><i
                                                class="icon-eye-open"></i></a>
                                        <a class="btn btn-success" href="{{ route('updateOrder', $orderList->id) }}"><i
                                                class="icon-eur"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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