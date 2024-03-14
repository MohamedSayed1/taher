@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Home') }}
@stop
@section('content')
    <section class="container-fluid theory-package-section mt-5">
        <div class="container" style="{{count($theory_packages) == 1?'padding-bottom: 3rem;':'' }} border:3px solid #c9c9c9; border-radius:20px">
            <br>
            <div class="youtube-videos-title d-flex justify-content-center">
                <h2>{{ trans('messages.Theory Packages') }}</h2>
            </div>
            <div class="row theory-package-cards mt-5 mb-5 justify-content-center">
                @forelse ($theory_packages as $thpackage)
                    @if($thpackage->type_view != 'photo')
                        <div class="col-lg-4 col-md-3 col-sm-12 wrapper">
                            <div class="theory-package-card card"
                                 style="border: 1px solid {{$thpackage->color_border !=null?$thpackage->color_border:"transparent" }} ;background:{{$thpackage->color_background !=null?$thpackage->color_background:"transparent" }} ;">
                                <a style="text-decoration:none"
                                   href="{{ route('viewTheoryPackage', $thpackage->id) }}">
                                    <div class="row">
                                        <div class="col-md-12 col-4">
                                            <div class="theory-package-img-wrapper">
                                                @if ($thpackage->image)
                                                    <img class="course-img-desktop" src="{{ asset($thpackage->image) }}"
                                                         alt="">
                                                @endif
                                                @if ($thpackage->photo_phone)
                                                    <img class="course-img-mobile d-none"
                                                         src="{{ asset($thpackage->photo_phone) }}"
                                                         alt="">

                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-6">
                                            <h5 class="title">{{ $thpackage->{'name_' . App::getLocale()} }}</h5>
                                            <div class="content-wrapper">
                                                <p class="desc">
                                                    {{ $thpackage->{'short_desc_' . App::getLocale()} }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    @else
                        <div class="col-lg-4 col-md-3 col-sm-12 wrapper">
                            <div class="theory-package-card card" style="padding:0; border:none ">
                                <a style="text-decoration:none"
                                   href="{{ route('viewTheoryPackage', $thpackage->id) }}">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-12">
                                            <div class="theory-package-img-wrapper">
                                                @if ($thpackage->{'cove_desktop_' . App::getLocale()})
                                                    <img class="course-img-desktop" style="height: 170px;  object-fit: contain;aspect-ratio: 16 / 9; width: 100%;"
                                                         src="{{ asset($thpackage->{'cove_desktop_' . App::getLocale()}) }}"
                                                         alt="">
                                                @endif
                                                @if ($thpackage->{'cove_phone_' . App::getLocale()})
                                                    <img class="course-img-mobile d-none" style="height: 170px; object-fit: contain;aspect-ratio: 16 / 9; width: auto;"
                                                         src="{{ asset($thpackage->{'cove_phone_' . App::getLocale()}) }}"
                                                         alt="">

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                @empty
                @endforelse
            </div>
        </div>
    </section>
    @if (sizeof($videos) > 0)
        <section class="container-fluid youtube-videos-section">
            <div class="container">
                <div class="youtube-videos-title d-flex justify-content-center">
                    <h2>{{ trans('messages.Videos') }}</h2>
                </div>
                <a class="view-all-link" href="{{ route('getYoutubeVideos') }}">{{ trans('messages.View all') }}</a>
                @if (App::getLocale() == 'ar')
                    <i class="fa-solid fa-angles-left"></i>
                @else
                    <i class="fa-solid fa-angles-right"></i>
                @endif
                <div class="all-videos mt-4">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($videos as $video)
                                <div class="swiper-slide">
                                    <div class="video-card-container"
                                         onclick="openViedioModel('{{ $video->video_type }}','{{ $video->video_link_id }}','{{ $video->{'title_' . App::getLocale()} }}','{{ $video->{'description_' . App::getLocale()} }}')">
                                        <div class="video-card">
                                            <img src="{{ $video->image ? url($video->image) : '' }}"
                                                 class="video-img w-100" alt="">
                                            <div class="video-info">
                                                <h4>{{ $video->{'title_' . App::getLocale()} }}</h4>
                                                @php
                                                    $descLen = strlen($video->{'description_' . App::getLocale()});
                                                @endphp
                                                @if ($descLen > 160)
                                                    <p>{{ substr($video->{'description_' . App::getLocale()}, 0, 160) }}
                                                        ...
                                                    </p>
                                                @else
                                                    <p>{{ $video->{'description_' . App::getLocale()} }} </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endif

    {{-- <section class="container-fluid counter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 counter-item">
                    <h2 data-max="{{ $examCount }}"> </h2><span>+</span>
                    <p class="text">{{ trans('messages.Exam') }}</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 counter-item">
                    <h2 data-max="{{ $packageCount }}"> </h2><span>+</span>
                    <p class="text">{{ trans('messages.Package') }}</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 counter-item">
                    <h2 data-max="{{ $questionCount }}"> </h2><span>+</span>
                    <p class="text">{{ trans('messages.Question') }}</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 counter-item">
                    <h2 data-max="{{ $clientCount }}"></h2><span>+</span>
                    <p class="text">{{ trans('messages.Trainee') }}</p>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="container why-section">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12 content-wrapper">
                <h1 class="title">
                    {{ trans('messages.Why do you choose to train for the driving test with Adnan Al-Taher?') }}
                </h1>
                <p class="desc">
                    {{ $settings->{'why_eltaher_desc_' . App::getLocale()} }}
                </p>
                <div class="row items-wrapper">
                    <div class="col-lg-6 col-md-12 item">
                        <div class="icon-wrapper">
                            <img src="{{ url('front_them/assets/imgs/tests-icon.png') }}" alt="">
                        </div>
                        <div class="data-wrapper">
                            <h6 class="head">{{ $settings->{'why_eltaher_first_title_' . App::getLocale()} }}</h6>
                            <p class="desc">{{ $settings->{'why_eltaher_first_desc_' . App::getLocale()} }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 item">
                        <div class="icon-wrapper">
                            <img src="{{ url('front_them/assets/imgs/offers-icon.png') }}" alt="">
                        </div>
                        <div class="data-wrapper">
                            <h6 class="head">{{ $settings->{'why_eltaher_secound_title_' . App::getLocale()} }}</h6>
                            <p class="desc">{{ $settings->{'why_eltaher_secound_desc_' . App::getLocale()} }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 img-wrapper">
                <img src="{{ url('front_them/assets/imgs/why-section-img.png') }}" alt="">
            </div>
        </div>
    </section>
    <section class="container reserve-section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 content-wrapper">
                <h1 class="title">{{ trans('messages.Book a test drive now') }}</h1>
                <p class="desc">
                    {{ $settings->{'reserve_exam_desc_' . App::getLocale()} }}
                </p>
                <a href="{{ route('packages') }}" class="btn">{{ trans('messages.Book a test') }}</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 img-wrapper">
                <img src="{{ url('front_them/assets/imgs/reserve-img.png') }}" alt="">
            </div>
        </div>
    </section>
    <section class="container-fluid blog-section">
        <div class="container">
            <div class="row top-row text-center">
                <h1 class="title">{{ trans('messages.Articles and news') }}</h1>
            </div>
            <div class="row blog-cards mt-5 mb-5">
                @forelse ($homeBlog as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-12 wrapper">
                        <div class="news-card card">
                            <div class="blog-img-wrapper">
                                <img src="{{ url($blog->image) }}" alt="">
                                <div class="date">
                                    <span>{{ time_elapsed_string(date('Y-m-d H:i', strtotime($blog->created_at))) }}</span>
                                </div>
                            </div>
                            <div class="content-wrapper">
                                <h5 class="title">{{ $blog->{'title_' . App::getLocale()} }}</h5>
                                <p class="desc">
                                    {{ $blog->{'description_' . App::getLocale()} }}
                                </p>
                            </div>
                            <a href="{{ route('article', $blog->{'slug_' . App::getLocale()} ? $blog->{'slug_' . App::getLocale()} : $blog->slug_ar) }}"
                               class="btn">
                                <span>{{ trans('messages.Read more') }}</span>
                                @if (App::getLocale() == 'ar')
                                    <i class="fa-solid fa-angles-left"></i>
                                @else
                                    <i class="fa-solid fa-angles-right"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="row more-btn-row">
                @php
                    $aBlogs = App\Models\BlogCategory::orderBy('arrangement', 'ASC')->first();
                @endphp
                <a href="{{ route('blog', $aBlogs->{'slug_' . App::getLocale()} ? $aBlogs->{'slug_' . App::getLocale()} : $aBlogs->slug_ar) }}"
                   class="btn">
                    {{ trans('messages.View all articles') }}
                </a>
            </div>
        </div>
    </section>
    <section class="container-fluid reviews-row">
        <div class="row top-row">
            <h1 class="title">{{ trans('messages.Opinions of our learners') }}</h1>
        </div>
        <div class="row slider-row mt-1">
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @forelse ($opinions as $opinion)
                        <div class="swiper-slide">
                            <div class="text-wrapper">
                                <i class="fa-solid fa-quote-right"></i>
                                <p class="text">
                                    {{ $opinion->opinion }}
                                </p>
                            </div>
                            <div class="user-info">

                                <div class="data">
                                    <p class="name">{{ $opinion->client->name }}</p>
                                    <p class="date">
                                        {{ time_elapsed_string(date('Y-m-d H:i', strtotime($opinion->created_at))) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <div class="modal fade subscrib-theory-modal" id="subscrib-theory-modal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="head d-flex align-items-center">
                        <h2 class="title text-center">{{ trans('messages.Subscrib theory package') }}</h2>
                    </div>

                    <div class="content">
                        <form action="{{ route('purchaseTheoryPackage') }}" method="POST"
                              id="subscribe-theory-package-form">
                            @csrf

                            <div
                                class="article-input d-flex flex-wrap justify-content-center align-items-center my-3 ">
                                <input type="hidden" name="theory_package" id="theory-package-id">

                                <div class="w-100 m-5">
                                    <label for="">{{ trans('messages.Name') }}</label>
                                    <input class="form-control" type="text" name="name"
                                           id="name"
                                           placeholder="{{ trans('messages.Name') }}"
                                           value="" required>
                                    <label for="">{{ trans('messages.Email') }}</label>
                                    <input class="form-control" type="email" name="email"
                                           id="email"
                                           placeholder="{{ trans('messages.Email') }}"
                                           value="" required>
                                    <label for="">{{ trans('messages.Insert whatsapp') }}</label>
                                    <input class="form-control" type="number" name="whatsapp_num"
                                           id="whatsapp_num"
                                           placeholder="{{ trans('messages.Whatsapp Number') }}"
                                           value="" required>

                                    <label for="">{{ trans('messages.Confirm Whatsapp Number') }}</label>
                                    <input class="form-control" type="number" name="whatsapp_num_confirm"
                                           id="whatsapp_num_confirm"
                                           placeholder="{{ trans('messages.Confirm Whatsapp Number') }}"
                                           value="" required>

                                    <small class="error text-danger" style="display: none"
                                           id="whatsapp_num_confirm-alert">{{ trans('messages.numbers doesnt matches') }}</small>
                                </div>

                                <div>
                                    <button type="submit"
                                            class="btn btn-dark">{{ trans('messages.Start now') }}</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg play-video-modal" id="play-video" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="content">
                        <h3 class="text-center" id="play-video-title"></h3>
                        <br>
                        <hr>
                        <br>
                        <div id="play-video-content">

                        </div>
                        <p class="text-center" id="play-video-desc"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function openViedioModel(video_type, video_link_id, title, description) {
            if (video_type == 'youtube') {
                $('#play-video-content').html(
                    `<iframe width="660" height="415" src="https://www.youtube.com/embed/${video_link_id}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`
                );
            } else if (video_type == 'tiktok') {
                $.post(`{{ route('tiktok.getModelData') }}`, {
                        _token: '{{ csrf_token() }}',
                        id: video_link_id
                    },
                    function (data) {
                        $('#play-video-content').html(data);
                    });
            } else if (video_type == 'instagram') {
                $.post(`{{ route('instagram.getInstagramModelData') }}`, {
                        _token: '{{ csrf_token() }}',
                        id: video_link_id
                    },
                    function (data) {
                        $('#play-video-content').html(data);
                    });
            }

            $('#play-video-title').text(title)
            $('#play-video-desc').text(description)
            $('#play-video').modal('show');
        }

        function subscribTheoryPackage(id) {
            $('#theory-package-id').val(id);
        }

        $('#subscribe-theory-package-form').submit(function (event) {
            var whatsapp_num = $('#whatsapp_num').val();
            var whatsapp_num_confirm = $('#whatsapp_num_confirm').val();
            if (whatsapp_num != whatsapp_num_confirm) {
                event.preventDefault();
                $('#whatsapp_num_confirm-alert').show();
                setTimeout(() => {
                    $('#whatsapp_num_confirm-alert').hide();
                }, 2000);
            }
        });
    </script>

@endsection
