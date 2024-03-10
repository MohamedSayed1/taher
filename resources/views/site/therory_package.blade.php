@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . $theoryPackage->{'name_' . App::getLocale()} }}
@stop
@section('content')
    <section class="container-fluid article-page-wrapper">
        <div class="container">
            <div class="row article-wrapper mt-3 mb-5 ">
                <div class="col-lg-10 col-md-10 col-sm-12 article-content-wrapper mx-auto">
                    @if (session('error'))
                        <div class="alert alert-danger" style="margin-bottom: 3em">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="article-card">
                        <div class="blog-img-wrapper">
                            @if ($theoryPackage->image)
                                <img class="course-img-desktop" src="{{ asset($theoryPackage->image) }}" alt="">
                            @endif
                            @if ($theoryPackage->photo_phone)
                                <img class="course-img-mobile d-none" src="{{ asset($theoryPackage->photo_phone) }}"
                                     alt="">

                            @endif
                        </div>
                        <div class="content-wrapper">
                            <div class="date">
                                <span> {{ $theoryPackage->price }} € </span>
                            </div>
                            <h1 class="title">{{ $theoryPackage->{'name_' . App::getLocale()} }}</h1>
                            <p class="desc">
                                {!! nl2br($theoryPackage->{'notes_' . App::getLocale()}) !!}
                            </p>
                            <div class="text-center">
                                <a onclick="subscribTheoryPackage({{ $theoryPackage->id }})" data-bs-toggle="modal"
                                   data-bs-target="#subscrib-theory-modal" class="btn btn-dark">
                                    <span>{{ trans('messages.buyNow') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
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
                            <input type="hidden" name="theory_package" id="theory-package-id"
                                   value="{{ $theoryPackage->id }}">

                            <div
                                class="article-input d-flex flex-wrap justify-content-center align-items-center my-3 ">


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
    @if ($openmodel == true)
        <script type="text/javascript">
            $(document).ready(function () {
                $('#subscrib-theory-modal').modal('show');
            })
        </script>
    @endif
    <script type="text/javascript">
        $('#subscribe-theory-package-form').submit(function (event) {
            var whatsapp_num = $('#whatsapp_num').val();

            if (whatsapp_num == '') {
                event.preventDefault();
                $('#whatsapp_num_confirm-alert').show();
                setTimeout(() => {
                    $('#whatsapp_num_confirm-alert').hide();
                }, 2000);
            }
        });
    </script>
@endsection
