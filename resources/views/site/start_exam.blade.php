@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . $examInfo->name }}@stop
@section('content')

    <div class="question-container">
        <section class="container-fluid static-page-wrapper">
            <div class="container">
                <div class="row mt-3 mb-5 ">
                    <div class="col-lg-10 col-md-10 col-sm-12 content-wrapper m-auto ">
                        <div class="content">
                            <p class="desc">
                                {!! $examInfo->description !!}
                            </p>
                            <hr>
                            <br>
                            <br>
                            <div class="text-center">
                                <a href="{{ route('startExam', $examInfo->id) }}"
                                    class="btn btn-primary">{{ trans('messages.Start Exam') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')

@endsection
