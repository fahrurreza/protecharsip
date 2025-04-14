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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalCenter">
      <i class="fas fa-plus"></i> Tambah Menu
    </button>

    <!-- Modal -->
    <div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row" v-bind:class="{ 'has-error': hasError.type }">
              <label for="categoryname" class="col-sm-2 col-form-label">Type*</label>
              <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" name="type" v-model="form.type">
                  <option value="MAIN_MENU">MAIN MENU</option>
                  <option value="SUB_MENU">SUB MENU</option>
                  <option value="ACTIONS">ACTIONS</option>
                </select>
                <span v-if="error.type" class="help-block text-danger">@{{ error.type }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="categoryname" class="col-sm-2 col-form-label">Parent Menu</label>
              <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" name="parent_id" v-model="form.parent_id" :disabled="form.type == 'MAIN_MENU' ">
                  <option selected="selected" value="0">None</option>
                  @foreach($data['menu'] as $menu)
                  <option value="{{$menu->id}}">{{$menu->label}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row" v-bind:class="{ 'has-error': hasError.label }">
              <label for="categoryname" class="col-sm-2 col-form-label">Label*</label>
              <div class="col-sm-10">
                <input v-model="form.label" type="text" name="label" class="form-control" id="form_label">
                <span v-if="error.label" class="help-block">@{{ error.label }}</span>
              </div>
            </div>
            <div class="form-group row" v-bind:class="{ 'has-error': hasError.link }">
              <label for="categoryname" class="col-sm-2 col-form-label">Route</label>
              <div class="col-sm-10">
                <input v-model="form.link" type="text" name="link" class="form-control" id="form_link">
                <span v-if="error.link" class="help-block">@{{ error.link }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="categoryname" class="col-sm-2 col-form-label">Icon</label>
              <div class="col-sm-10">
                <input v-model="form.icon" type="text" name="icon" class="form-control" id="form_icon">
              </div>
            </div>
            <div class="form-group row">
              <label for="categoryname" class="col-sm-2 col-form-label">No. Urut</label>
              <div class="col-sm-10">
                <input v-model.number="form.short_order" type="number" name="short_order" class="form-control" id="short_order" min="1">
              </div>
            </div>
            <div class="form-group row" v-bind:class="{ 'has-error': hasError.status }">
              <label for="categoryname" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" name="status" v-model="form.status">
                  <option selected="selected" value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
              <span v-if="error.status" class="help-block">@{{ error.status }}</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            <button v-if="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="createData"><i class="fa fa-save"></i> Save <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
            <button v-else="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="updateData(this.table.id)"><i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
            <button type="button" class="btn btn-danger" @click="this.resetForm()"><i class="fa fa-recycle"></i> Reset</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <div class="dataTables_length" id="datatable_length">
              show
              <label>
                <select name="datatable_length" aria-controls="datatable" class="form-control input-sm" v-model="table.perPage" @change="this.entries">
                  <option v-for="option in entriesOption" :value="option.value" >@{{option.value}}</option>
                </select> 
              </label>
              entries
            </div>
          </div>
          <div class="col-2">
            <select name="" id="column" class="form form-control">
               <option value="label">Menu</option>
               <option value="route">Link</option>
               <option value="icon">Icon</option>
            </select>
          </div>
          <div class="col-7">
            <input type="text" id="search" class="form form-control" v-on:keyup="this.search()">
          </div>
        </div>
        
                     
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="table-responsive">
              <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Label</th>
                    <th>Route</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in items">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{item.label}}</td>
                    <td>@{{item.route}}</td>
                    <td>@{{item.icon}}</td>
                    <td>
                      <span class="badge btn-success" v-if="item.status == 1">Active</span>
                      <span class="badge btn-warning" v-else>Inactive</span>
                    </td>
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
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3 mx-1">
        <div class="col-sm-5">
        <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing @{{this.meta.from}} to @{{this.meta.to}} of @{{this.meta.total}} entries</div>
        </div>
        <div class="col-sm-7 ml-auto">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item" :class="{disabled : this.meta.current_page <= 1}" @click="this.backPage">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item" v-for="pages in buttonPage" :class="{active : this.meta.current_page == pages.page}">
                <a class="page-link" @click="this.page(pages.page)" v-if="pages.page != '...'">@{{pages.page}}</a>
                <a class="page-link" v-if="pages.page == '...'" disabled>@{{pages.page}}</a>
              </li>
              <li class="page-item" :class="{disabled : this.table.pageSelect >= this.meta.last_page}" @click="this.nextPage">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
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
<script src="assets/js/page/menu.js"></script>
<script src="assets/js/notif.js"></script>
@endpush