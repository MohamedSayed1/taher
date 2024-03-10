@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Theory Packages') }}
@stop
@section('content')
    <section class="container-fluid theory-package-wrapper">
        <div class="container">
            <div class="row top-row text-center">
                <h1 class="title">{{ trans('messages.Theory Packages') }}</h1>
            </div>
            <div class="row theory-package-cards mt-5 mb-5">
                @forelse ($theory_packages as $thpackage)
                    <div class="col-lg-4 col-md-4 col-sm-12 wrapper">
                        <div class="theory-package-card card"  style="border: 1px solid {{$thpackage->color_border !=null?$thpackage->color_border:"transparent" }} ;background:{{$thpackage->color_background !=null?$thpackage->color_background:"transparent" }} ;">
                            <a style="text-decoration:none" href="{{ route('viewTheoryPackage', $thpackage->id) }}"
                            >
                                <h5 class="title">{{ $thpackage->{'name_' . App::getLocale()} }}</h5>
                                <div class="theory-package-img-wrapper">

                                    @if ($thpackage->image)
                                        <img class="course-img-desktop w-100" src="{{ asset($thpackage->image) }}" alt="">
                                    @endif
                                    @if ($thpackage->photo_phone)
                                        <img class="course-img-mobile d-none w-100" src="{{ asset($thpackage->photo_phone) }}"
                                             alt="">

                                    @endif
                                    <div class="date">
                                        <span> {{ $thpackage->price }} € </span>
                                    </div>
                                </div>
                                <div class="content-wrapper">
                                    <p class="desc">
                                        {!! nl2br($thpackage->{'short_desc_' . App::getLocale()}) !!}
                                    </p>
                                </div>
                                <div class="theory-button-sub d-flex justify-content-between">
                                    <a href="{{ route('viewTheoryPackage', $thpackage->id) }}" class="btn right-button">
                                        <span>{{ trans('messages.Read more') }}</span>
                                        @if (App::getLocale() == 'ar')
                                            <i class="fa-solid fa-angles-left"></i>
                                        @else
                                            <i class="fa-solid fa-angles-right"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="theory-button-left">

                                    <a onclick="subscribTheoryPackage({{ $thpackage->id }})" data-bs-toggle="modal"
                                       data-bs-target="#subscrib-theory-modal" class="btn left-button">
                                        <span>{{ trans('messages.buyNow') }}</span>
                                    </a>

                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
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
                        <form  id="subscribe-theory-package-form" action="{{ route('purchaseTheoryPackage') }}" method="POST">
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
@endsection
@section('script')
    <script type="text/javascript">
        function subscribTheoryPackage(id) {
            $('#theory-package-id').val(id);
        }

        $('#subscribe-theory-package-form').submit(function (event) {
            var whatsapp_num = $('#whatsapp_num').val();
            if (whatsapp_num ==' ') {
                event.preventDefault();
                $('#whatsapp_num_confirm-alert').show();
                setTimeout(() => {
                    $('#whatsapp_num_confirm-alert').hide();
                }, 2000);
            }
        });
    </script>
@endsection
