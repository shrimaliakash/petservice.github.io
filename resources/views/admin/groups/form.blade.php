@extends('layouts.admin_lte')

@section('content-header')
<h1>
  Groups
  <small>{{ $action == 'add'? 'Create':'Edit' }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{ url('admin/groups') }}"><i class="fa fa-dashboard"></i> Groups</a></li>
  <li class="active">{{ $action == 'add'? 'Create':'Edit' }}</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        {{ $action == 'add'? 'Create':'Edit' }} group
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
            <form  action="{{ url('admin/groups') }}{{ ($action == 'add')? '/' : '/'.$group->id }}" method="post" role="form" class="form-horizontal">
              @if($action == 'edit')
                {{ method_field('PUT') }}
              @endif

              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">English Name :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="name_en" value="{{ ($action == 'edit')? $group->name_en : old('name_en') }}" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Arabic Name :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="name_ar" value="{{ ($action == 'edit')? $group->name_ar : old('name_ar') }}" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Permissions :</label>
                <div class="col-sm-9 col-xs-12">
                  <div class="row">
                      <?php $old_perm = old('permissions'); ?>
                      @foreach($perm As $key=>$val)
                      <div class="col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="permissions[]" id="per_{{ $key }}" class="minimal" value="{{ $key }}" {{ (($old_perm && in_array($key, $old_perm)) || (isset($row_perm) && in_array($key, $row_perm)))? 'checked' : '' }} > {{ $val[Session::get('admin_lang')] }}
                          </label>
                        </div>
                      </div>
                      @endforeach
                    </div>
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
$('input[type="checkbox"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})
</script>
@endsection
