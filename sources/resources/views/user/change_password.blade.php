@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">

    <form action="{{route('change_password')}}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="New Password" name="password_update">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Update Password</button>
        
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
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