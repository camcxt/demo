<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ADMIN SHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="/phone/resources/css/error.css">
    <link href="/phone/resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="/phone/resources/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="/phone/resources/css/font-awesome.css" rel="stylesheet">
    <link href="/phone/resources/css/style.css" rel="stylesheet">
    <link href="/phone/resources/css/pages/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css"
        integrity="sha512-mNBK16eobgxYTbRSQhlXA6hEVqfO+o31KEctFCjcn1FytkihWQGCAB4ktjdt/NiGE6q6b09aosY0det7YQa8AA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css"
        integrity="sha512-IJ+BZHGlT4K43sqBGUzJ90pcxfkREDVZPZxeexRigVL8rzdw/gyJIflDahMdNzBww4k0WxpyaWpC2PLQUWmMUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome-ie7.css"
        integrity="sha512-Gyaty1w59WIaT5TGSbAHuVHOoayE3p1R9rWHMDY/RFLRBTsB07rdrKsy4lB5kyajKXsbbuEj3FAoNKiyrm5E0Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/font/FontAwesome.otf">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.10/tinymce.min.js"
        integrity="sha512-eIicayy0VlJMMkg0C3ELbcJOLRIB7qYOaGDZqZp8kmCTCg+hP10IBLtl6sF/coI96f1ZlKhuy+DluqkbuqtPtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    tinyMCE.init({
        selector: "#textareaDescription",
        mode: "textareas",
        force_br_newlines: true,
        force_p_newlines: false,
        forced_root_block: ''
    });
    </script>

</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a
                    class="brand" href="{{route('homeAdmin')}}">SHOP TECHNOLOGY </a>
                <div class="nav-collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="icon-cog"></i> ADMIN <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li> <a href="{{ route('forget.password.get') }}">
                                        {{ __('Resset Password') }}
                                    </a>
                                </li>

                                <li>
                                <li> <i class="fa-solid fa-arrow-right-from-bracket"></i><a class="dropdown-item"
                                        href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>

                    </ul>
                    </li>
                    <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> EGrappler.com <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="javascript:;">Profile</a></li>
                <li><a href="javascript:;">Logout</a></li>
              </ul>
            </li> -->
                    </ul>

                </div>
                <!--/.nav-collapse -->
            </div>
            <!-- /container -->
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    @if (Request::route()->getName() == "homeAdmin")
                    <li class="active"><a href="{{ route('homeAdmin') }}"><i
                                class="fa fa-house-user"></i><span>HOME</span></a></li>
                    @else
                    <li><a href="{{ route('homeAdmin') }}"><i class="fa fa-house-user"></i><span>HOME</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "showCate" || Request::route()->getName() == "editCate" ||
                    Request::route()->getName() == "addCate")
                    <li class="active"><a href="{{ route('showCate') }}"><i
                                class="icon-list-alt"></i><span>CATEGORIES</span></a></li>
                    @else
                    <li><a href="{{ route('showCate') }}"><i class="icon-list-alt"></i><span>CATEGORIES</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "showBrand" || Request::route()->getName() == "createBrand" ||
                    Request::route()->getName() == "editBrand")
                    <li class="active"><a href="{{ route('showBrand') }}"><i
                                class="icon-bookmark"></i><span>BRANDS</span> </a> </li>
                    @else
                    <li><a href="{{ route('showBrand') }}"><i class="icon-bookmark"></i><span>BRANDS</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "indexProduct" || Request::route()->getName() == "editProducts"
                    || Request::route()->getName() == "createProduct")
                    <li class="active"><a href="{{ route('indexProduct') }}"><i
                                class="icon-inbox"></i><span>PRODUCTS</span></a></li>
                    @else
                    <li><a href="{{ route('indexProduct') }}"><i class="icon-inbox"></i><span>PRODUCTS</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "indexBanners" || Request::route()->getName() == "editBanners"
                    || Request::route()->getName() == "createBanners")
                    <li class="active"><a href="{{ route('indexBanners') }}"><i
                                class="icon-align-justify"></i><span>BANNERS</span></a></li>
                    @else
                    <li><a href="{{ route('indexBanners') }}"><i class="icon-align-justify"></i><span>BANNERS</span></a>
                    </li>
                    @endif

                    @if (Request::route()->getName() == "indexUser")
                    <li class="active"><a href="{{ route('indexUser') }}"><i
                                class="fa fa-user"></i><span>ACCOUNTS</span></a></li>
                    @else
                    <li><a href="{{ route('indexUser') }}"><i class="fa fa-user"></i><span>ACCOUNTS</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "indexReport")
                    <li class="active"><a href="{{ route('indexReport') }}"><i
                                class="icon-bullhorn"></i><span>REPORT</span></a></li>
                    @else
                    <li><a href="{{ route('indexReport') }}"><i class="icon-bullhorn"></i><span>REPORT</span></a></li>
                    @endif

                    @if (Request::route()->getName() == "indexOrder")
                    <li class="active"><a href="{{  route('indexOrder') }}"><i
                                class="icon-shopping-cart"></i><span>ORDERS</span></a></li>
                    @else
                    <li><a href="{{  route('indexOrder') }}"><i class="icon-shopping-cart"></i><span>ORDERS</span></a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /subnavbar-inner -->
    </div>
    <!-- /subnavbar -->

    <!-- /main -->

    <!-- Le javascript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/phone/resources/css/js/jquery-1.7.2.min.js"></script>
    <script src="/phone/resources/css/js/excanvas.min.js"></script>
    <script src="/phone/resources/css/js/chart.min.js" type="text/javascript"></script>
    <script src="/phone/resources/css/js/bootstrap.js"></script>


    <script type="text/javascript" src="/phone/resources/js/activeAll.js"></script>


    <script language="javascript" type="text/javascript" src="../resources/css/js/full-calendar/fullcalendar.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</body>

</html>