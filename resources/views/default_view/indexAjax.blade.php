@extends('layouts.admin_lte')

@section('css-files')
<link rel="stylesheet" href="{{ asset('admin-lte/lib/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('admin-lte/lib/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
@endsection

@section('js-files')
<script src="{{ asset('admin-lte/lib/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/extensions/JSZip/jszip.min.js') }}"></script>
<!-- script src="{{ asset('admin-lte/lib/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/extensions/pdfmake/vfs_fonts.js') }}"></script -->
<script src="{{ asset('admin-lte/lib/datatables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
@endsection

@section('content-header')
<h1>
  {!! $icon.' '.$title !!}
  <small>{{ __('adminlte.view_list') }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> {{ __('adminlte.home') }}</a></li>
  <li class="active">{{ $title }}</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">

      </div>
      <div class="box-body">
        @if($create)
        <div class="row">
          <div class="col-xs-12 text-right">
            <a href="{{ $route_link }}/create" class="btn btn-success create-btn"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('adminlte.create') }}</a>
          </div>
        </div>
        @endif

        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            @if(count($columns))
              <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]' data-page-length='{{ $rows_per_page }}'>
                  <thead>
                    <tr>
                      <?php
                      foreach($columns As $key=>$val){
                        $label = (isset($val['label']))? $val['label'] : $key;
                        echo '<th>'.ucfirst($label).'</th>';
                      }
                      ?>
                      @if($read || $update || $delete)
                      <th>{{ __('adminlte.actions') }}</th>
                      @endif 
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            @else
              <div class="alert alert-warning">
                {{ __('adminlte.no_data') }}
              </div>
            @endif
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

  $(function () {
    var myTable = $("#myTable").DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'excel', 'print' /* 'pdf' */
      ],
      processing: true,
      serverSide: true,
      ajax: '{!! (isset($ajax_url) && !empty($ajax_url))? $ajax_url : $route_link !!}',
      columns: {!! $jsonColumns !!}
    });

    $('input[type=search]').unbind();
    $('input[type=search]').bind('keyup', function(e) {
       if(e.keyCode == 13) {
        myTable.search(this.value).draw();   
      }
    });
  });
</script>
@endsection
