<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Home</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('pesananku') }}">
            <i class="bi bi-journal-text"></i>
            <span>Pesanan Saya</span>
        </a>
    </li><!-- End Dashboard Nav -->

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
