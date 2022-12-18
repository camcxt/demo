@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget">

                        <div class="widget-header">
                            <i class="icon-inbox"></i>
                            <h3>UPDATE PRODUCT</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateProducts', $product->id) }}" enctype="multipart/form-data"
                                method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Category <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="category">
                                                @foreach ($categories as $categoryList)
                                                @if ($errors->any())
                                                @if (old('category') == $categoryList->id)
                                                <option value="{!! old('category') !!}" selected>
                                                    {{ $categoryList->name }}
                                                </option>
                                                @else
                                                <option value="{{ $categoryList->id }}">{{ $categoryList->name }}
                                                </option>
                                                @endif
                                                @elseif ($categoryList->id == $category->id)
                                                <option value="{{ $categoryList->id }}" selected>
                                                    {{ $categoryList->name }}
                                                </option>
                                                @else
                                                <option value="{{ $categoryList->id }}">{{ $categoryList->name }}
                                                </option>
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
                                                @foreach ($brands as $brandList)
                                                @if ($errors->any())
                                                @if (old('brand') == $brandList->id)
                                                <option value="{!! old('brand') !!}" selected>{{ $brandList->name }}
                                                </option>
                                                @else
                                                <option value="{{ $brandList->id }}">{{ $brandList->name }}</option>
                                                @endif
                                                @elseif ($brandList->id == $brand->id)
                                                <option value="{{ $brandList->id }}" selected>{{ $brandList->name }}
                                                </option>
                                                @else
                                                <option value="{{ $brandList->id }}">{{ $brandList->name }}</option>
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
                                            @if ($errors->any())
                                            <input type="text" class="span3" name="name" value="{!! old('name') !!}">
                                            @else
                                            <input type="text" class="span3" name="name" value="{{ $product->name }}">
                                            @endif

                                            @error ('name')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Price <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="span3" name="price" value="{!! old('price') !!}"
                                                type="text" />
                                            @else
                                            <input class="span3" name="price" value="{{ $product->price }}"
                                                type="text" />
                                            @endif
                                            @error ('price')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Price old</label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="span3" name="oldPrice" value="{!! old('oldPrice') !!}"
                                                type="text" />
                                            @else
                                            <input class="span3" name="oldPrice" value="{{ $product->old_price }}"
                                                type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Tags</label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="span3" name="tags" value="{!! old('tags') !!}" type="text" />
                                            @else
                                            <input class="span3" name="tags" value="{{ $product->tags }}" type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Best sell</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="bestSell">
                                                @if ($errors->any())
                                                @if (old('bestSell') == 1)
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                                @elseif (old('bestSell') == 0)
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                                @endif
                                                @elseif ($product->is_best_sell == 0)
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
                                        <label class="control-label">New</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="isNew">
                                                @if ($errors->any())
                                                @if (old('isNew') == 1)
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                                @elseif (old('isNew') == 0)
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                                @endif
                                                @elseif ($product->is_new == 0)
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
                                        <label class="control-label">Sort order <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="span3" name="sortOrder" value="{!! old('sortOrder') !!}"
                                                type="text" />
                                            @else
                                            <input type="text" class="span3" name="sortOrder"
                                                value="{{ $product->sort_order }}">
                                            @endif
                                            @error ('sortOrder')
                                            <br>
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Amount </label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="span3" name="amount" value="{!! old('amount') !!}"
                                                type="number" />
                                            @else
                                            <input class="span3" name="amount" value="{{ $product->amount }}"
                                                type="number" />
                                            @endif
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
                                                @elseif (old('active') == 0)
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                                @endif
                                                @elseif ($product->active == 0)
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
                                            <input type="hidden" name="imageOld" value="{{ $product->image }}">
                                            <input value="" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <img width="60px" height="60px" src="../images/{{ $product->image }}"
                                                alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Description <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <textarea id="textareaDescription" name="description" style="height: 150px;"
                                                class="span10 first">{!! old('description') !!}</textarea>
                                            @else
                                            <textarea id="textareaDescription" name="description" style="height: 150px;"
                                                class="span10 first">{{ $product->description }}</textarea>
                                            @endif
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
    </div> <!-- than -->
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