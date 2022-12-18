@include ('admin.index')

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
        justify-content: space-around;
        height: 28px;
    }

    .input-search {
        border-radius: 20px;
        border: solid 1px #cccccc;
        width: 20%;
    }

    .search {
        display: flex;

        align-content: space-between;
    }
</style>

<div class="main">
    <div class="container-fluid">
        <div class="card mb-4">

            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"  style="width: 95%;"><i class="fas fa-user"></i> ACCOUNTS &emsp; &emsp;</li>
                    <li class="breadcrumb-item"> <a href="{{ route('createUser') }}" class="btn btn-primary"><i class="icon-plus"></i> </a> </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">

                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:45%">User's Name</th>
                                    <th style="width:30%;">Email</th>
                                    <th style="width:15%; text-align: center;">Phone</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $userData)
                                    @if ($userData->id != Auth::user()->id)
                                        <tr>
                                            <td>{{ $userData->username }}</td>
                                            <td>{{ $userData->email }}</td>
                                            <td style="text-align: center;">{{ $userData->phone }}</td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-success" href="{{ route('editUser', $userData->id)  }}"><i class="icon-edit"></i></a>
                                                @if (Auth::user()->permission == 0)
                                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff ?');" href="{{ route('destroyUser', $userData->id) }}"> <i class="icon-trash"></i></a>
                                                @endif
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

<div class="row">
    <div class="span12">
        <div class="center">
            <div class="pagination">
                 <li>{!! $users->links() !!}</li>
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