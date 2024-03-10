<!DOCTYPE html>
<html lang="ar" dir="rtl"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('front_them/assets/imgs/logo.png') }}">
    <title>{{ trans('messages.Eltaher') }}</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/custom_css.css') }}">

</head>

<body class="hold-transition theme-primary bg-img"
    style="background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(27 169 255)) !important;">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded30 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary">
                                    <img style="width:6em;height:5em"
                                        src="{{ url('front_them/assets/imgs/logo.png') }}" />
                                </h2>
                            </div>
                            <div class="p-40">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">

                                            <input type="email" name="email"
                                                class="form-control pl-15 bg-transparent @error('email') is-invalid @enderror"
                                                placeholder="{{ trans('messages.Email') }}"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">

                                            <input type="password" name="password"
                                                class="form-control pl-15 bg-transparent @error('password') is-invalid @enderror"
                                                placeholder="{{ trans('messages.Password') }}" required
                                                autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5 style="line-height: 2em">{{ trans('messages.Language') }}</h5>
                                            </div>
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <select name="language" id=""
                                                        class="form-control pl-15 bg-transparent">
                                                        <option value="ar">{{ trans('messages.Arabic') }}</option>
                                                        <option value="nl">{{ trans('messages.Netherland') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <!-- /.col -->
                                        <div class="col-12 text-center">
                                            <button type="submit"
                                                class="btn btn-primary mt-10">{{ trans('messages.SIGN IN') }}</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="{{ url('panel_them/main-semidark/js/vendors.min.js') }}"></script>
    <script src="{{ url('panel_them/main-semidark/js/pages/chat-popup.js') }}"></script>
    <script src="{{ url('panel_them/assets/icons/feather-icons/feather.min.js') }}"></script>

</body>

</html>
