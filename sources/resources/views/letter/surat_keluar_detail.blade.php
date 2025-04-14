@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  @include('layouts.topbar')
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container" id="app">
    <div class="card card-body">
      <form class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>No. Agenda</label>
            <input type="text" class="form-control border-left-primary" name="no_agenda" value="{{$data['item']->no_agenda}}" disabled>
          </div>
          <div class="form-group">
            <label>Tujuan Kirim</label>
            <input type="text" class="form-control border-left-primary" name="pengirim" value="{{$data['item']->pengirim}}" disabled>
          </div>
          <div class="form-group">
            <label>No. Surat</label>
            <input type="text" class="form-control border-left-primary" name="no_surat" value="{{$data['item']->no_surat}}" disabled>
          </div>
          <div class="form-group">
            <label>Perihal</label>
            <textarea class="form-control border-left-primary" name="notes" id="" cols="30" rows="2" disabled>{{$data['item']->notes}}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Surat</label>
            <input class="form-control border-left-primary" name="tgl_surat" value="{{date('Y-m-d', strtotime($data['item']->tgl_surat))}}" disabled>
          </div>
          <!-- <div class="form-group">
            <label>Tanggal Diterima</label>
            <input class="form-control border-left-primary" name="tgl_dikirim" value="{{date('Y-m-d', strtotime($data['item']->tgl_dikirim))}}" disabled>
          </div> -->
          <div class="form-group">
            <label>Document</label>
          </div>
          @foreach($data['item']->document as $document)
          <div class="input-group mb-3">
            <input type="text" class="form-control border-left-primary" value="{{$document->document}}" disabled>
            <div class="input-group-append">
              <a href="{{url('document/'.$document->document)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i> Lihat</a>
              <a href="{{asset('assets/document/'.$document->document)}}" class="btn btn-outline-success" download> <i class="fas fa-arrow-down"></i> Download</a>
            </div>
          </div>
          @endforeach
        </div>
        <div class="button-footer ml-3">
          <a href="{{url('surat-keluar')}}" class="btn btn-success">Back</a>
        </div>
      </form>
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