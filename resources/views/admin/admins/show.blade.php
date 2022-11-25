@extends('layouts.admin_lte')

@section('content-header')
<h1>
  Adminstrator
  <small>Show</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{ url('admin/admins') }}"><i class="fa fa-users" aria-hidden="true"></i> Adminstrators</a></li>
  <li class="active">show</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3 col-xs-12">
            @if($user->avatar)
              <img src="{{ url('/uploads/users/'.$user->avatar) }}" class="img-thumbnail img-responsive" alt="user profile">
            @else
              <img src="{{ asset('admin-lte/img/user-icon.png') }}" class="img-thumbnail img-responsive" alt="user profile">
            @endif
          </div>
          <div class="col-sm-1 hidden-xs"></div>
          <div class="col-sm-8">
            <table class="table table-striped">
              <tr>
                <th>name :</th>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>Email :</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>Group :</th>
                <td><?php echo $user->groups->{'name_'.Session::get('admin_lang')} ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
