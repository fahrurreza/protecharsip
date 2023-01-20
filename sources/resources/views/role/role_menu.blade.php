@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
<div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">{{$data['page']}} List</h3>
      </div>
      <div class="box-body table-responsive">
        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-12">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr role="row" class="bg-gray">
                    <th>Role</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data['role'] as $role)
                  <tr>
                    <td>{{$role->role}}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <form action="{{route('setting-menu')}}" method="post">
                          @csrf
                          <input type="hidden" name="slack" value="{{$role->slack}}">
                          <button class="btn btn-primary btn-sm">
                            <i class="fa fa-cog"></i> Setting Access
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->
    </div>
</section>

@endsection

@push('custom-scripts')
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endpush