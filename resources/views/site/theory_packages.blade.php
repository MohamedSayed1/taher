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
                        <div class="col-lg-3 col-md-3 col-sm-12 wrapper">
                            <div class="theory-package-card card"
                                 @if($thpackage->type_view != 'photo')
                                 style="border: 1px solid {{$thpackage->color_border !=null?$thpackage->color_border:"transparent" }} ;background:{{$thpackage->color_background !=null?$thpackage->color_background:"transparent" }} ;"
                                 @endif
                            >
                                <a style="text-decoration:none" href="{{ route('viewTheoryPackage', $thpackage->id) }}"
                                >
                                    <div class="row">
                                        @if($thpackage->type_view != 'photo')

                                            <div class="col-md-12 col-4">
                                                <div class="theory-package-img-wrapper">
                                                    @if ($thpackage->image)
                                                        <img class="course-img-desktop"
                                                             src="{{ asset($thpackage->image) }}"
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
                                        @else
                                            <div class="col-md-12 col-4">
                                                <div class="theory-package-img-wrapper">
                                                    @if ($thpackage->{'cove_desktop_' . App::getLocale()})
                                                        <img class="course-img-desktop"
                                                             src="{{ asset($thpackage->{'cove_desktop_' . App::getLocale()}) }}"
                                                             style="height: auto; box-shadow:0 0 6px 0 rgba(0, 0, 0, 0.16); border:1px solid rgba(0,0,0,.125); object-fit: contain;aspect-ratio: 1 / 1; width: 100%;"
                                                             alt="">
                                                    @endif
                                                    @if ($thpackage->{'cove_phone_' . App::getLocale()})
                                                        <img class="course-img-mobile d-none"
                                                             style="height: 300px ;box-shadow:0 0 6px 0 rgba(0, 0, 0, 0.16); border:1px solid rgba(0,0,0,.125); object-fit: contain;aspect-ratio: 1 / 1; width: auto;"
                                                             src="{{ asset($thpackage->{'cove_phone_' . App::getLocale()}) }}"
                                                             alt="">

                                                    @endif
                                                </div>
                                            </div>
                                        @endif
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
                        <form id="subscribe-theory-package-form" action="{{ route('purchaseTheoryPackage') }}"
                              method="POST">
                            @csrf

                            <div
                                class="article-input d-flex flex-wrap justify-content-center align-items-center my-3 ">
                                <input type="hidden" name="theory_package" id="theory-package-id">
                                @php
                                    $methods= \Mollie\Laravel\Facades\Mollie::api()->methods->allActive();
                                @endphp
                                <div class="w-100 m-5">
                                    <div class="control-wrapper mb-3">
                                        <label for="payment">{{ trans('messages.payment') }}</label>
                                        <select class="tech" name="payment" is="ms-dropdown" required>
                                            @foreach($methods as $method)
                                                <option data-image="{{ $method->image->svg }}"
                                                        value="{{ $method->id }}">{{ $method->description  }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment')
                                        <small class="error text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
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
            if (whatsapp_num == ' ') {
                event.preventDefault();
                $('#whatsapp_num_confirm-alert').show();
                setTimeout(() => {
                    $('#whatsapp_num_confirm-alert').hide();
                }, 2000);
            }
        });
    </script>
@endsection
