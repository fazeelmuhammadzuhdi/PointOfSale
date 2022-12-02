 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     {{-- <a href="{{ asset('/') }}index3.html" class="brand-link">
                <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a> --}}
     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ Auth::user()->name }}</a>
             </div>
         </div>



         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <a href="{{ route('dashboard-statistik') }}" class="nav-link">
                     <i class="fas fa-tachometer-alt text-white"></i>
                     <p>
                         Dashboard
                     </p>
                 </a>
                 <li class="nav-item">

                     <a href="#" class="nav-link">
                         <i class="fa fa-home text-green"></i>
                         <p>
                             Data Master
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('kategori.index') }}" class="nav-link">

                                 <i class="fa fa-cube" aria-hidden="true"></i>
                                 <p>Kategori</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-cubes" aria-hidden="true"></i>
                                 <p>Product</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-id-card" aria-hidden="true"></i>
                                 <p>Member</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-truck" aria-hidden="true"></i>
                                 <p>Supplier</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-hand-holding text-warning"></i>
                         <p>
                             Transaction
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fas fa-money-bill"></i>
                                 <p>Pengeluaran</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-download" aria-hidden="true"></i>
                                 <p>Pembelian</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-upload" aria-hidden="true"></i>
                                 <p>Penjualan</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fas fa-chart-bar"></i>
                                 <p>Transaksi Lama</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fas fa-chart-pie"></i>
                                 <p>Transaksi Baru</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fa fa-book text-blue" aria-hidden="true"></i>
                         <p>
                             Report
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fas fa-book-open"></i>
                                 <p>Laporan</p>
                             </a>
                         </li>

                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fa fa-step-backward text-purple" aria-hidden="true"></i>
                         <p>
                             System
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-cogs" aria-hidden="true"></i>
                                 <p>Pengaturan</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="fa fa-user-circle" aria-hidden="true"></i>
                                 <p>Users</p>
                             </a>
                         </li>

                     </ul>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
