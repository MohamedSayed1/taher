@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Theory Package') }}</h3>
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
                        <h3>{{ $theoryPackage->{'name_' . App::getLocale()} }}</h3>
                        <h4>{{ $theoryPackage->price }} <sub>€</sub></h4>
                    </div>
                    <div class="col-md"></div>
                </div>
                <hr>
                <h3 class="text-center">{{ trans('messages.Subscriptions') }}
                    <a href="{{ route('theoryPackage.exportPackageSubscribtions', $theoryPackage->id) }}"
                        class="waves-effect waves-light btn btn-primary-light btn-circle">
                        xlsx
                    </a>
                    <a href="{{ route('theorySubscription.create', ['tpid' => $theoryPackage->id]) }}"
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
                                <th class="text-center">{{ trans('messages.Client') }}</th>
                                <th class="text-center">{{ trans('messages.Email') }}</th>
                                <th class="text-center">{{ trans('messages.Price') }}</th>
                                <th class="text-center">{{ trans('messages.Whatsapp') }}</th>
                                <th class="text-center">{{ trans('messages.Start date') }}</th>
                                <th class="text-center">{{ trans('messages.End date') }}</th>
                                <th class="text-center">{{ trans('messages.Payment Method') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($theoryPackage->subscriptions as $key => $subscription)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="text-center">{{ $subscription->user != null ?$subscription->user->name : $subscription->name }}</td>
                                    <td class="text-center">{{ $subscription->user != null ? $subscription->user->email: $subscription->email }}</td>
                                    <td class="text-center">{{ $subscription->price }}</td>
                                    <td class="text-center">{{ $subscription->whatsapp }}</td>
                                    <td class="text-center">{{ $subscription->subscription_date }}</td>
                                    <td class="text-center">{{ $subscription->pay_type }}</td>
                                    <td class="text-center">{{ $subscription->expiration_date }}</td>
                                    <td class="text-center">{{ $subscription->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('theorySubscription.destroy', $subscription->id) }}"
                                            method="Post" id="destroy-form-{{ $subscription->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('theorySubscription.edit', $subscription->id) }}"
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
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
