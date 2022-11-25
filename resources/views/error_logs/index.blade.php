@extends('layouts.admin_lte')

@section('content-header')
<h1>
  <i class="fa fa-bug"></i> {{ __('adminlte.error_log') }}
  <small>{{ __('adminlte.view_list') }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> {{ __('adminlte.home') }}</a></li>
  <li class="active">{{ __('adminlte.error_log') }}</li>
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

        @if($has_file == false)
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-warning">
              {{ __('adminlte.log_not_found') }}
            </div>
          </div>
        </div>
        @endif

        <div class="row">
          <div class="col-xs-12 text-right" style="margin-bottom: 30px;">
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete" onclick="setDelete()"><i class="fa fa-trash-o" aria-hidden="true"></i> {{ __('adminlte.delete') }}</a>
          </div>
        </div>

        <div class="row">
          @if(count($logs))
          <div class="col-xs-12 report-error-div">
            <div class="table-responsive">
              <table class="table table-striped">
                @foreach($logs As $key=>$val)
                  @if(empty($val)) 
                    @continue
                  @endif
                <tr>
                  <td>{{ ($key+1) }}</td>
                  <td style="white-space: nowrap;">{{ $val }}</td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
          @else
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="alert alert-success">
              {{ __('adminlte.no_data') }}
            </div>
          </div>
          @endif
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
        <form id="DeleteForm" action="{{ url('admin/delete_logs') }}" method="post">
          {{ csrf_field() }}
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
