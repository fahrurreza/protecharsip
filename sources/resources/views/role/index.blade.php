@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
  <div class="box box-primary">
      <div class="box-header">
        <i class="ion ion-clipboard"></i>

        <h3 class="box-title">@{{table.name}} List</h3>

        <div class="box-tools pull-right">
          <ul class="pagination pagination-sm inline">
            <li :class="{disabled : this.meta.current_page <= 1}" @click="this.backPage"><a>&laquo;</a></li>
            <li v-for="pages in buttonPage" :class="{active : this.meta.current_page == pages.page}">
              <a @click="this.page(pages.page)" v-if="pages.page != '...'">@{{pages.page}}</a>
              <a v-if="pages.page == '...'" disabled>@{{pages.page}}</a>
            </li>
            <li :class="{disabled : this.table.pageSelect >= this.meta.last_page}" @click="this.nextPage"><a>&raquo;</a></li>
          </ul>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
        <ul class="todo-list">
          <li v-for="item in items">
            <span class="handle">
              <i class="fa fa-ellipsis-v"></i>
              <i class="fa fa-ellipsis-v"></i>
            </span>
            <span class="text">@{{item.role}}</span>
            <div class="tools">
              <i class="fa fa-edit" @click="editData(item.id)"></i>
              <i class="fa fa-trash-o" @click="this.deleteData(item.id)"></i>
            </div>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix no-border">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" v-model="form.role">
          <span class="input-group-btn">
            <button v-if="submit" type="button" class="btn btn-info btn-flat" @click="createData"> <i class="fa fa-plus"></i> Simpan <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
            <button v-else="submit" type="button" class="btn btn-info btn-flat" @click="updateData(this.table.id)"> <i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
          </span>
        </div>
      </div>
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
<script src="assets/js/page/role.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush