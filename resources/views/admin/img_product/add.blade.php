@include ('admin.index')
<link rel="stylesheet" href="/phone/resources/css/css/owl.carousel.css">
<link rel="stylesheet" href="/phone/resources/css/style.css">
<link rel="stylesheet" href="/phone/resources/css/css/responsive.css">
<link rel="stylesheet" href="/phone/resources/css/css/bootstrap.min.css">
<div class="main">

    <div class="col-md-10">
        <div class="product-content-right">


            <div class="row">
                <div class="col-sm-6">
                    <div class="product-images">
                        <div class="product-main-img">
                            <img src="../images/{{$products->image}}" width="400px" height="600px" alt="k tải được">
                        </div>




                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="product-inner">
                        <h2 class="product-name">{{$products->name}}</h2>


                        <div role="tabpanel">

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <h2>Product Description</h2>
                                    <p>{{$products->description}}</p>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="product-gallery">

                        @foreach($image as $i)
                        <img src="../images/{{$i->image_url}}" width="200px" height="200px" alt="k tải đc">
                        @endforeach
                    </div>
                </div>


            </div>


        </div>
    </div>



    <!-- hết  -->
    <div class="main-inner">

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="widget ">





                        <form action="{{route('storeImage')}}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <fieldset>



                                <div class="control-group">
                                    <label class="control-label" for="firstname"></label>
                                    <div class="controls">
                                        <input type="hidden" class="span6" name="product_id" id="firstname" value="{{$products->id}}">
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="firstname">Image</label>
                                    <div class="controls">
                                        <input class="span2" id="hinhanh" name="image_url" type="file" />

                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->



                                <div class="control-group">
                                    <label class="control-label" for="lastname">Order Sort</label>
                                    <div class="controls">
                                        <input type="text" class="span6" id="lastname" name="sort_order" value="">
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                @if($errors -> any())
                                <div class="alert alert-primary text-center">
                                    @foreach ($errors->all() as $errors)
                                    <p>{{$errors}}</p>
                                    @endforeach
                                </div>
                                @endif
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button class="btn">Cancel</button>
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
                        <li><a href="javascript:;">EGrappler.com</a></li>
                        <li><a href="javascript:;">Web Development Resources</a></li>
                        <li><a href="javascript:;">Responsive HTML5 Portfolio Templates</a></li>
                        <li><a href="javascript:;">Free Resources and Scripts</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Support</h4>
                    <ul>
                        <li><a href="javascript:;">Frequently Asked Questions</a></li>
                        <li><a href="javascript:;">Ask a Question</a></li>
                        <li><a href="javascript:;">Video Tutorial</a></li>
                        <li><a href="javascript:;">Feedback</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Something Legal</h4>
                    <ul>
                        <li><a href="javascript:;">Read License</a></li>
                        <li><a href="javascript:;">Terms of Use</a></li>
                        <li><a href="javascript:;">Privacy Policy</a></li>
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