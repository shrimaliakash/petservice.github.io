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
          <div class="col-sm-10 col-sm-offset-1 col-xs-12">
            @if($rows && count($columns))
              <div class="table-responsive">
                <table id="usersTable" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]' data-page-length='{{ $rows_per_page }}'>
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
                    @foreach($rows As $row)
                    <tr>
                      @foreach($columns As $key=>$val)
                      <td>
                        @if(isset($val['value']))
                          {!! eval("echo ".$val['value'].";") !!}
                        @else
                          @if(isset($val['type']) && $val['type'] == 'file')
                            <?php 
                            if(filter_var($row->{$key}, FILTER_VALIDATE_URL))
                              $data_img = $row->{$key};
                            else
                              $data_img = url($update_path.'/'.$row->{$key});
                            ?> 

                            <img src="{{ $data_img }}" class="img-responsive img-thumbnail" />
                          @else
                            {{ $row->{$key} }}
                          @endif
                        @endif
                      </td>
                      @endforeach

                      @if($read || $update || $delete)
                      <td class="has-action">
                        @if($read)
                        <a href="{{ $route_link.'/'.$row->id }}" title="Show Details"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                        @endif
                        @if($update)
                        <a href="{{ $route_link.'/'.$row->id }}/edit" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        @endif
                        @if($delete)
                        <a href="javascript:void(0)" title="Delete" onclick="setDelete('{{ $route_link.'/'.$row->id }}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        @endif
                      </td>
                      @endif 
                    </tr>
                    @endforeach
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
    $("#usersTable").DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'excel', 'print' // 'pdf'
      ]
    });
  });
</script>
@endsection
