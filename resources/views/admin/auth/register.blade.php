<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/vendor/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/vendor/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/vendor/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ route('login') }}" class="h3"><b>Kasir</b>AT</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registrasi Dulu</p>

      @if (session()->has('loginError'))
      <div class="alert alert-danger">{{ session('loginError') }}</div>
      @endif
      
      <form action="{{ route('register-proses') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('nama') is-invalid @enderror"  name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror                           
        </div>

        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" placeholder="Email" value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
              @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror                   
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Konfirmasi Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
              @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
        </div>
  

        <button type="submit" class="btn btn-primary btn-block">Login</button>

      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/vendor/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/vendor/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/vendor/admin/dist/js/adminlte.min.js"></script>
</body>
</html>