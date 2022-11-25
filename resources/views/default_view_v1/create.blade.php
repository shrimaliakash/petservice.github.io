@extends('layouts.admin_lte')

@section('content-header')
<h1>
  {!! $icon.' '.$title !!}
  <small>{{ __('adminlte.create') }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/admin"><i class="fa fa-dashboard"></i> {{ __('adminlte.home') }}</a></li>
  <li><a href="{{ $route_link }}">{!! $icon.' '.$title !!}</a></li>
  <li class="active">{{ __('adminlte.create') }}</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">

      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            {!! Form::open(['url' => $route_link, 'class' => 'form-horizontal', 'files' => true]) !!}

            @include($view_name.'.fields')

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
