@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
<link rel="stylesheet" href="assets/bower_components/select2/dist/css/select2.min.css">
<script src="assets/bower_components/select2/dist/js/select2.full.min.js"></script>
@endpush

<section class="content" id="app">
  <div>
    <div class="box box-info" v-bind:class="{ 'collapsed-box': !show }">
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
      <form class="form-horizontal" id="formPinjam" method="post" action="create-pinjaman">
          @csrf
          <div class="box-body">
            <div class="form-group" v-bind:class="{ 'has-error': hasError.student_id }">
              <label class="col-sm-3 control-label">Siswa*</label>
              <div class="col-sm-7">
                <select class="form-control js-example-basic-single" style="width: 100%;" name="student_id">
                  @foreach($data['student'] as $student)
                  <option value="{{$student->id}}">{{$student->nama_siswa}}</option>
                  @endforeach
                </select>
                <span v-if="error.student_id" class="help-block">@{{ error.student_id }}</span>
              </div>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.book_id }">
              <label class="col-sm-3 control-label">Buku*</label>
              <div class="col-sm-7">
                <select class="form-control js-example-basic-single" multiple="multiple" style="width: 100%;" name="book_id[]">
                  @foreach($data['book'] as $book)
                  @if($book->stock->stock > 0)
                  <option value="{{$book->id}}">{{$book->book_name}}</option>
                  @endif
                  @endforeach
                </select>
                <span v-if="error.book_id" class="help-block">@{{ error.book_id }}</span>
              </div>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.batas_pinjam }">
              <label for="categoryname" class="col-sm-3 control-label">Tanggal Kembali</label>
              <div class="col-sm-7">
              <input type="date" class="form-control" name="batas_pinjam">
              <span v-if="error.batas_pinjam" class="help-block">@{{ error.batas_pinjam }}</span>
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
    @if (session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Success!</h4>
      Data berhasil di simapn
    </div>
    @endif
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
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Id</th>
                    <th>Siswa</th>
                    <th>Buku</th>
                    <th>Batas Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                  <tr class="bg-info">
                    <td class="text-center"></td>
                    <td><input type="text" id="nama_siswa" v-on:keyup="this.search('nama_siswa')"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in items">
                    <td class="text-center" v-if="item.pinjaman.length > 0">@{{item.id}}</td>
                    <td v-if="item.pinjaman.length > 0">@{{item.nama_siswa}}</td>
                    <td v-if="item.pinjaman.length > 0">
                      <ul v-for="pinjam in item.pinjaman">
                        <li><button class="btn btn-light btn-sm">@{{pinjam.book.book_name}}</button></li>
                      </ul>
                    </td>
                    <td v-if="item.pinjaman.length > 0">
                      <ul v-for="pinjam in item.pinjaman">
                        <li><button class="btn btn-light btn-sm">@{{pinjam.batas_dipinjam}}</button></li>
                      </ul>
                    </td>
                    <td class="text-center" v-if="item.pinjaman.length > 0">
                      <ul v-for="pinjam in item.pinjaman" style="list-style-type:none;">
                        <li>
                          <button class="btn btn-warning btn-sm" @click="this.deleteData(pinjam.id)" style="margin-right:10px;">Batal</button>
                          <button class="btn btn-success btn-sm" @click="this.kembaliData(pinjam.id)">Di Kembalikan</button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Id</th>
                    <th>Siswa</th>
                    <th>Buku</th>
                    <th>Batas Tanggal</th>
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
<script src="assets/js/page/pinjaman.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush