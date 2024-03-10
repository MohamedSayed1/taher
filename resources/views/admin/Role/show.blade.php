<div class="modal-header">
    <h5 class="modal-title">{{ $role->name }}</h5>
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<style>
    .bg-1{
        background-color: aliceblue;
    }
    .bg-2{
        background-color: antiquewhite;
    }
    .bg-3{
        background-color: aqua;
    }
    .bg-4{
        background-color: aquamarine;
    }
    .bg-5{
        background-color: blueviolet;
    }
    .bg-6{
        background-color: brown;
    }
</style>
@php
    $bgc[0] = 'bg-primary';
    $bgc[1] = 'bg-secondary';
    $bgc[2] = 'bg-success';
    $bgc[3] = 'bg-info';
    $bgc[4] = 'bg-warning';
    $bgc[5] = 'bg-danger';
    $bgc[6] = 'bg-dark';
    $bgc[7] = 'bg-1';
    $bgc[8] = 'bg-2';
    $bgc[9] = 'bg-3';
    $bgc[10] = 'bg-4';
    $bgc[11] = 'bg-5';
    $bgc[12] = 'bg-6';
    $textc[0] = '#FFF';
    $textc[1] = '#000';
    $textc[2] = '#FFF';
    $textc[3] = '#FFF';
    $textc[4] = '#FFF';
    $textc[5] = '#FFF';
    $textc[6] = '#FFF';
    $textc[7] = '#000';
    $textc[8] = '#000';
    $textc[9] = '#000';
    $textc[10] = '#000';
    $textc[11] = '#FFF';
    $textc[12] = '#FFF';
    $permnames = [];
    foreach (config('global.permissions') as $key => $value) {
        $permnames = array_merge($permnames,$value);
    }
@endphp
<div class="modal-body" style="overflow-y: scroll;">
    <h5>{{ trans('messages.Permissions') }}</h5>
    <div class="row text-center">
        @foreach ($role->permissions as $key => $item)
            <div class="col-lg-6 col-12">
                @php
                    $randNum = rand(0, 12);
                @endphp
                <div class="{{ $bgc[$randNum] }} rounded p-20 mb-30" style="font-size: 12px;color:{{ $textc[$randNum] }}">
                    {{ trans('messages.' . $permnames[$item]) }}
                </div>
            </div>
        @endforeach

    </div>
</div>
