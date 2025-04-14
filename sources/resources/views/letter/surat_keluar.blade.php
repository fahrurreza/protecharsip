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
    <button type="button" class="btn btn-warning mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-arrow-right"></i> Surat Keluar Baru
    </button>

    <div class="collapse mb-3" id="collapseExample">
      <div class="card card-body">
        <form class="row" method="post" enctype="multipart/form-data" action="{{route('create-surat-keluar')}}">
          @csrf
          <div class="col-md-6">
            <div class="form-group">
              <label>No. Agenda</label>
              <input type="text" class="form-control border-left-primary" name="no_agenda">
            </div>
            <div class="form-group">
              <label>Tujuan Kirim</label>
              <input type="text" class="form-control border-left-primary" name="pengirim">
            </div>
            <div class="form-group">
              <label>No. Surat</label>
              <input type="text" class="form-control border-left-primary" name="no_surat">
            </div>
            <div class="form-group">
              <label>Perihal</label>
              <textarea class="form-control border-left-primary" name="notes" id="" cols="30" rows="2"></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Surat</label>
              <input type="date" class="form-control border-left-primary" name="tgl_surat">
            </div>
            <!-- <div class="form-group">
              <label>Tanggal Diterima</label>
              <input type="date" class="form-control border-left-primary" name="tgl_dikirim">
            </div> -->
            <div class="form-group">
              <label>Document</label>
              <div id="drop-area" class="text-center">
                <input type="file" id="fileElem" multiple accept="image/*, .pdf" onchange="handleFiles(this.files)" name="document[]">
                <label class="button btn btn-primary" for="fileElem">Select some files</label>
                <progress id="progress-bar" max=100 value=0></progress>
                <div id="gallery" /></div>
              </div>
            </div>
          </div>
          <div class="button-footer ml-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-recycle"></i> Reset</button>
          </div>
        </form>
      </div>
    </div>


    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Surat Keluar</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tujuan</th>
                    <th>No. Surat</th>
                    <th>Tgl. Surat</th>
                    <th>Perihal</th>
                    <th>Posted By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Tujuan</th>
                    <th>No. Surat</th>
                    <th>Tgl. Surat</th>
                    <th>Perihal</th>
                    <th>Posted By</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
              @foreach($data['item'] as $items)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$items->pengirim}}</td>
                  <td>{{$items->no_surat}}</td>
                  <td>{{date('d-m-Y', strtotime($items->tgl_surat))}}</td>
                  <td>{{$items->notes}}</td>
                  <td>{{$items->user->username}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih
                      </button>
                      <div class="dropdown-menu ml-auto">
                        <li class="dropdown-item"><a href="{{url('surat-keluar/'.$items->slack)}}">Lihat</a></li>
                        <li class="dropdown-item"><a href="{{url('edit-surat-keluar/'.$items->slack)}}">Edit</a></li>
                        <li class="dropdown-item"><a href="{{url('delete-surat/'.$items->slack)}}">Delete</a></li>
                      </div>
                    </div>
                  </td>
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

<script>
  // ************************ Drag and drop ***************** //
let dropArea = document.getElementById("drop-area")

// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)   
  document.body.addEventListener(eventName, preventDefaults, false)
})

// Highlight drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
})

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false)

function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

function highlight(e) {
  dropArea.classList.add('highlight')
}

function unhighlight(e) {
  dropArea.classList.remove('active')
}

function handleDrop(e) {
  var dt = e.dataTransfer
  var files = dt.files

  handleFiles(files)
}

let uploadProgress = []
let progressBar = document.getElementById('progress-bar')

function initializeProgress(numFiles) {
  progressBar.value = 0
  uploadProgress = []

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0)
  }
}

function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
  progressBar.value = total
}

function handleFiles(files) {
  files = [...files]
  initializeProgress(files.length)
  files.forEach(uploadFile)
  files.forEach(previewFile)
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = function() {
    let img = document.createElement('img')
    img.src = reader.result
    document.getElementById('gallery').appendChild(img)
  }
}

function uploadFile(file, i) {
  var url = 'https://api.cloudinary.com/v1_1/joezimim007/image/upload'
  var xhr = new XMLHttpRequest()
  var formData = new FormData()
  xhr.open('POST', url, true)
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

  // Update progress (can be used to show progress indicator)
  xhr.upload.addEventListener("progress", function(e) {
    updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
  })

  xhr.addEventListener('readystatechange', function(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
      updateProgress(i, 100) // <- Add this
    }
    else if (xhr.readyState == 4 && xhr.status != 200) {
      // Error. Inform the user
    }
  })

  formData.append('upload_preset', 'ujpu6gyk')
  formData.append('file', file)
  xhr.send(formData)
}
</script>
@endpush