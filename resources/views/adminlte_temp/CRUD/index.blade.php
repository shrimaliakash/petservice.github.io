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
  <i class="fa fa-credit-card" aria-hidden="true"></i> الكوبونات
  <small>قائمة</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
  <li class="active">الكوبونات</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        جميع الكوبونات
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12 text-right">
            <a href="/admin/coupon/create" class="btn btn-success create-btn"><i class="fa fa-plus" aria-hidden="true"></i> إضافة كوبون</a>
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
            @if($rows)
              <table id="usersTable" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]' data-page-length='25'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الجوال</th>
                    <th>المدينة</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>بتاريخ</th>
                    <th>العمليات</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($rows As $row)
                  <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->mobile }}</td>
                    <td>{{ $row->city }}</td>
                    <td>{{ ($row->discount_total)? $row->discount_total : $row->total }}</td>
                    <td>{{ ($row->status)? 'مغلق' : 'مفتوح' }}</td>
                    <td style="direction: ltr; text-align: right;">{{ $row->created_at->diffForHumans() }}</td>
                    <td class="has-action">
                      <a href="/admin/orders/{{ $row->id }}" title="Show Details"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                      <a href="/admin/orders/{{ $row->id }}/edit" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      <a href="javascript:void(0)" title="Delete" onclick="setDelete('/admin/orders/{{ $row->id }}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            @else
              <div class="alert alert-warning">
                You don't have any data here
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف</h4>
      </div>
      <div class="modal-body">
        هل تريد تأكيد حذف السجل ؟
        <form id="DeleteForm" action="" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء الامر</button>
        <button type="button" class="btn btn-danger" onclick="$('#DeleteForm').submit()"><i class="fa fa-times-circle-o" aria-hidden="true"></i> حذف</button>
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
