@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-bookmark"></i>
                            <h3>UPDATE BRAND</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateBrand', $brand->id) }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Brand name <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input class="span3" name="name" value="{!! old('name') !!}" type="text" />
                                            @else 
                                                <input type="text" class="span3" name="name" value="{{ $brand->name }}">
                                            @endif
                                            @error ('name')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror 
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Link <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input class="span3" name="link" value="{!! old('link') !!}" type="text"/>
                                            @else 
                                                <input type="text" class="span3" name="link" value="{{ $brand->link }}">
                                            @endif  
                                            @error ('link')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror 
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Sort order <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input class="span3" name="sortOrder" value="{!! old('sortOrder') !!}" type="text" />
                                            @else 
                                                <input type="text" class="span3" name="sortOrder" value="{{ $brand->sort_order }}">
                                            @endif
                                            @error ('sortOrder')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror  
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Active</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="acTive">
                                                @if ($errors->any())
                                                    @if (old('acTive') == 1)
                                                        <option value="0">No</option>
                                                        <option value="1" selected>Yes</option>
                                                    @elseif (old('acTive') == 0)
                                                        <option value="0" selected>No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                @elseif ($brand->active == 0)
                                                    <option value="0" selected>No</option>
                                                    <option value="1">Yes</option>
                                                @else
                                                    <option value="0">No</option>
                                                    <option value="1" selected>Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Image</label>
                                        <div class="controls">
                                            <input type="hidden" name="imageOld" value="{{ $brand->image_url }}">
                                            <input value="" class="span3" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <img width="60px" height="60px" src="../images/{{ $brand->image_url }}" alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('showBrand') }}" class="btn btn-danger">Cancel</a>
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