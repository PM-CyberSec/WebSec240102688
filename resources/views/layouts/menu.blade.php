<nav class="navbar navbar-expand-sm navbar-future fixed-top">
  <div class="container-fluid">
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/even">Even Numbers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/prime">Prime Numbers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/multable">Multiplication Table</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
      </li>
      @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.create') }}">Add product</a>
        </li>
      @endauth
    </ul>
    <ul class="navbar-nav ms-auto">
      @auth
        <li class="nav-item d-flex align-items-center">
          <span class="nav-link py-0">{{ auth()->user()->name }}</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('do_logout') }}">Logout</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      @endauth
      
    </ul>
  </div>
</nav>