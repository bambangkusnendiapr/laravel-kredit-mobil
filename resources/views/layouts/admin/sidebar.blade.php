<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <!-- <img src="{{ asset('img/logo.png') }}" alt="Barbershop Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Kredit Mobil</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!-- <div class="image">
        <img src="{{ asset('img/bukti_transfer/bukti.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div> -->
      <div class="info">
        <div class="nav-item">
          @role('superadmin')
            <a href="#" class="d-inline">{{ Auth::user()->name }}</a> &nbsp;
          @endrole
          @role('sales')
            <a href="#" class="d-inline">{{ Auth::user()->name }}</a> &nbsp;
          @endrole
          <span class="right badge badge-primary">{{ Auth::user()->roles->first()->display_name  }}</span>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('bank') }}" class="nav-link @yield('bank')">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Bank
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('mobils.index') }}" class="nav-link @yield('mobil')">
            <i class="nav-icon fas fa-car"></i>
            <p>
              Mobil
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ route('mobil') }}" class="nav-link @yield('mobil')">
            <i class="nav-icon fas fa-car"></i>
            <p>
              Mobil
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="{{ route('car') }}" class="nav-link @yield('car')">
            <i class="nav-icon fas fa-car"></i>
            <p>
              Mobil
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{ route('buyer') }}" class="nav-link @yield('buyer')">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Pembeli
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('beli') }}" class="nav-link @yield('beli')">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Beli Mobil
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ route('order') }}" class="nav-link @yield('order')">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Order
            </p>
          </a>
        </li> -->
        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>