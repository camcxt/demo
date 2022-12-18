@include ('admin.index')

<style>
    input.first {
        min-height: 100px;
    }
</style>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="fas fa-user"></i>
                            <h3>ADD USER</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeUser') }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">User's name <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input type="text" class="span3" name="name" value="{!! old('name') !!}">
                                            @else
                                                @if (isset($staff->username))
                                                    <input type="text" class="span3" name="name" value="{{ $staff->username }}">
                                                @else
                                                    <input type="text" class="span3" name="name" value="{!! old('name') !!}">
                                                @endif
                                            @endif

                                            @error ('name')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Phone <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input type="text" class="span3" name="phone" value="{!! old('phone') !!}">
                                            @else
                                                @if (isset($staff->username))
                                                    <input type="text" class="span3" name="phone" value="{{ $staff->phone }}">
                                                @else
                                                    <input type="text" class="span3" name="phone" value="{!! old('phone') !!}">
                                                @endif
                                            @endif
                                            
                                            @error ('phone')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Email <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input type="text" class="span3" name="email" value="{!! old('email') !!}">
                                            @else
                                                @if (isset($staff->username))
                                                    <input type="text" class="span3" name="email" value="{{ $staff->email }}">
                                                @else
                                                    <input type="text" class="span3" name="email" value="{!! old('email') !!}">
                                                @endif
                                            @endif
                                            
                                            @error ('email')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    @if (Request::route()->getName() == "createUser")
                                    <div class="control-group">
                                        <label class="control-label">Password <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input type="password" class="span3" name="password" value="{!! old('password') !!}">
                                            @else
                                                @if (isset($staff->username))
                                                    <input type="password" class="span3" name="password" value="{{ $staff->password }}">
                                                @else
                                                    <input type="password" class="span3" name="password" value="{!! old('password') !!}">
                                                @endif
                                            @endif
                            
                                            @error ('password')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->
                                    @endif

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('indexUser') }}" class="btn btn-danger">Cancel</a>
                                    </div> <!-- /form-actions -->
                                    
                                </fieldset>
                            </form>
                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->
                </div> <!-- /span8 -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div>
</div>
<!-- het main -->

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
                        <li><a href="javascript:void(0);">Open Source jQuery Plugins</a></li>
                        <li><a href="javascript:void(0);">HTML5 Responsive Tempaltes</a></li>
                        <li><a href="javascript:void(0);">Free Contact Form Plugin</a></li>
                        <li><a href="javascript:void(0);">Flat UI PSD</a></li>
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