@include ('admin.index')

<div class="main">
    <div class="container-fluid">
        <div class="card mb-4">

            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item" style="width: 95%;"><i class="icon-list-alt"></i> CATEGORYS &emsp; &emsp;</li>
                    <li class="breadcrumb-item"> <a href="{{ route('addCate') }}" class="btn btn-primary"> <i class="icon-plus"></i> </a> </li>
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

                @if (session()->has('messageError'))
                <div class="alert alert-danger">
                    {{ session('messageError') }}
                </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%; text-align: center;">No</th>
                                    <th style="width:62%; text-align: left;">Category's name</th>
                                    <th style="width:8%; text-align: center;">Sort order</th>
                                    <th style="width:10%; text-align: center;">Active</th>
                                    <th style="width:15%; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryList as $categoryKey => $category)
                                <tr>
                                    <td style="text-align: center;">{{ $categoryKey + 1 }}</td>
                                    <td style="text-align: left;">{{ $category->name }}</td>
                                    <td style="text-align: center;">{{ $category->sort_order }} </td>
                                    <td style="text-align: center;"><input type="checkbox" class="toggle-position" value="{{ $category->id }}" data-url="/phone/public/activeCategory" data-id="{{ $category->id }}" data-size="mini" data-on="Yes" data-off="No" {{ $category->active == 1 ? 'checked' : '' }} data-toggle="toggle" data-width="20" data-height="10"> </td>
                                    <td style="text-align: center;">
                                        <input value="{{ $category->id }}" type="hidden" name="id" id="rowId">
                                        <a class="btn btn-success" href="{{ route('editCate', $category->id) }}"> <i class="icon-edit"></i></a> &emsp;
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" href="{{ route('destroyCate', $category->id) }}"> <i class="icon-trash"></i></a>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.toggle-position').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('activeCategory') }}",
                method: 'POST',
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