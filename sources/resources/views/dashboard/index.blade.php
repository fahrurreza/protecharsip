@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <!-- Content Row -->
      <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Siswa  
                                </div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['siswa']}}</div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Data Instruktur  
                                </div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['instruktur']}}</div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Surat Masuk
                              </div>
                              <div class="row no-gutters align-items-center">
                                  <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data['surat_masuk']}}</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-envelope fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Surat Keluar
                                </div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['surat_keluar']}}</div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Panduan Penggunaan Aplikasi</h6>
      </div>
      <div class="card-body">
        <ul>
            <li>Menu Data Surat</li>
            <p>Digunakan untuk menyimpan semua data surat yang masuk dan yang dikirim</p>
            <li>Menu User</li>
            <p>Digunakan untuk meyimpan semua data seperti data siswa, data instruktur, pengguna aplikasi dan juga hak akses pengguna aplikasi (role)</p>
            <li>Setting Menu</li>
            <p>Menu Setting Menu digunakan untuk mengatur apa-apa saja menu yang diberikan pada masing-masing role</p>
        </ul>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection