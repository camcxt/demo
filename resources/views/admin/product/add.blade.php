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
                            <i class="icon-inbox"></i>
                            <h3>ADD PRODUCT</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeProduct') }}" method="post" id="edit-profile"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Category <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="category">
                                                <option value="">------</option>
                                                @foreach ($categories as $category)
                                                @if ($errors->any())
                                                @if (old('category') == $category->id)
                                                <option selected value="{!! old('category') !!}">{{ $category->name }}
                                                </option>
                                                @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                                @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error ('category')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Brand <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="brand">
                                                <option value="">------</option>
                                                @foreach ($brands as $brand)
                                                @if ($errors->any())
                                                @if (old('brand') == $brand->id)
                                                <option selected value="{!! old('brand') !!}">{{ $brand->name }}
                                                </option>
                                                @else
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endif
                                                @else
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error ('brand')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Product name <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="name" value="{!! old('name') !!}">
                                            @error ('name')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Price <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input class="span3" name="price" type="text"
                                                value="{!! old('price') !!}" />
                                            @error ('price')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Price old</label>
                                        <div class="controls">
                                            <input class="span3" name="oldPrice" type="text"
                                                value="{!! old('oldPrice') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Tags</label>
                                        <div class="controls">
                                            <input class="span3" name="tags" type="text" value="{!! old('tags') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Best sell</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="bestSell">
                                                @if (old('bestSell') == 1)
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                                @else
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">New</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="isNew">
                                                @if (old('isNew') == 1)
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                                @else
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Sort order <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="sortOrder"
                                                value="{!! old('sortOrder') !!}">
                                            @error ('sortOrder')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Amount </label>
                                        <div class="controls">
                                            <input type="number" class="span3" name="amount"
                                                value="{!! old('amount') !!}">
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
                                                @else
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label ">Image</label>
                                        <div class="controls">
                                            <input class="span2" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Description <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <textarea id="textareaDescription" name="description" style="height: 150px;"
                                                class="span10 first">{!! old('description') !!}</textarea>
                                            @error ('description')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->



                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('indexProduct') }}" class="btn btn-danger">Cancel</a>
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
                    <h4> About Free Admin Template</h4>
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