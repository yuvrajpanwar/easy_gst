<div style='background-color:red;text-align:center;'> <br /><br />This license is going to expire on
    <strong>2023-08-30</strong>, Please contact service provider to continue using the software.</div>
<!DOCTYPE HTML>

<head>
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Fruit Market" />
    <meta name="description" content="Fruit Market App- Online Shopping For Fruits and Vegetables." />
    <meta name="keywords" content="Fruit App, Fruit Market" />
    <meta name="generator" content="" />
    <meta name="Resource-Type" content="document" />
    <meta name="Distribution" content="global" />
    <meta name="Robots" content="index, follow" />
    <meta name="Revisit-After" content="21 days" />
    <meta name="Rating" content="general" />


    <title></title>
    <link href="{{asset('public/themes/default/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/themes/default/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('public/themes/default/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300' rel="stylesheet" type="text/css" />

    <style type="text/css">

        .error{
          color: red;
        }
        #alert-success {
          transition-duration: 0.3s; /* Adjust the duration as needed */
          transition-timing-function: ease-in-out; /* Adjust the easing function as needed */ 
        }
        .close-button {
          position: absolute;
          top: 0.5rem;
          right: 0.5rem;
          color: #333;
          text-decoration: none;
        }
    
      </style>

</head>

<body>
    <div id="top"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
        </div>
        <!-- /.container -->
    </nav>

    <!-- Home slider -->

    <section id="home">
        <div class="container" style="height:550px; margin-top:-60px;">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="modal-dialog modal-sm">
                        <img src="{{ asset('public/themes/admin/images/logo.gif')}}" style="width:400px; height:100px;">
                    </div>
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        @foreach ($errors->all() as $error)
                                            <strong style="color: red">{{ $error }}</strong>
                                        @endforeach

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="text-center">

                                                <h2 class="text-center">Please Login </h2>
                                                <hr class="colorgraph">

                                                <div class="form-group">
                                                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
                                                </div>

                                                <hr class="colorgraph">

                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12">
                                                        <input type="submit" name="login" value="Login" class="btn-hd btn-capital btn-block btn-lg" tabindex="4">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="divider"></div>

    <!-- footer -->
    <footer class="footer1">

        <div class="footer-bottom">
            <div class="container">
                <div class="pull-left"> Copyright &copy; <a href="">World IT Dimensional Solutions</a>. All right reserved.</div>
                <div class="pull-left" style="float: right!important;"><a href="http://witds.com/" target="_blank">Developed by World IT Dimensional Solutions.</a></div>
            </div>
        </div>

    </footer>

    <!-- jQuery -->
    <script src="{{asset('public/themes/default//js/jquery.js')}}">
    </script>

    <script src="{{asset('public/themes/default//js/bootstrap.min.js')}}"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('public/themes/default//js/jquery.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('public/themes/default//js/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.carousel').carousel();

        });
    </script>
</body>

</html>















{{-- 
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
