<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/css/adminlte.min.css')}}">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>LSP</b></a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register sebagai asesi</p>

        <form action="{{url('/signup')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Full name"  value="{{ old('name') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('name')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" placeholder="NIM" value="{{ old('nim') }}">
            <div class="input-group-append">
              <div class="input-group-text">
              <i class="fas fa-id-card"></i>
              </div>
            </div>
            @error('nim')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <select name="prodi" class="custom-select @error('prodi') is-invalid @enderror">
              <option selected disabled>Pilih prodi</option>
              @foreach($prodis as $prodi)
              <option value="{{$prodi->id}}">{{$prodi->name}}</option>
              @endforeach
            </select>
            @error('prodi')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="cpassword" class="form-control @error('cpassword') is-invalid @enderror" placeholder="Retype password" value="{{ old('cpassword') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('cpassword')
            <span class="invalid-feedback">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <a href="{{url('/login')}}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/dashboard/js/adminlte.min.js')}}"></script>
</body>

</html>