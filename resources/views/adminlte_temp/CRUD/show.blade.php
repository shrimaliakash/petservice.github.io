@extends('layouts.admin_lte')

@section('content-header')
<h1>
  <i class="fa fa-globe" aria-hidden="true"></i> Countries
  <small>Show</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/admin/country"><i class="fa fa-globe"></i> Countries</a></li>
  <li class="active">Show</li>
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
          <div class="col-xs-12 text-right">
            <a href="/admin/country/{{ $row->id }}/edit" title="Edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modify</a>
            <a href="javascript:void(0)" title="Delete" onclick="setDelete('/admin/country/{{ $row->id }}')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 showPage">
            @include('admin.country.show_fields')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record ?
        <form id="DeleteForm" action="" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="$('#DeleteForm').submit()"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>
  function setDelete($url){
    $('#DeleteForm').attr('action', $url);
    $('#myModal').modal('show');
    return false;
  }
</script>
@endsection
