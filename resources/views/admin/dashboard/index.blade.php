@if(auth()->check())
    <div class="alert alert-success">Halo {{ auth()->user()->name }} Selamat Datang di halaman admin !!</div>
@else
    <div class="alert alert-danger">Anda belum login.</div>
@endif
