@extends('layouts.admin_lte')

@section('content-header')
<h1>
  <i class="fa fa-globe" aria-hidden="true"></i> Countries
  <small>Create</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/admin/country"><i class="fa fa-globe"></i> Countries</a></li>
  <li class="active">Create</li>
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
            {!! Form::open(['route' => 'country.store', 'class' => 'form-horizontal']) !!}

            @include('admin.country.fields')

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
