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
  Adminstrators
  <small>List</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Adminstrators</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        All Adminstrators
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12 text-right">
            <a href="{{ url('admin/admins/create') }}" class="btn btn-success create-btn"><i class="fa fa-plus" aria-hidden="true"></i> Create Adminstrator</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('widgets.errors')
            @include('widgets.success')
          </div>
        </div>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-xs-12 table-responsive">
            @if($users)
              <table id="usersTable" class="table table-bordered table-striped" data-order='[[ 1, "desc" ]]' data-page-length='25'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users As $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><?php echo $user->groups->{'name_'.Session::get('admin_lang')}; ?></td>
                    <td class="has-action">
                      <a href="{{ url('admin/admins/'.$user->id) }}" title="Show Details"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                      <a href="{{ url('admin/admins/'.$user->id.'/edit') }}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      <a href="javascript:void(0)" title="Delete" onclick="setDelete('{{ url('admin/admins/'.$user->id) }}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="alert alert-warning">
                You don't have any adminstrator here
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

@section('javascript')
<script>
  function setDelete($url){
    $('#DeleteForm').attr('action', $url);
    $('#myModal').modal('show');
    return false;
  }

  $(function () {
    $("#usersTable").DataTable();
  });
</script>
@endsection
