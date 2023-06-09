<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light">LSP APP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('assets/dashboard/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @switch(Auth::user()->role)
            @case('asesi')
              {{Auth::user()->asesi->name}}
            @break
            @case('asesor')
              {{Auth::user()->asesor->name}}
            @break
            @case('ms')
              Management Sertifikasi
            @break
            @default
              Admin
          @endswitch
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-sidebar" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @userRole(admin)
        <li class="nav-item">
          <a href="{{url('/skema')}}" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Skema
            </p>
          </a>
        </li>
        @endUserRole
        @if(in_array(Auth::user()->role, ['admin', 'ms', 'asesor']) || isValidAsesi())
        <li class="nav-item">
          <a href="{{url('/event')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Event
            </p>
          </a>
        </li>
        @endUserRole
        @userRole(asesi)
        <li class="nav-item">
          <a href="{{url('/asesi/sertifikat')}}" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Sertifikat
            </p>
          </a>
        </li>
        @endUserRole
        @userRole(admin)
        <li class="nav-item">
          <a href="{{url('/asesor')}}" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Asesor Management
            </p>
          </a>
        </li>
        @endUserRole
        @userRole(admin)
        <li class="nav-item">
          <a href="{{url('/user-management')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User Management
            </p>
          </a>
        </li>
        @endUserRole
        @if(isValidAsesi())
        <li class="nav-item">
          <a href="{{url('/asesi/profile')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        @endif
        @userRole(admin)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-table nav-icon"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/prodi-management')}}" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>Jurusan</p>
              </a>
            </li>
        </li>
        @endUserRole
      </ul>
    </nav>
    <div class="p-3 mt-5">
      <a href="{{url('/logout')}}" class="btn btn-block btn-primary">Logout</a >
    </div>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
