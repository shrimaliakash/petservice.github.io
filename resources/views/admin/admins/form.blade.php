@extends('layouts.admin_lte')

@section('content-header')
<h1>
  Adminstrators
  <small>{{ $action == 'add'? 'Create':'Edit' }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{ url('admin/admins') }}"><i class="fa fa-dashboard"></i> Adminstrators</a></li>
  <li class="active">{{ $action == 'add'? 'Create':'Edit' }}</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        {{ $action == 'add'? 'Create':'Edit' }} Adminstrator
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
            <form  action="{{ url('admin/admins') }}{{ ($action == 'add')? '/' : '/'.$user->id }}" method="post" role="form" class="form-horizontal img-width" enctype="multipart/form-data">
              @if($action == 'edit')
                {{ method_field('PUT') }}
              @endif

              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Full name :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ ($action == 'edit')? $user->name : old('name') }}" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Email :</label>
                <div class="col-sm-9 col-xs-12">
                  @if($action == 'add')
                    <input type="text" name="email" value="{{ ($action == 'edit')? $user->email : old('email') }}" class="form-control" required>
                  @else
                    {{ $user->email }}
                  @endif
                </div>
              </div>
              @if($action == 'edit')
              <div class="form-group">
                <div class="col-xs-12 text-right">
                  <button type="button" class="btn btn-warning" onclick="changePass($(this))" data-status="1">Change Password</button>
                </div>
              </div>
              @endif
              <div id="changePass" class="form-group" {!! $action == 'edit'? 'style="display: none;"' : '' !!} >
                <label class="control-label col-sm-3 col-xs-12">Password :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="password" name="{{ $action == 'add'? 'password' : '' }}" value="" class="form-control" {{ ($action == 'add')? 'required' : '' }} >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Group :</label>
                <div class="col-sm-9 col-xs-12">
                  <select name="group_id" class="form-control" required>
                    <option value="">Select Group</option>
                    @foreach($groups_list As $group)
                      <option value="{{ $group->id }}" {{ ((old('group_id') && old('group_id') == $group->id) || (isset($user) && $user->group_id == $group->id))? 'selected' : '' }} ><?php echo $group->{'name_'.Session::get('admin_lang')} ?></option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Profile image :</label>
                <div class="col-sm-9 col-xs-12">
                  @if($action == 'edit' && !empty($user->avatar))
                    <img src="{{ url('/uploads/users/'.$user->avatar) }}" class="img-thumbnail img-responsive" alt="">
                    <br>
                  @endif
                  <input type="file" name="avatar" value="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12 text-center">
                  <input type="submit" name="" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
  <script>
    function changePass($this){
      if($this.attr('data-status') == '1'){
        $('#changePass').slideDown();
        $('#changePass').find('input[type=password]').attr('name', 'password');
        $this.html('Cancel change password');
        $this.attr('data-status', '2');
      }else{
        $('#changePass').slideUp();
        $('#changePass').find('input[type=password]').attr('name', '');
        $this.html('Change password');
        $this.attr('data-status', '1');
      }
    }
  </script>
@endsection
