<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta_title', trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Home'))</title>
    <link href="{{ url('front_them/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/all.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ url('front_them/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ url('front_them/assets/css/social-share.min.css') }}">
    <link rel='stylesheet' href='https://bevacqua.github.io/dragula/dist/dragula.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/style_' . App::getLocale() . '.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/css/dd.min.css" />

</head>

<body>
    <header class="{{ Route::currentRouteName() == 'home' ? '' : 'navbar-pages' }}">
        @include('site.includes.navbar')
        @if (Route::currentRouteName() == 'home')
            @include('site.includes.home_header')
        @endif
    </header>
    @yield('content')
    @include('site.includes.footer')
    @yield('modal')
    <script src="{{ url('panel_them/assets/theme_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script src="{{ url('front_them/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/social-share.min.js') }}"></script>
    <script src="{{ url('front_them/assets/js/sweetalert2.js') }}"></script>
    <script type="module" src="{{ url('front_them/assets/js/test.js')}}"></script>
    <script src="{{ url('front_them/assets/js/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/js/dd.min.js"></script>
    @yield('script')
    <script type="text/javascript">
        $('.lang-change').on('click', function(e) {
            e.preventDefault();
            var locale = $(this).attr('data-code');
            $.post('{{ route('language.change') }}', {
                _token: '{{ csrf_token() }}',
                locale: locale
            }, function(data) {
                location.reload();
            });

        });

        @if (session()->has('notif'))
        $.toast({
            heading: `{{ trans('messages.Notification') }}`,
            text: `{{ session()->get('notif') }}`,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });
        @endif
    </script>
</body>
</html>
