@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ $user->name }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="box">
                    <div class="box-body">
                        <h5 class="text-center">{{ $user->email }}</h5>
                        <hr>
                        <h5 class="text-center">{{ $user->role->name }}</h5>

                        @php
                            $permArr = [];
                            foreach (config('global.permissions') as $key => $value) {
                                foreach ($value as $key2 => $value2) {
                                    $permArr[$key2] = $value2;
                                }
                            }
                        @endphp

                        @forelse ($user->role->permissions as $item)
                            <div style="display: inline-block;margin: 1em;" class="alert alert-success">
                                {{ trans('messages.' . $permArr[$item]) }}
                            </div>

                        @empty
                        @endforelse

                    </div>
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
