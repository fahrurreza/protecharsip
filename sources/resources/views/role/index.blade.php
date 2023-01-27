@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container" id="app">
    
    <!-- Approach -->
    <div class="row">
      <div class="col-sm-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr role="row">
                    <th class="text-center">Role</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><input type="text" id="role" v-on:keyup="this.search('role')"></td>
                    <td></td>
                  </tr>
                  <tr v-for="item in items">
                    <td class="text-center">@{{item.role}}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Pilih
                        </button>
                        <div class="dropdown-menu ml-auto">
                          <li class="dropdown-item" @click="this.editData(item.id)" data-toggle="modal" data-target="#exampleModalCenter"><a>Edit</a></li>
                          <li class="dropdown-item" @click="this.deleteData(item.id)"><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row">
                    <th class="text-center">Role</th>
                    <th class="text-center">Action</th>
                  </tr>
                </tfoot>
              </table>
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" v-model="form.role" placeholder="Input New Role Here...">
                <span class="input-group-append">
                  <button v-if="submit" type="button" class="btn btn-primary btn-flat" @click="createData"> <i class="fa fa-plus"></i> Simpan <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                  <button v-else="submit" type="button" class="btn btn-primary btn-flat" @click="updateData(this.table.id)"> <i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection

@push('custom-scripts')
<script src="assets/vue/vue.js"></script>
<script src="assets/vue/table.js"></script>
<script src="assets/vue/axios.js"></script>
<script src="assets/sweetalert/xsweetalert.js"></script>
<script src="assets/toastr/toastr.min.js"></script>
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/page/role.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush