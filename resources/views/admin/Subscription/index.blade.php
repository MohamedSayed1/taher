@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Subscriptions') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <form action="{{ route('subscription.index') }}" method="GET">
                    <div class="row">
                        <div class="col-2">
                            <select name="package_id" id="exam-filter" class="select2 form-control">
                                <option value="{{ null }}">{{ trans('messages.All') }}</option>
                                @foreach ($packages as $package)
                                    <option {{ $package_id == $package->id ? 'selected' : '' }} value="{{ $package->id }}">
                                        {{ $package->{'name_' . App::getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <select name="user_id" id="exam-filter" class="select2 form-control">
                                <option value="{{ null }}">{{ trans('messages.All') }}</option>
                                @foreach ($users as $user)
                                    <option {{ $user_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <input name="from" type="date" class="form-control" value="{{ $from }}">
                        </div>
                        <div class="col-2">
                            <input name="to" type="date" class="form-control" value="{{ $to }}">
                        </div>
                        <div class="col" style="position: relative">
                            <i class="fa fa-filter"
                                style="position: absolute;{{ App::getLocale() == 'ar' ? 'right' : 'left' }}:1em;font-size: 1.5em;line-height: 1.5em;color: #FFF"></i>
                            <input style="height: 2em;line-height: .4em;padding: 1.2em 3em" type="submit"
                                value="{{ trans('messages.Filter') }}" class="btn btn-primary">
                        </div>

                        <div class="col" style="text-align: end">
                            <a href="{{ route('subscription.create') }}"
                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                    class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>

                        </div>


                    </div>
                </form>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">{{ trans('messages.Client') }}</th>
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
                            @foreach ($subscriptions as $key => $subscription)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($subscriptions->currentPage() - 1) * $subscriptions->perPage() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $subscription->user ? $subscription->user->name : trans('messages.Guest') }}
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
                    {!! $subscriptions->withQueryString()->links('pagination::bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal modal-left fade" id="modal-left" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="view-problem">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.select2').select2()
    </script>
@endsection
