@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.FAQ') }}@stop
@section('content')
    <section class="container-fluid faq-page-wrapper">
        <div class="container">
            <div class="row title-row mb-5 text-center">
                <h1 class=" title ">{{ trans('messages.FAQ') }}</h1>
            </div>
            <div class="row mt-3 mb-5 ">
                <div class="col-lg-8 col-md-10 col-sm-12 content-wrapper m-auto ">
                    <div class="faq-group">
                        @forelse ($faqs as $faq)
                            <div class="faq-row">
                                <div class="wrap-collapsible">
                                    <input class="toggle" type="checkbox" id="q{{ $faq->id }}" checked="checked" />
                                    <label class="label-toggle"
                                        for="q{{ $faq->id }}">{{ $faq->{'question_' . App::getLocale()} }}</label>
                                    <div class="collapsible-content">
                                        <div class="content-inner">
                                            <p>
                                                {!! $faq->{'answer_' . App::getLocale()} !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
