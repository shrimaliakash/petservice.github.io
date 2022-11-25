<div class="row">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('name_en', 'English name:') !!}
    {!! $row->name_en !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('name_ar', 'Arabic name:') !!}
    {!! $row->name_ar !!}
  </div>
</div>

<div class="row">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('currency_en', 'English currency:') !!}
    {!! $row->currency_en !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('currency_ar', 'Arabic currency:') !!}
    {!! $row->currency_ar !!}
  </div>
</div>

<div class="row">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('code', 'Country code:') !!}
    {!! $row->code !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('lang', 'Default language:') !!}
    {!! ($row->lang == 'ar')? 'Arabic' : 'English' !!}
  </div>
</div>

<div class="row">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('status', 'Status:') !!}
    {!! ($row->status)? 'Active' : 'Inactive' !!}
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    {!! Form::label('facebook_token', 'Facebook token:') !!}
    {!! $row->facebook_token !!}
  </div>
</div>
