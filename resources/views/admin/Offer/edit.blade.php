<div class="modal-header">
    <h4 class="modal-title" id="">{{ trans('messages.Edit Offer') }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body" style="margin: .2% !important;">
    {!! Form::open([
        'method' => 'PUT',
        'route' => ['offer.update', $package->offer->id],
        'files' => true,
        'id' => 'edit-offer-form',
    ]) !!}
    {!! Form::hidden('package_id', $package->id) !!}
    <!-- Nav tabs -->
    <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-home"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-person"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8" role="tab"><span
                    class="hidden-sm-up"><i class="ion-home"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.English') }}</span></a> </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home7" role="tabpanel">
            <div class="p-15">
                <div class="form-group">
                    <label for="title_ar">{{ trans('messages.Title Ar') }}
                    </label>
                    <div>
                        {!! Form::text('title_ar', $package->offer->title_ar, [
                            'class' => 'form-control',
                            'placeholder' => trans('messages.Title Ar'),
                        ]) !!}
                    </div>
                    @error('title_ar')
                        <div class="badge badge-danger text-center" style="width: 100%">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="tab-pane" id="home8" role="tabpanel">
            <div class="p-15">
                <div class="form-group">
                    <label for="title_en">{{ trans('messages.Title EN') }}
                    </label>
                    <div>
                        {!! Form::text('title_en', $package->offer->title_en, [
                            'class' => 'form-control',
                            'placeholder' => trans('messages.Title EN'),
                        ]) !!}
                    </div>
                    @error('title_en')
                        <div class="badge badge-danger text-center" style="width: 100%">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="tab-pane" id="profile7" role="tabpanel">
            <div class="p-15">
                <div class="form-group">
                    <label for="title_nl">{{ trans('messages.Title Nl') }}
                    </label>
                    <div>
                        {!! Form::text('title_nl', $package->offer->title_nl, [
                            'class' => 'form-control',
                            'placeholder' => trans('messages.Title Nl'),
                        ]) !!}
                    </div>
                    @error('title_nl')
                        <div class="badge badge-danger text-center" style="width: 100%">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="padding: 1em;">
        <label for="start_date">{{ trans('messages.Start date') }}
        </label>
        <div>
            {!! Form::datetimeLocal('start_date', $package->offer->start_date, [
                'class' => 'form-control',
                'placeholder' => trans('messages.Start date'),
            ]) !!}
        </div>
        @error('start_date')
            <div class="badge badge-danger text-center" style="width: 100%">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group" style="padding: 1em;">
        <label for="end_date">{{ trans('messages.End date') }}
        </label>
        <div>
            {!! Form::datetimeLocal('end_date', $package->offer->end_date, [
                'class' => 'form-control',
                'placeholder' => trans('messages.End date'),
            ]) !!}
        </div>
        @error('end_date')
            <div class="badge badge-danger text-center" style="width: 100%">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group" style="padding: 1em;">
        <label for="discount_amount">{{ trans('messages.Discount amount') }}
        </label>
        <div>
            {!! Form::number('discount_amount', $package->offer->discount_amount, [
                'class' => 'form-control',
                'placeholder' => trans('messages.Discount amount'),
            ]) !!}
        </div>
        @error('discount_amount')
            <div class="badge badge-danger text-center" style="width: 100%">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!-- /.box-body -->
    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
        <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
    </button>
    {!! Form::Close() !!}
</div>
