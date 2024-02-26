<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-secondary sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <!-- Sidebar -->
  <div class="sidebar">

    <a href="index3.html" class="brand-link">
      <!--img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"!-->
      <p class=text-white>KASIR TOKO AT</p>
    </a>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!-- @if(auth()->check())     -->
      
      <div class="info">
        <a href="#" class="d-block"></a>
      </div>
      <!-- @endif -->
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              <p class=text-white>dashboard</p>
            </p>
          </a>
        </li>

        @if(auth()->user()->role!="admin")
        <li class="nav-item">
          <a href="/kasir/transaksi" class="nav-link  {{ Request::is('admin/transaksi*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              <p class=text-white>Transaksi</p>
            </p>
          </a>
        </li>
        @endif


        @if(auth()->user()->role!="pengguna")
        <li class="nav-item">
          <a href="/admin/produk" class="nav-link  {{ Request::is('admin/produk*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              <p class=text-white>Produk</p>
            </p>
          </a>
        </li>
        @endif
        
        @if(auth()->user()->role!="pengguna")
        <li class="nav-item">
          <a href="/admin/kategori" class="nav-link  {{ Request::is('admin/kategori*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              <p class=text-white>Kategori</p>
            </p>
          </a>
        </li>
        @endif
        @if(auth()->user()->role!="pengguna")
        <li class="nav-item">
          <a href="/admin/user" class="nav-link  {{ Request::is('admin/user*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              <p class=text-white>User</p>
            </p>
          </a>
        </li>
        @endif

        @if(auth()->user()->role!="pengguna")
        <li class="nav-item">
          <a href="/admin/riwayat" class="nav-link  {{ Request::is('admin/riwayat*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-frog"></i>
            <p>
              <p class=text-white>Riwayat</p>
            </p>
          </a>
        </li>
        @endif



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="content-wrapper">