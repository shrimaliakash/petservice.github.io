@extends('layouts.admin_lte')

@section('content-header')
<h1>
  Groups
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Groups</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2 col-xs-12">
    <div class="alert alert-danger">
      <i class="fa fa-frown-o" aria-hidden="true"></i> Oops!! You don't have permission to access this page ...
    </div>
  </div>
</div>
@endsection
