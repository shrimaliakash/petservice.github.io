@extends('layouts.admin_lte')

@section('css-files')
<link rel="stylesheet" href="{{ asset('admin-lte/lib/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('js-files')
<script src="{{ asset('admin-lte/lib/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-lte/lib/datatables/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('content-header')
<h1>
  Groups
  <small>List</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Groups</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        All groups
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12 text-right">
            <a href="{{ url('admin/groups/create') }}" class="btn btn-success create-btn"><i class="fa fa-plus" aria-hidden="true"></i> Create group</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12 table-responsive">
            @if($groups)
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Last update</th>
                  <th>Actions</th>
                </tr>
                @foreach($groups As $group)
                  <tr>
                    <td>{{ $group->id }}</td>
                    <td><?php echo $group->{'name_'.Session::get('admin_lang')}; ?></td>
                    <td>{{ $group->updated_at->diffForHumans() }}</td>
                    <td class="has-action">
                      <a href="{{ url('admin/groups/'.$group->id) }}" title="Show Details"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                      <a href="{{ url('admin/groups/'.$group->id) }}/edit" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      <a href="javascript:void(0)" title="Delete" onclick="setDelete('{{ url('admin/groups/'.$group->id) }}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                @endforeach
              </table>
            @else
              <div class="alert alert-warning">
                You don't have any gorup here
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
<script>
  function setDelete($url){
    $('#DeleteForm').attr('action', $url);
    $('#myModal').modal('show');
    return false;
  }
</script>
