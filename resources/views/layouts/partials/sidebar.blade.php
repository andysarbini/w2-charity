<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      {{-- <img src="{{ Storage::disk('public')->url($setting->path_image ?? '') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8"> --}}
      <img src="{{ url($setting->path_image ?? '') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $setting->company_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- @if (Storage::disk('public')->url(auth()->user()->path_image))               --}}
          @if (Storage::disk('public')->exists(auth()->user()->path_image))              
            <img src="{{ Storage::disk('public')->url(auth()->user()->path_image ?? '') }}" class="img-circle elevation-2" alt="">
          @else
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Standing_jaguar.jpg" alt="" class="img-circle elevation-2">
          @endif
        </div>
        <div class="info">
          <a href="{{ route('profile.show') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard                
              </p>
            </a>            
          </li>

          @if (auth()->user()->hasRole('admin'))
              <li class="nav-header">MASTER</li>
                  <li class="nav-item">
                    <a href="{{ route('category.index')}}" class="nav-link {{ request()->is('admin/category*') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-cube"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
          @else
              <li class="nav-header">MASTER</li>
          @endif
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('donatur'))
                  <li class="nav-item">
                    <a href="{{ route('campaigns.index') }}" class="nav-link {{ request()->is('admin/campaign*') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-th"></i>
                      <p>Project</p>
                    </a>
                  </li>
                  
                
            @endif
              <li class="nav-header">REFERENSI</li>
              @if (auth()->user()->hasRole('admin'))
                <li class="nav-item">
                  <a href="{{ route('donatur.index') }}" class="nav-link {{ request()->is('admin/donatur*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Donatur                   
                    </p>
                  </a>
                </li>
              @endif
              <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                  <i class="nav-icon fas fa-donate"></i>
                  <p>
                    Daftar Donasi                
                  </p>
                </a>
              </li>

          @if (auth()->user()->hasRole('admin'))
            <li class="nav-header">INFORMASI</li>
            <li class="nav-item">
              <a href="{{ route('contact.index') }}" class="nav-link {{ request()->is('admin/contact*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Kontak Masuk               
                </p>
              </a>
            </li>                 
            <li class="nav-item">
              <a href="{{ route('subscriber.index') }}" class="nav-link {{ request()->is('admin/subscriber*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Subscriber                
                </p>
              </a>
            </li>
          @endif
          
          @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('donatur'))
              <li class="nav-header">REPORT</li>
              <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    Laporan              
                  </p>
                </a>
              </li>
          @endif

          @if (auth()->user()->hasRole('donatur'))
              <li class="nav-header">AKTIVITAS</li>
              <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>
                    Log Aktivitas              
                  </p>
                </a>
              </li>
          @endif

          @if (auth()->user()->hasRole('admin'))
          <li class="nav-header">PENGATURAN</li>
            <li class="nav-item">
              <a href="{{ route('setting.index') }}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Setting               
                </p>
              </a>
            </li>
          @endif

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p></p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>