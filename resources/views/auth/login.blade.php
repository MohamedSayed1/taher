<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.Adnan Eltaher') }} | {{ trans('messages.Login') }}</title>
    <link href="{{ url('front_them/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/all.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/style_' . App::getLocale() . '.css') }}">
</head>

<style>
        .btn{
            transition:0.4s all ease;
        }

        .btn:hover{
            transform: scale(1.05)
        }
</style>
<body>
    <section class="container-fluid login-container">
        <div class="row justify-content-center">
            <!-- <div class="col-lg-1 col-md-0 col-sm-0"></div> -->
            <div class="col-lg-4 col-md-5 col-sm-12 login-form-wrapper">
                <!-- <div class="row top-nav-row">
                    <a href="{{ route('home') }}" class="back-link">
                        <i class="fa-sharp fa-solid fa-angle-right"></i>
                        <span>{{ trans('messages.Back to home') }}</span>
                    </a>
                </div>
                <div class="row logo mt-2 mb-5">
                    <img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="logo image">
                </div>
                <div class="row head">
                    <h1>{{ trans('messages.Login') }}</h1>
                </div> -->
                <div class="row form-wrapper mt-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="control-wrapper mb-3">
                            <!-- <label for="login-email" class="form-label">{{ trans('messages.Email') }}</label> -->
                            <input type="email" placeholder="{{ trans('messages.Email') }}" class="form-control" name="email" id="login-email" required
                                autocomplete="email" autofocus>
                            @error('email')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="control-wrapper mb-3">
                            <!-- <label for="login-password" class="form-label">{{ trans('messages.Password') }}</label> -->
                            <div class="input-wrapper">
                                <input name="password" type="password" class="form-control" aria-describedby="icon"
                                    id="login-password" required autocomplete="current-password" placeholder="{{ trans('messages.Password') }}">
                                <button class="btn" type="button" id="login-password-btn">
                                    <i class="fa-regular fa-eye" id="login-eye-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row-wrapper mb-3">
                            <div class="form-check">
                                <label class="container">
                                    <span class="text">{{ trans('messages.Remember Me') }}</span>
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="forget-link-wrapper">
                                @if (Route::has('password.request'))
                                    <a
                                        href="{{ route('password.request') }}">{{ trans('messages.Forget password?') }}</a>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-block mt-4" type="submit">{{ trans('messages.Login') }}</button>
                    </form>
                </div>
                <div class="row redirection-row mt-3" style="font-weight:900;">
                    <span style="font-size:1.2rem">{{ trans('messages.Dont have an account?') }}</span>
                    <a href="{{ route('register') }}">{{ trans('messages.Create new account') }}</a>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ url('front_them/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/index.js') }}"></script>
</body>

</html>
