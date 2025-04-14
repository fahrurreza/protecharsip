@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container" id="app">
    <a href="{{ url()->previous() }}" class="btn btn-success mb-3">Back</a>
    <div class="card card-body">
      <iframe id="iframepdf" src="{{asset('assets/document/'.$data['file'])}}" height="800"></iframe>

    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection