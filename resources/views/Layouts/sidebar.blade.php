<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Menejemen Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('products.index') }}">
              <i class="bi bi-circle"></i><span>Barang</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.orders') }}">
              <i class="bi bi-circle"></i><span>Pesanan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('users.index') }}">
              <i class="bi bi-circle"></i><span>User</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

    <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="nav-link collapsed" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Logout</span>
        </a>
    </li>

  </ul>
