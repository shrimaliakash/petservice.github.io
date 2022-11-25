@extends('layouts.admin_lte')

@section('content-header')
<h1>
  {!! $icon.' '.$title !!}
  <small>{{ __('adminlte.show') }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> {{ __('adminlte.home') }}</a></li>
  <li><a href="{{ $route_link }}">{!! $icon.' '.$title !!}</a></li>
  <li class="active">{{ __('adminlte.show') }}</li>
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
            @if($update)
            <a href="{{ $route_link.'/'.$row->id }}/edit" title="Edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('adminlte.modify') }}</a>
            @endif
            @if($delete)
            <a href="javascript:void(0)" title="Delete" onclick="setDelete('{{ $route_link.'/'.$row->id }}')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"> {{ __('adminlte.delete') }}</i></a>
            @endif
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
            @include($view_name.'.show_fields')
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> {{ __('adminlte.delete') }}</h4>
      </div>
      <div class="modal-body">
        {{ __('adminlte.deleteTxt') }}
        <form id="DeleteForm" action="" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('adminlte.cancel') }}</button>
        <button type="button" class="btn btn-danger" onclick="$('#DeleteForm').submit()"><i class="fa fa-times-circle-o" aria-hidden="true"></i> {{ __('adminlte.delete') }}</button>
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
