<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
  <link href="{{ asset('template/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('template/css/font-awesome.min.css') }}" rel="stylesheet">
  <style>
    body { background:#f4f5f7; color:#333; padding-top:70px; }
    .navbar-inverse { background:#212121; border-color:#111; }
    .navbar-inverse .navbar-brand, .navbar-inverse .navbar-nav>li>a { color:#ddd; }
    .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>.active>a { background:#FF8D1B; color:#fff; }
    .panel-box { background:#fff; padding:22px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.1); }
    .poster-thumb { width:50px; height:70px; object-fit:cover; border-radius:2px; }
    .stat { background:#fff; padding:20px; border-radius:4px; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,.1); margin-bottom:20px; }
    .stat h2 { margin:0; color:#FF8D1B; }
    .table > tbody > tr > td { vertical-align:middle; }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-nav">
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">One<span style="color:#FF8D1B;">Movies</span> Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="admin-nav">
      <ul class="nav navbar-nav">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="{{ request()->routeIs('admin.films.*') ? 'active' : '' }}"><a href="{{ route('admin.films.index') }}">Film</a></li>
        <li class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}"><a href="{{ route('admin.casts.index') }}">Cast</a></li>
        <li class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}"><a href="{{ route('admin.genres.index') }}">Genre</a></li>
        <li class="{{ request()->routeIs('admin.perans.*') ? 'active' : '' }}"><a href="{{ route('admin.perans.index') }}">Peran</a></li>
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">Data User</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('home') }}" target="_blank">Lihat Website</a></li>
        <li><a href="{{ route('profile.show') }}">{{ auth()->user()->name }}</a></li>
        <li>
          <form action="{{ route('logout') }}" method="post" style="display:inline;">
            @csrf
            <a href="#" onclick="this.closest('form').submit(); return false;">Logout</a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0;padding-left:18px;">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif
  @yield('content')
</div>

<script src="{{ asset('template/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
</body>
</html>
