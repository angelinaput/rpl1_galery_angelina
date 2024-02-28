<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Galery</title>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/galery" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="btn btn-primary nav-link"><i class="fas fa-upload" data-toggle="modal" data-target="#modalUpload">Upload</i></a>
      </li>
    </ul>

    <div class="modal fade" id="modalUpload" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title">
              <h3>Upload Foto</h3>
            </div>
          </div>
          <form action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control">
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control">
              </div>
              <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" type="submit">Simpan</button>
              <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a href="/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Galery Anda</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Galery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">            
          @foreach ($galery as $galery)
          <div class="col-md-3">
            <!-- The time line -->
            <div class="timeline">  
              <!-- timeline time label -->
              <!-- END timeline item -->
              <!-- timeline time label -->
            
              <!-- /.timeline-label -->


              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item text-center">
                  <h3 class="timeline-header text-center"><a href="#">{{ $galery->judul }}</a></h3>
                  <div class="timeline-body">
                    <img src="{{ asset('images/'.$galery->foto) }}" style=""  width="300" height="200" alt="...">
                    <p>{{ $galery->deskripsi }}</p>
                  </div>
                  <div class="timeline-footer text-center">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdit{{ $galery->id }}">Edit</a>
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalLihat{{ $galery->id }}">See more</a>
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus{{ $galery->id }}">Delete</a>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalLihat{{ $galery->id }}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="text-align: center">
                  <div class="modal-tittle">
                    Diupload tanggal : {{ $galery->tanggal }}
                  </div>
                </div>
                <div class="modal-body text-left">
                  <img src="{{ asset('images/'.$galery->foto) }}" width="450" alt="">
                  <b>Judul :  {{ $galery->judul }}</b>
                  <p>Deskripsi : {{ $galery->deskripsi }}</p>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalEdit{{ $galery->id }}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-tittle">
                    <h3>Edit Foto</h3>
                  </div>
                </div>
                <form action="{{ route('galery.update',$galery->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="judul">Judul</label>
                      <input type="text" value="{{ $galery->judul }}" name="judul" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      <input type="text" value="{{ $galery->deskripsi }}" name="deskripsi" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="foto">Foto</label>
                      <input type="file" value="{{ $galery->foto }}" name="foto" class="form-control">
                      <img src="{{ asset('images/'.$galery->foto) }}" alt="" height="200" class="mt-3">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalHapus{{ $galery->id }}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-tittle">
                    <p>Anda yakin ingin menghapus foto ini?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="{{ url('/galery/hapus/'.$galery->id) }}" class="btn btn-primary btn-sm"> Ya, saya yakin!</a>
                  <a class="btn btn-danger btn-sm" data-dismiss="modal">Batal</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
 
         
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="text-center">
    <div class="float-right d-none d-sm-block mr-5">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">WebGalery.com</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
</body>
</html>
