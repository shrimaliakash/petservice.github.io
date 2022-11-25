@extends('layouts.admin_lte')

@section('content-header')
<h1>
  Groups
  <small>Show</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{ url('admin/groups') }}"><i class="fa fa-users"></i> Groups</a></li>
  <li class="active">show</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-xs-12">
            @if($group)
              <div class="row">
                <label class="col-sm-3 col-xs-12">
                  English Name :
                </label>
                <div class="col-sm-9 col-xs-12">
                  {{ $group->name_en }}
                </div>
              </div>
              <div class="row">
                <label class="col-sm-3 col-xs-12">
                  Arabic Name :
                </label>
                <div class="col-sm-9 col-xs-12">
                  {{ $group->name_ar }}
                </div>
              </div>
              <div class="row">
                <label class="col-sm-3 col-xs-12">
                  Created at :
                </label>
                <div class="col-sm-9 col-xs-12">
                  {{ $group->created_at->diffForHumans() }}
                </div>
              </div>
              <div class="row">
                <label class="col-sm-3 col-xs-12">
                  Permissions :
                </label>
                <div class="col-sm-9 col-xs-12">
                  <table class="table table-striped">
                    <?php
                    $permis = $group->permissions;
                    ?>
                    @foreach($perm As $key=>$val)
                    <tr>
                      <th>{{ $val[Session::get('admin_lang')] }}</th>
                      <td>
                        @if(in_array($key, $permis))
                          <i class="fa fa-check" aria-hidden="true"></i>
                        @else
                          <i class="fa fa-times" aria-hidden="true"></i>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <label class="col-sm-3 col-xs-12">
                  Users :
                </label>
                <div class="col-sm-9 col-xs-12">
                  <ul>
                    @foreach($users As $user)
                    <li>{{ $user->name }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @else
              <div class="alert alert-warning">
                No data found
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
