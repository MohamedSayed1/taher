<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.Adnan Eltaher') }} | {{ trans('messages.Reset Password') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/style_' . App::getLocale() . '.css') }}">
</head>

<body>
    <section class="container-fluid reset-container">
        <div class="row">
            <div class="col-lg-1 col-md-0 col-sm-0"></div>
            <div class="col-lg-5 col-md-7 col-sm-12 reset-form-wrapper">
                <div class="row logo mt-2 mb-5">
                    <img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="logo image">
                </div>
                <div class="row head">
                    <h1>{{ trans('messages.Reset Password') }}</h1>
                </div>
                <div class="row form-wrapper mt-3">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="control-wrapper mb-3">
                            <label for="forget-email" class="form-label">{{ trans('messages.Email') }}</label>
                            <input type="email" class="form-control" id="forget-email" placeholder="name@example.com"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                autofocus>
                            @error('email')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="control-wrapper mb-3">
                            <label for="reset-password" class="form-label">{{ trans('messages.Password') }}</label>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" aria-describedby="reset-password-eye-btn"
                                    id="reset-password-input" placeholder="******" name="password" required
                                    autocomplete="new-password">
                                <button class="btn" type="button" id="reset-password-eye-btn">
                                    <i class="fa-regular fa-eye" id="reset-password-eye-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="control-wrapper mb-3">
                            <label for="reset-confirm-password"
                                class="form-label">{{ trans('messages.confirm password') }}</label>
                            <div class="input-wrapper">
                                <input type="password" class="form-control"
                                    aria-describedby="reset-confirm-password-btn" id="reset-confirm-password"
                                    placeholder="******" name="password_confirmation" required
                                    autocomplete="new-password">
                                <button class="btn" type="button" id="reset-confirm-password-btn">
                                    <i class="fa-regular fa-eye" id="reset-confirm-password-icon"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-block mt-4"
                            type="submit">{{ trans('messages.Reset Password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ url('front_them/assets/js/index.js') }}"></script>
</body>


</html>
