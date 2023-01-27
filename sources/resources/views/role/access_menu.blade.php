@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container" id="app">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Access Menu <b>{{$data['role']->role}}</b></h3>
      </div>
      <div class="box-body table-responsive">
        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-12">
              <form>
                <input type="hidden" name="slack" value="{{$data['slack']}}">
                @foreach($data['menu'] as $menu)
                <ul style="list-style-type: none;">
                  <li>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" @click="getAccess('{{$data['slack']}}', {{$menu->id}})" name="menu_id[]" value="{{$menu->id}}" {{access_check($menu->id, $data['slack']) >= 1 ? 'checked' : '' }}>
                        {{$menu->label}}
                      </label>
                    </div>
                    @if(count($menu->children) > 0)
                    <ul style="list-style-type: none;">
                      @foreach($menu->children as $submenu)
                      <li>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" @click="getAccess('{{$data['slack']}}', {{$submenu->id}})" name="menu_id[]" value="{{$submenu->id}}" {{access_check($submenu->id, $data['slack']) >= 1 ? 'checked' : '' }}>
                            {{$submenu->label}}
                          </label>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                    @endif
                  </li>
                </ul>
                @endforeach
                <a class="btn btn-success" href="role-menu">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->
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
<script src="assets/js/page/access.js"></script>
<script src="assets/js/notif.js"></script>
@endpush