@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.View Client') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md"></div>
                    <div class="col-md text-center">
                        <h3>{{ $client->name }}</h3>
                        <h4>{{ $client->email }} {{ $client->phone ? ' - ' . $client->phone : '' }}</h4>
                    </div>
                    <div class="col-md"></div>
                </div>
                <hr>
                <h3 class="text-center">{{ trans('messages.Subscriptions') }}
                    <a href="{{ route('subscription.create',['user_id' => $client->id]) }}"
                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                                class="path1"></span><span class="path2"></span></span></a>
                </h3>
                <hr>
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">{{ trans('messages.Package') }}</th>
                                <th class="text-center">{{ trans('messages.Price') }}</th>
                                <th class="text-center">{{ trans('messages.Discount amount') }}</th>
                                <th class="text-center">{{ trans('messages.Start date') }}</th>
                                <th class="text-center">{{ trans('messages.End date') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($client->subscriptions as $key => $subscription)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="text-center">{{ $subscription->package->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $subscription->price }}</td>
                                    <td class="text-center">{{ $subscription->offer_discount }}</td>
                                    <td class="text-center">{{ $subscription->subscription_date }}</td>
                                    <td class="text-center">{{ $subscription->expiration_date }}</td>
                                    <td class="text-center">{{ $subscription->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('subscription.destroy', $subscription->id) }}"
                                            method="Post" id="destroy-form-{{ $subscription->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('subscription.edit', $subscription->id) }}"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Write"><span class="path1"></span><span
                                                    class="path2"></span></span></a>

                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                            data-no="{{ trans('messages.Cancel') }}"
                                            data-yes="{{ trans('messages.Yes, delete it!') }}"
                                            data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                            href="#" data-href="{{ $subscription->id }}"
                                            class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <hr>
                <h3 class="text-center">{{ trans('messages.test result') }}</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">{{ trans('messages.The Exam') }}</th>
                                <th class="text-center">{{ trans('messages.Score') }}</th>
                                <th class="text-center">{{ trans('messages.Correct answers') }}</th>
                                <th class="text-center">{{ trans('messages.Wrong answers') }}</th>
                                <th class="text-center">{{ trans('messages.Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->results as $key => $result)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="text-center">{{ $result->exam->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $result->score }}</td>
                                    <td class="text-center">{{ $result->total_right_questions }}</td>
                                    <td class="text-center">
                                        {{ $result->total_wrong_questions + $result->total_skiped_questions + $result->total_not_answered_questions }}
                                    </td>
                                    <td class="text-center">{{ date('Y-m-d', strtotime($result->created_at)) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>
@endsection


@section('script')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
