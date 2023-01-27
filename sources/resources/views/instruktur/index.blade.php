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
      <i class="fas fa-plus"></i> Tambah Siswa
    </button>

    <!-- Modal -->
    <div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Instruktur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.nama_lengkap }">
                <label for="categoryname" class="col-sm-2 col-form-label">Nama Lengkap*</label>
                <div class="col-sm-10">
                  <input v-model="form.nama_lengkap" type="text" name="label" class="form-control" id="form_label">
                  <span v-if="error.nama_lengkap" class="help-block">@{{ error.nama_lengkap }}</span>
                </div>
              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.tempat_lahir }">
                <label for="categoryname" class="col-sm-2 col-form-label">Tempat Lahir*</label>
                <div class="col-sm-10">
                  <input v-model="form.tempat_lahir" type="text" name="link" class="form-control" id="form_link">
                  <span v-if="error.tempat_lahir" class="help-block">@{{ error.tempat_lahir }}</span>
                </div>
              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.tanggal_lahir }">
                <label for="categoryname" class="col-sm-2 col-form-label">Tanggal Lahir*</label>
                <div class="col-sm-10">
                  <input v-model="form.tanggal_lahir" type="date" name="link" class="form-control" id="form_link">
                  <span v-if="error.tanggal_lahir" class="help-block">@{{ error.tanggal_lahir }}</span>
                </div>
              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.sex }">
                <label for="categoryname" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" name="sex" v-model="form.sex">
                    <option selected="selected" value="laki-laki">laki-laki</option>
                    <option value="perempuan">perempuan</option>
                </select>
                <span v-if="error.sex" class="help-block">@{{ error.sex }}</span>
                </div>
              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.keahlian }">
                <label for="categoryname" class="col-sm-2 col-form-label">Bidang Keahlian*</label>
                <div class="col-sm-10">
                  <input v-model="form.keahlian" type="text" name="label" class="form-control" id="form_label">
                  <span v-if="error.keahlian" class="help-block">@{{ error.keahlian }}</span>
                </div>
              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': hasError.nomor_sk }">
                <label for="categoryname" class="col-sm-2 col-form-label">Nomor SK*</label>
                <div class="col-sm-10">
                  <input v-model="form.nomor_sk" type="text" name="label" class="form-control" id="form_label">
                  <span v-if="error.nomor_sk" class="help-block">@{{ error.nomor_sk }}</span>
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
              <button type="button" class="btn btn-danger" @click="this.resetForm()"><i class="fa fa-recycle"></i> Reset</button>
              <button v-if="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="createData"><i class="fa fa-save"></i> Save <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
              <button v-else="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="updateData(this.table.id)"><i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row my-3">
              <div class="col-sm-12">
                <div class="dataTables_length" id="datatable_length">
                  <label>
                    Show 
                    <select name="datatable_length" aria-controls="datatable" class="form-control input-sm" v-model="table.perPage" @change="this.entries">
                      <option v-for="option in entriesOption" :value="option.value" >@{{option.value}}</option>
                    </select> 
                    entries
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                    <tr role="row">
                      <th>ID</th>
                      <th>Nama Lengkap</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Bidang Keahlian</th>
                      <th>Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td><input type="text" id="nama_lengkap" v-on:keyup="this.search('nama_lengkap')"></td>
                      <td><input type="text" id="tempat_lahir" v-on:keyup="this.search('tempat_lahir')"></td>
                      <td><input type="text" id="tanggal_lahir" v-on:keyup="this.search('tanggal_lahir')"></td>
                      <td><input type="text" id="sex" v-on:keyup="this.search('sex')"></td>
                      <td><input type="text" id="keahlian" v-on:keyup="this.search('keahlian')"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr v-for="item in items">
                      <td>@{{item.id}}</td>
                      <td>@{{item.nama_lengkap}}</td>
                      <td>@{{item.tempat_lahir}}</td>
                      <td>@{{item.tanggal_lahir}}</td>
                      <td>@{{item.sex}}</td>
                      <td>@{{item.bidang_keahlian}}</td>
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
                  <tfoot>
                    <tr role="row">
                      <th>ID</th>
                      <th>Nama Lengkap</th></th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Bidang Keahlian</th>
                      <th>Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3 mx-1">
        <div class="col-sm-5">
          <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing @{{this.meta.from}} to @{{this.meta.to}} of @{{this.meta.total}} entries</div>
        </div>
        <div class="col-sm-10 ml-auto">
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
<script src="assets/js/page/instruktur.js"></script>
<script src="assets/js/notif.js"></script>
@endpush