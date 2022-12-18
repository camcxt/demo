@include ('admin.index')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .center {
        margin: auto;
        width: 50%;
        text-align: center;
        padding: 10px;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        float: left;
        padding: 4px 12px;
        line-height: 1.428571429;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        border-left-width: 0;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        border-left-width: 1px;
    }

    .pagination>li>a:hover,
    .pagination>li>a:focus,
    .pagination>.active>a,
    .pagination>.active>span {
        background-color: #f5f5f5;
    }

    .pagination>.active>a,
    .pagination>.active>span {
        color: #999999;
        cursor: default;
    }

    .pagination>.disabled>span,
    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        color: #999999;
        cursor: not-allowed;
        background-color: #ffffff;
    }

    .pagination-large>li>a,
    .pagination-large>li>span {
        padding: 14px 16px;
        font-size: 18px;
    }

    .pagination-small>li>a,
    .pagination-small>li>span {
        padding: 5px 10px;
        font-size: 12px;
    }

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

<div class="container">
    <div class="row">
        <div class="span12">

            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item" style="width: 95%;"><i class="icon-inbox"></i> PRODUCTS &emsp; &emsp;</li>
                    <li class="breadcrumb-item"> <a href="{{ route('createProduct') }}" class="btn btn-primary"> <i class="icon-plus"></i> </a> </li>
                </ol>
            </div>

            <div>
                @if (session()->has('messageAdd'))
                <div class="alert alert-success">
                    {{ session('messageAdd') }}
                </div>
                @endif

                @if (session()->has('messageUpdate'))
                <div class="alert alert-success">
                    {{ session('messageUpdate') }}
                </div>
                @endif

                @if (session()->has('messageDelete'))
                <div class="alert alert-success">
                    {{ session('messageDelete') }}
                </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">

                        <form action=" {{ route('indexProduct') }} " method="get">
                            <div class="search"> &emsp;

                                <div class="search-element">

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Product's name</label>
                                        <input id='searchInput' style="width: 57%;" class="form-control" name="searchInput" type='text' placeholder="Product's name" value="{{ $name }}" />
                                    </div>

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Brand</label>
                                        <select name="brand" style="height: 28px;" class="form-control detail-right">
                                            <option value="">-----</option>
                                            @foreach ($brands as $brand)
                                            @if ($productBrand == $brand->id)
                                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                            @else
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Category</label>
                                        <select class="detail-right" style="height: 28px;" name="category">
                                            <option value="">-----</option>
                                            @foreach ($categories as $category)
                                            @if ($productCategory == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="search-element">

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Is New</label>
                                        <select class="detail-right" style="height: 28px;" name="isNew">
                                            @if ($productNew == 1)
                                            <option value="">-----</option>
                                            <option value="0">No</option>
                                            <option value="1" selected>Yes</option>
                                            @elseif ($productNew == 0)
                                            <option value="">-----</option>
                                            <option value="0" selected>No</option>
                                            <option value="1">Yes</option>
                                            @elseif (!empty($productNew))
                                            <option value="">-----</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Best Sell</label>
                                        <select class="detail-right" style="height: 28px;" name="bestSell">
                                            @if ($productBestSell == 1)
                                            <option value="">-----</option>
                                            <option value="0">No</option>
                                            <option value="1" selected>Yes</option>
                                            @elseif ($productBestSell == 0)
                                            <option value="">-----</option>
                                            <option value="0" selected>No</option>
                                            <option value="1">Yes</option>
                                            @elseif (!empty($productBestSell))
                                            <option value="">-----</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="control-group" style="width: 30%; height: 90%;">
                                        <button class="btn btn-secondary" name="btnSearch" value="btnSearch" style="color: black ;border-radius: 20px; height: 90%;"><i class="icon-search"></i></button> &emsp;
                                        <a href="{{ route('indexProduct') }}" class="btn btn-secondary" style="color: black ;border-radius: 20px; height: 70%;"><i class="icon-retweet"></i></a>
                                    </div>

                                </div>

                            </div>
                        </form>

                        <table style="width:100%" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th style="width:2%; text-align: center;">No</th>
                                    <th style="width:10%; text-align: center;">Image</th>
                                    <th style="width:20%; text-align: center;">Product's Name</th>
                                    <th style="width:12%; text-align: center;">Brand</th>
                                    <th style="width:15%; text-align: center;">Category</th>
                                    <th style="width:5%; text-align: center;">Price</th>
                                    <th style="width:7%; text-align: center;">Old Price</th>
                                    <th style="width:7%; text-align: center;">Best sell</th>
                                    <th style="width:5%; text-align: center;">New</th>
                                    <th style="width:2%; text-align: center;">Active</th>
                                    <th style="width:18%; text-align: center;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $productKey => $product)
                                <tr>
                                    <td style="text-align: center;"> {{ $productKey + 1 }} </td>
                                    <td style="text-align: center;"><img src="/phone/public/images/{{ $product->image }}" width="100px" alt="No Image"></td>
                                    <td style="text-align: center;">{{ $product->name }}</td>
                                    @foreach ($brands as $brand)
                                    @if ($brand->id == $product->brand_id)
                                    <td style="text-align: center;">{{ $brand->name }}</td>
                                    @endif
                                    @endforeach
                                    @foreach ($categories as $category)
                                    @if( $category->id == $product->category_id )
                                    <td style="text-align: center;">{{ $category->name }}</td>
                                    @endif
                                    @endforeach
                                    <td style="text-align: right;">${{ number_format($product->price) }}</td>
                                    @if ($product->old_price != 0)
                                    <td style="text-align: right;">${{ number_format($product->old_price) }}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    @if ($product->is_best_sell == 1)
                                    <td style="text-align: center;"><img src="/phone/public/images/ok-16.png" alt=""></td>
                                    @else
                                    <td></td>
                                    @endif
                                    @if ($product->is_new == 1)
                                    <td style="text-align: center;"><img src="/phone/public/images/ok-16.png" alt=""></td>
                                    @else
                                    <td></td>
                                    @endif
                                    <input type="hidden" value="{{ $product->id }}" class="id" id="idp">
                                    <td style="text-align: center;"><input type="checkbox" class="toggle-position mini" value="{{ $product->id }}" data-url="/phone/public/active" data-id="{{ $product->id }}" data-on="Yes" data-off="No" data-size="mini" data-toggle="toggle" data-width="15" data-height="10" {{ $product->active == 1 ? 'checked' : '' }}></td>
                                    <td style="text-align: center;">
                                        <input value="{{ $product->id }}" type="hidden" name="id">
                                        <a class="btn btn-success" href="{{ route('editProducts', $product->id)  }}"><i class="icon-edit"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" href="{{ route('destroyProducts', $product->id) }}"> <i class="icon-trash"></i></a>
                                        <a class="btn btn-info" href="{{ route('showImage', $product->id) }}"><i class="icon-eye-open"></i></a>
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
    <div class="row">
        <div class="span12">
            <div class="center">
                <div class="pagination">
                    @if (!isset($_GET['btnSearch']))
                        {!! $products->links() !!}
                    @endif
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
                    <h4>About Free Admin Template</h4>
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

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.toggle-position').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{csrf_token()}}';
            $.ajax({
                url: "{{route('active')}}",
                method: 'GET',
                data: {
                    status: status,
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        });
    });
</script> -->