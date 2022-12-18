<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Bootstrap Admin Template</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="/phone/resources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/phone/resources/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

    <link href="/phone/resources/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

    <link href="/phone/resources/css/style.css" rel="stylesheet" type="text/css">
    <link href="/phone/resources/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="navbar navbar-fixed-top">

        <div class="navbar-inner">

            <div class="container">

                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <a class="brand" href="{{ route('trangchu') }}">
                    Bootstrap Admin Template
                </a>

                <div class="nav-collapse">
                    <ul class="nav pull-right">

                        <li class="">
                            <a href="{{ route('register') }}" class="">
                                Don't have an account?
                            </a>

                        </li>

                        <li class="">
                            <a href="{{ route('trangchu') }}" class="">
                                <i class="icon-chevron-left"></i>
                                Back to Homepage
                            </a>

                        </li>
                    </ul>

                </div>
                <!--/.nav-collapse -->

            </div> <!-- /container -->

        </div> <!-- /navbar-inner -->

    </div> <!-- /navbar -->


    <div class="container" style="margin-left: 40%; margin-top: 10%;">

        <div class="content clearfix">

            <div class="card-body">

                <form action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <table>
                        <tr>
                            <td>
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            </td>
                        </tr>
                        @if ($errors->has('email'))
                        <tr>
                            <td>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td>
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password" class="form-control" name="password" required autofocus>
                            </td>
                        </tr>
                        @if ($errors->has('password'))

                        <tr>
                            <td>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td>
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                            </td>
                        </tr>
                        @if ($errors->has('password_confirmation'))

                        <tr>
                            <td>
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td>
                                <button type="submit" style="width: 100%;" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>

            </div> <!-- /content -->

        </div> <!-- /account-container -->



        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/signin.js"></script>

</body>

</html>