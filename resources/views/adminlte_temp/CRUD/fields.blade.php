<div class="form-group">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('name_en', 'English name:') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'required']) !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('name_ar', 'Arabic name:') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control', 'required']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('currency_en', 'English currency:') !!}
    {!! Form::text('currency_en', null, ['class' => 'form-control', 'required']) !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('currency_ar', 'Arabic currency:') !!}
    {!! Form::text('currency_ar', null, ['class' => 'form-control', 'required']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('code', 'Country code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
  </div>
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('lang', 'Default language:') !!}
    {!! Form::select('lang', [
      'ar'  => 'Arabic',
      'en'  => 'English'
    ], null, ['class' => 'form-control', 'required']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-sm-6 col-xs-12">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', [
      '1'  => 'Active',
      '0'  => 'Inactive'
    ], null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-xs-12">
    {!! Form::label('facebook_token', 'Facebook token:') !!}
    {!! Form::textarea('facebook_token', null, ['class' => 'form-control', 'rows' => '3']) !!}
  </div>
</div>

<!-- Submit Field -->
<div class="form-group">
  <div class="col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  </div>
</div>
