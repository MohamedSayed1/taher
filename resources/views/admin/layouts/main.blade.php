<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('panel_them/images/logo-dark.png') }}">
    <title>@yield('title', trans('messages.Adnan Eltaher'))</title>

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
<!-- Start Css Code custem  -->

<body class="hold-transition light-skin  sidebar-mini theme-primary {{ App::getLocale() == 'ar' ? 'rtl' : '' }} fixed">

    <div class="wrapper">
        @include('admin.includes.top_nave')
        @include('admin.includes.side_menu');
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            <a href="#">{{ trans('messages.All Rights Reserved.') }} {{ trans('messages.For Semicolon-ltd') }}
                &copy;
                {{ date('Y') }}</a>.

        </footer>
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

        @yield('modal')
        <!-- Vendor JS -->
        <script src="{{ url('panel_them/main-semidark/js/vendors.min.js') }}"></script>
        <script src="{{ url('panel_them/main-semidark/js/pages/chat-popup.js') }}"></script>
        <script src="{{ url('panel_them/assets/icons/feather-icons/feather.min.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

        <script src="{{ url('panel_them/assets/theme_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}">
        </script>
        <script
            src="{{ url('panel_them/assets/theme_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}">
        </script>
        <script src="{{ url('panel_them/assets/theme_components/select2/dist/js/select2.full.js') }}"></script>

        <script src="{{ url('panel_them/assets/theme_components/chart.js-master/Chart.min.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}">
        </script>
        <script
            src="{{ url('panel_them/assets/theme_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}">
        </script>
        <script src="{{ url('panel_them/assets/theme_components/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
        <!-- Adnix Admin App -->
        <script src="{{ url('panel_them/assets/theme_components/dropzone/dropzone.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_plugins/iCheck/icheck.js') }}"></script>
        <script src="{{ url('panel_them/main-semidark/js/pages/app-contact.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/PACE/pace.min.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_plugins/ace-builds-master/src-min-noconflict/ace.js') }}"
            type="text/javascript" charset="utf-8"></script>
        <script src="{{ url('panel_them/main-semidark/js/template.js') }}"></script>
        {{-- <script src="{{ url('panel_them/main-semidark/js/pages/form-code-editor.js') }}"></script> --}}
        <script src="{{ url('panel_them/main-semidark/js/pages/component-animations-css3.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/jquery-ui/jquery-ui.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script src="{{ url('panel_them/assets/theme_components/gridstack/lodash.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/gridstack/gridstack.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/gridstack/gridstack.jQueryUI.js') }}"></script>
        <script src="{{ url('panel_them/main-semidark/js/pages/gridstackjs.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/jquery-steps-master/build/jquery.steps.js') }}"></script>
        <script src="{{ url('panel_them/assets/theme_components/jquery-validation-1.17.0/dist/jquery.validate.min.js') }}">
        </script>
        <script src="{{ url('panel_them/assets/theme_components/chart.js-master/Chart.min.js') }}"></script>

        @yield('script')

        <script type="text/javascript">
            $(document).ajaxStart(function() {
                Pace.restart()
            })
            $(".custom-file-input").change(function() {
                var img_src = jQuery(this).parents('.custom-file').parents('.custom-file-container').find("img");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                if (regex.test($(this).val().toLowerCase())) {
                    if (typeof(FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function(e) {

                            img_src.attr("src", e.target.result);
                            $('.custem-css-templet img').attr('src', e.target.result);
                        }
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Please upload a valid image file.");
                }
            });
            $(".custom-file-input-source").change(function() {
                var img_src = jQuery(this).parents('.custom-file').parents('.custom-file-container').find("img");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp|.pdf)$/;
                var imageExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                var getExt = $(this).val().split('.').pop().toLowerCase();
                if (regex.test($(this).val().toLowerCase())) {
                    if (typeof(FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            if ($.inArray(getExt, imageExtension) == -1) {
                                img_src.attr("src", "{{ url('images/source_avatar.png') }}");
                                $('.custem-css-templet img').attr('src',
                                    "{{ url('images/source_avatar.png') }}");
                            } else {
                                img_src.attr("src", e.target.result);
                                $('.custem-css-templet img').attr('src', e.target.result);

                            }

                        }
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Please upload a valid image file.");
                }
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

            function showAjaxsToast(data) {
                $.toast({
                    heading: `{{ trans('Notification') }}`,
                    text: data,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'info',
                    hideAfter: 3000,
                    stack: 6
                });
            }
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var url = $(this).data("href");
                var title = $(this).data("title");
                var desc = $(this).data("desc");
                swal({
                    title: title,
                    text: desc,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: $(this).data("yes"),
                    cancelButtonText: $(this).data("no"),
                    closeOnConfirm: false
                }, function() {
                    console.log($('#destroy-form-' + url));
                    $('#destroy-form-' + url).submit();
                });
            });

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
        </script>
</body>

</html>
