<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="{{ route('movies') }}" method="get">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari film..." required="">
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register" style="width:auto;">
      <ul>
        @auth
          @if (auth()->user()->isAdmin())
            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
          @endif
          <li><a href="{{ route('profile.show') }}">{{ \Illuminate\Support\Str::limit(auth()->user()->name, 14) }}</a></li>
          <li>
            <form action="{{ route('logout') }}" method="post" style="display:inline;">
              @csrf
              <a href="#" onclick="this.closest('form').submit(); return false;">Logout</a>
            </form>
          </li>
        @else
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
