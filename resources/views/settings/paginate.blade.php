@extends('layouts.admin_lte')

@section('content-header')
<h1>
  {!! $icon.' '.$title !!}
  <small>{{ __('adminlte.view_list') }}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/admin"><i class="fa fa-dashboard"></i> {{ __('adminlte.home') }}</a></li>
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
          <div class="col-sm-10 col-sm-offset-1 col-xs-12 table-responsive">
            @if($rows && count($columns))
              <table id="usersTable" class="table table-bordered table-striped setting-table" data-order='[[ 0, "desc" ]]' data-page-length='25'>
                <thead>
                  <tr>
                    <?php
                    foreach($columns As $key=>$val){
                      $label = (isset($val['label']))? $val['label'] : $key;
                      echo '<th>'.ucfirst($label).'</th>';
                    }
                    ?>
                    <th>{{ __('adminlte.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($rows As $row)
                    <tr>
                      @foreach($columns As $key=>$val)
                        <td>
                          @if($key == 'value' && isset($fields[$row->key]))
                            <?php
                            $field_row = $fields[$row->key];
                            if(isset($field_row['type']) && $field_row['type'] == 'select'){
                              if(isset($field_row['select_data']) && isset($field_row['select_data'][$row->{$key}]))
                                echo $field_row['select_data'][$row->{$key}];
                              else
                                echo $row->{$key};
                            }else if(isset($field_row['type']) && $field_row['type'] == 'file' && $row->{$key}){
                                echo '<img src="'.url($update_path.'/'.$row->{$key}).'" class="img-responsive img-thumbnail" />';
                            }else if(isset($field_row['type']) && $field_row['type'] == 'checkbox'){
                              if($row->{$key}){
                                echo '<i class="fa fa-check-circle-o"></i>';
                              }else{
                                echo '<i class="fa fa-times-circle-o"></i>';
                              }
                            }else{
                              echo $row->{$key};
                            }
                            ?>
                          @else
                            @if(isset($val['value']))
                              {!! eval("echo ".$val['value'].";") !!}
                            @else
                              {{ $row->{$key} }}
                            @endif
                          @endif
                        </td>
                      @endforeach
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
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="row">
                <div class="col-xs-12">
                  {{ $rows->links() }}
                </div>
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
</script>
@endsection
