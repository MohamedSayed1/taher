@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Blog') }}@stop
@section('content')
    <section class="container-fluid blog-page-wrapper">
        <div class="container">
            <div class="row top-row text-center">
                <h1 class="title">{{ trans('messages.Articles and news') }}</h1>
            </div>
            <div class="row articles-wrapper">
                <div class="col-lg-3 col-md-4 col-sm-12 side-menu">
                    <nav class="nav flex-column">
                        @forelse ($blogCategories as $category)
                            <a class="nav-link {{ $category->{'slug_' . App::getLocale()} == $slug ? 'active' : '' }} "
                                aria-current="page"
                                href="{{ route('blog', $category->{'slug_' . App::getLocale()} ? $category->{'slug_' . App::getLocale()} : $category->slug_ar) }}">{{ $category->{'name_' . App::getLocale()} }}</a>
                        @empty
                        @endforelse

                    </nav>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 page-content">
                    <div class="row blog-cards mt-5 mb-5 " id="blog-data">
                    </div>
                    <div class="ajax-load text-center" style="display:none">
                        <p><img style="width: 200px;height: 100px;"
                                src="{{ url('front_them/Bounce-Bar-Preloader-1.gif') }}">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="copyrights-text">
        <p>{{ trans('messages.All rights reserved to Semicolon-Ltd Software Co.') }}</p>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        var page = 1;
        loadMoreData(page);
        page++;
        var footer_height = $("footer").height();
        $(window).scroll(function() {
            if (($(window).scrollTop() + $(window).height() + footer_height + 100) >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });

        function loadMoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data) {
                    if (data.html == "") {
                        $('.ajax-load').html("{{ trans('messages.No more blog found') }}");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#blog-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("{{ trans('messages.server not responding...') }}");
                });
        }
    </script>
@endsection
