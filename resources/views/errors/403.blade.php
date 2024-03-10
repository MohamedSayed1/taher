<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('panel_them/images/logo-dark.png') }}">
    <title>@yield('title', trans('messages.Eltaher'))</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ url('panel_them/main-semidark/css/custom_css.css') }}">
    @if (App::getLocale() == 'ar')
        <link
            href="https://fonts.googleapis.com/css?family=Amiri|Aref+Ruqaa|Baloo+Bhaijaan|Cairo|Changa|El+Messiri|Harmattan|Jomhuria|Katibeh|Lalezar|Lateef|Lemonada|Mada|Markazi+Text|Mirza|Rakkas|Reem+Kufi|Scheherazade|Tajawal&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @endif

</head>

<body class="hold-transition theme-primary {{ App::getLocale() == 'ar' ? 'rtl' : '' }}">

    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div class="rounded30 p-50">
                        <h1>{{ trans('messages.Forbidden !') }}</h1>
                        <h3>{{ trans('messages.looks like, not authorized to get here !') }}</h3>
                        <div class="my-30"><a href="{{ route('dashboard') }}"
                                class="btn btn-primary">{{ trans('messages.Back to dashboard') }}</a></div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Vendor JS -->
    <script src="{{ url('panel_them/main-semidark/js/vendors.min.js') }}"></script>
    <script src="{{ url('panel_them/main-semidark/js/pages/chat-popup.js') }}"></script>
    <script src="{{ url('panel_them/assets/icons/feather-icons/feather.min.js') }}"></script>


</body>

</html>
