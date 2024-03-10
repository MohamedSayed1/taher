@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Conact Us') }}@stop
@section('content')
    <section class="container-fluid contact-page-wrapper">
        <div class="container">
            <div class="row title-row mb-5 text-center">
                <h1 class=" title ">{{ trans('messages.Contact Us') }}</h1>
            </div>
            <div class="row mt-3 mb-5 content-wrapper  ">
                <div class="col-lg-10 col-md-12 col-sm-12 m-auto ">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 form-wrapper">
                            <h2 class="text-center mb-3">{{ trans('messages.We are pleased to contact you') }}</h2>
                            {!! Form::open(['route' => 'contact.store']) !!}
                            @if (session()->has('notif'))
                                <h3 class="alert alert-success text-center" style="padding: .1em">
                                    {{ session()->get('notif') }}
                                </h3>
                            @endif
                            <div class="control-wrapper mb-1">
                                <label for="name">{{ trans('messages.Name') }}
                                </label>
                                {!! Form::text('name', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Name'),
                                ]) !!}
                                @error('name')
                                    <small class="error text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="control-wrapper mb-1">
                                <label for="email">{{ trans('messages.Email') }}
                                </label>
                                {!! Form::email('email', null, [
                                    'class' => 'form-control',
                                    'id' => 'contact-email',
                                    'placeholder' => 'name@example.com',
                                ]) !!}
                                @error('email')
                                    <small class="error text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="control-wrapper mb-1">
                                <label for="contact-text">{{ trans('messages.Your message') }}
                                </label>
                                {!! Form::textarea('message', null, [
                                    'id' => 'contact-text',
                                    'cols' => '30',
                                    'rows' => '10',
                                    'placeholder' => trans('messages.Your message'),
                                ]) !!}
                                @error('message')
                                    <small class="error text-danger" style="width: 100%">{{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <button class="btn btn-block mt-2" type="submit">{{ trans('messages.Send') }}</button>
                            {!! Form::Close() !!}

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 image-wrapper">
                            <img src="{{ url('front_them/assets/imgs/contact-img.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
