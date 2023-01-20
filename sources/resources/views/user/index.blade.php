@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
  <div class="box box-success" v-bind:class="{ 'collapsed-box': !show }">
    <div v-if="!show" class="box-header with-border" @click="this.openForm">
      <div class="box-tools pull-left">
        <button type="button" class="btn btn-box-tool">
          <i class="fa fa-plus"></i> <h1 class="box-title"> Add New @{{table.name}}</h1>
        </button>
      </div>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div v-else="!show" class="box-header with-border" @click="this.closeForm">
      <div class="box-tools pull-left">
        <button type="button" class="btn btn-box-tool">
          <i class="fa fa-minus"></i> <h1 class="box-title"> Add New @{{table.name}}</h1>
        </button>
      </div>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group" v-bind:class="{ 'has-error': hasError.namauser }">
            <label for="categoryname" class="col-sm-3 control-label">Nama Lengkap</label>
            <div class="col-sm-7">
              <input v-model="form.namauser" type="text" class="form-control">
              <span v-if="error.namauser" class="help-block">@{{ error.namauser }}</span>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.role_id }">
            <label for="categoryname" class="col-sm-3 control-label">Role</label>
            <div class="col-sm-7">
            <select class="form-control select2" style="width: 100%;" name="role" v-model="form.role_id">
              @foreach($data['role'] as $role)
              <option value="{{$role->id}}">{{$role->role}}</option>
              @endforeach
            </select>
            <span v-if="error.role_id" class="help-block">@{{ error.role_id }}</span>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.email }">
            <label for="categoryname" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-7">
              <input v-model="form.email" type="email" name="label" class="form-control" id="form_label">
              <span v-if="error.email" class="help-block">@{{ error.email }}</span>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.username }">
            <label for="categoryname" class="col-sm-3 control-label">Username</label>
            <div class="col-sm-7">
              <input v-model="form.username" type="text" class="form-control">
              <span v-if="error.username" class="help-block">@{{ error.username }}</span>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.status }">
            <label for="categoryname" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-7">
            <select class="form-control select2" style="width: 100%;" name="status" v-model="form.status">
                <option selected="selected" value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <span v-if="error.status" class="help-block">@{{ error.status }}</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
              <div class="button">
                <button v-if="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="createData"><i class="fa fa-save"></i> Save <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                <button v-else="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="updateData(this.table.id)"><i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                <button type="button" class="btn btn-danger" @click="this.resetForm()"><i class="fa fa-recycle"></i> Reset</button>
                <button v-if="!submit" type="button" class="btn btn-success pull-right" @click="this.cancelForm()"><i class="fa fa-arrow-left"></i> Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-footer -->
  </div>

  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">@{{table.name}} List</h3>
    </div>
    <div class="box-body table-responsive">
      <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-6">
            <div class="dataTables_length" id="datatable_length">
              <label>Show 
                <select name="datatable_length" aria-controls="datatable" class="form-control input-sm" v-model="table.perPage" @change="this.entries">
                  <option v-for="option in entriesOption" :value="option.value" >@{{option.value}}</option>
                </select> 
                entries
              </label>
            </div>
          </div>
          <!-- <div class="col-sm-6">
            <div id="datatable_filter" class="dataTables_filter">
              <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable" v-model="table.keyword" v-on:keyup="this.search"></label>
            </div>
          </div> -->
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td><input type="text" id="nama_lengkap" v-on:keyup="this.search('nama_lengkap')"></td>
                  <td><input type="text" id="username" v-on:keyup="this.search('username')"></td>
                  <td><input type="text" id="email" v-on:keyup="this.search('email')"></td>
                  <td><input type="text" id="role_id" v-on:keyup="this.search('role_id')"></td>
                  <td><input type="text" id="user_id" v-on:keyup="this.search('user_id')"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr v-for="item in items">
                  <td>@{{item.id}}</td>
                  <td>@{{item.nama_lengkap}}</td>
                  <td>@{{item.username}}</td>
                  <td>@{{item.email}}</td>
                  <td>@{{item.created_at}}</td>
                  <td class="text-center">@{{item.user_id}}</td>
                  <td class="text-center">
                    <span class="badge btn-success" v-if="item.status == 1">Active</span>
                    <span class="badge btn-warning" v-else>Inactive</span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        . . .
                      </button>
                      <div class="dropdown-menu pull-right">
                        <li @click="this.editData(item.id)"><a>Edit</a></li>
                        <li @click="this.deleteData(item.id)"><a>Delete</a></li>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr role="row">
                  <th>ID</th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing @{{this.meta.from}} to @{{this.meta.to}} of @{{this.meta.total}} entries</div>
          </div><div class="col-sm-7">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li :class="{disabled : this.meta.current_page <= 1}" @click="this.backPage"><a>&laquo;</a></li>
              <li v-for="pages in buttonPage" :class="{active : this.meta.current_page == pages.page}">
                <a @click="this.page(pages.page)" v-if="pages.page != '...'">@{{pages.page}}</a>
                <a v-if="pages.page == '...'" disabled>@{{pages.page}}</a>
              </li>
              <li :class="{disabled : this.table.pageSelect >= this.meta.last_page}" @click="this.nextPage"><a>&raquo;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div>
</section>

@endsection

@push('custom-scripts')
<script src="assets/vue/vue.js"></script>
<script src="assets/vue/table.js"></script>
<script src="assets/vue/axios.js"></script>
<script src="assets/sweetalert/xsweetalert.js"></script>
<script src="assets/toastr/toastr.min.js"></script>
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/page/user.js"></script>
<script src="assets/js/notif.js"></script>
@endpush