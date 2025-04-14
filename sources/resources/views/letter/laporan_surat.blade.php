@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
  .note {
  width: 500px;
  margin: 50px auto;
  font-size: 1.1em;
  color: #333;
  text-align: justify;
  }
  #drop-area {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
  }
  #drop-area.highlight {
    border-color: purple;
  }
  p {
    margin-top: 0;
  }
  .my-form {
    margin-bottom: 10px;
  }
  #gallery {
    margin-top: 10px;
  }
  #gallery img {
    width: 150px;
    height: 100px;
    margin-bottom: 10px;
    margin-right: 10px;
    vertical-align: middle;
  }
  .button {
    display: inline-block;
    padding: 10px;
    background: #224abe;
    cursor: pointer;
    border-radius: 5px;
    border: 1px solid #224abe;
  }
  .button:hover {
    background: #ddd;
  }
  #fileElem {
    display: none;
  }
</style>
@endpush
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container" id="app">
    <!-- Button trigger modal -->
     
    <form action="{{ url('print-laporan') }}" method="get">
      <div class="row">
          <div class="col-2">
              <label for="month">Pilih Bulan:</label>
          </div>
          <div class="col-2">
              <input class="form-control" type="month" id="date" name="date" value="{{ request()->get('date') }}">
              <!-- value={{ request()->get('date') }} digunakan untuk menjaga nilai bulan yang dipilih tetap ada setelah form disubmit -->
          </div>
          <div class="col-2">
              <input type="hidden" id="type" name="type" value="{{ $data['type'] }}">
          </div>
          <div class="col-2">
              <button type="submit" class="btn btn-warning mb-3">
                  <i class="fas fa-search"></i> Cari
              </button>
          </div>
      </div>
    </form>
    


    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data {{$data['page']}}</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    @if($data['type'] === 'in')
                    <th>Pengirim</th>
                    @else
                    <th>Tujuan</th>
                    @endif
                    <th>No. Surat</th>
                    <th>Tgl. Surat</th>
                    <th>Perihal</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    @if($data['type'] === 'in')
                    <th>Pengirim</th>
                    @else
                    <th>Tujuan</th>
                    @endif
                    <th>No. Surat</th>
                    <th>Tgl. Surat</th>
                    <th>Perihal</th>
                </tr>
            </tfoot>
            <tbody id="data-body">
              @foreach($data['item'] as $items)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$items->pengirim}}</td>
                  <td>{{$items->no_surat}}</td>
                  <td>{{date('d-m-Y', strtotime($items->tgl_surat))}}</td>
                  <td>{{$items->notes}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
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
<script src="assets/js/page/letterin.js"></script>
<script src="assets/js/notif.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/demo/datatables-demo.js"></script>
@endpush