@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . $page->{'title_' . App::getLocale()} }}@stop
@section('content')
    <section class="container-fluid static-page-wrapper">
        <div class="container">
            <div class="row title-row mb-5 text-center">
                <h1 class=" title "> {{ $page->{'title_' . App::getLocale()} }}</h1>
            </div>
            <div class="row mt-3 mb-5 ">
                <div class="col-lg-10 col-md-10 col-sm-12 content-wrapper m-auto ">
                    <div class="content">
                        <p class="desc">
                            {!! $page->{'body_' . App::getLocale()} !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
