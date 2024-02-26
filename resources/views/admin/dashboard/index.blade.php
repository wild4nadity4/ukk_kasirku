@if(auth()->check())
    <div class="alert alert-success">Dashboard </div>
@else
    <div class="alert alert-danger">Anda belum login.</div>
@endif
@php
$totalUsers = App\Models\User::count();
 $totalProduk = App\Models\Produk::count();
$totalKategori = App\Models\Kategori::count();

$totalPenjualan = App\Models\Transaksi::count();
@endphp
<div class="row">
<div class="col-12 col-sm-6 col-md-3">
<div class="info-box">
<span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text">User</span>
<span class="info-box-number">
{{$totalUsers}}
<small></small>
</span>
</div>

</div>

</div>

<div class="col-12 col-sm-6 col-md-3">
<div class="info-box mb-3">
<span class="info-box-icon bg-danger elevation-1"><i class="nav-icon fas fa-list"></i></span>
<div class="info-box-content">
<span class="info-box-text">kategori</span>
<span class="info-box-number">{{$totalKategori}}</span>
</div>

</div>

</div>


<div class="clearfix hidden-md-up"></div>
<div class="col-12 col-sm-6 col-md-3">
<div class="info-box mb-3">
<span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa-table"></i></span>
<div class="info-box-content">
<span class="info-box-text">produk</span>
<span class="info-box-number">{{$totalProduk}}</span>
</div>

</div>

</div>

<div class="col-12 col-sm-6 col-md-3">
<div class="info-box mb-3">
<span class="info-box-icon bg-warning elevation-1"><i class="nav-icon fas fa-exchange-alt"></i></span>
<div class="info-box-content">
<span class="info-box-text">transaksi</span>
<span class="info-box-number">{{$totalPenjualan}}</span>
</div>

</div>

</div>

</div>
