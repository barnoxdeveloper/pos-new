<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CMS Barnox Developer</title>
        <meta name="robots" content="noindex,nofollow">
        <meta name="author" content="Andre Elm, andreelm039@gmail.com.com">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('backend/login/login.css') }}">
        <link rel="icon" type="image/png" href="{{ url('backend/login/point-of-sale.png') }}"/>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div class="fadeIn first">
                    <img src="{{ url('backend/login/point-of-sale.png') }}" id="icon" alt="Tunas Mitra" class="w-50 m-3"/>
                </div>
                @if (session('status'))
                    <div class="alert alert-danger alert-dismissible text-center" data-aos="zoom-in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible text-center" data-aos="zoom-in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible text-center mx-1" data-aos="zoom-in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>{{ $errors->first() }}</b>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="text" id="login" class="fadeIn second {{ $errors->has('username') || $errors->has('email') ? 'is-invalid' : '' }} mt-3 mb-3" name="login" placeholder="Your Email / Username" value="{{ old('login') }}" required autocomplete="login" autofocus>
                    <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror mt-3 mb-3" name="password" placeholder="Your Password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="fadeIn fourth btn btn-lg btn-primary m-3">
                        <i class="fa fa-paper-plane"></i> Login
                    </button>
                </form>

                <div id="formFooter">
                    <p class="underlineHover">Copyright &copy; BarnoxDev <script>document.write(new Date().getFullYear());</script></p>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>
