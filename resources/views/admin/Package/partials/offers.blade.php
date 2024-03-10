<label for="name">{{ trans('messages.Offer') }}
</label>
<div>
    {!! Form::select('offer_id', $offers, null, [
        'placeholder' => trans('messages.Choose Offer'),
        'class' => 'form-control',
        'id' => 'offer_id',
        'onchange' => 'getOfferDiscount(this)',
        'data-placeholder' => trans('Offer'),
    ]) !!}
</div>
