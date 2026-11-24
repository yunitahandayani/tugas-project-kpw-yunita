@extends('templates.index')

@section('content')
<div class="container" style="padding:40px 15px;">
  <div style="max-width:460px;margin:0 auto;background:#fff;color:#333;padding:30px;border-radius:4px;">
    <h3 style="margin-top:0;">Login</h3>
    <form action="{{ route('login.attempt') }}" method="post">
      @csrf
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="checkbox"><label><input type="checkbox" name="remember" value="1"> Ingat saya</label></div>
      <button type="submit" class="btn btn-warning btn-block">Login</button>
    </form>
    <p style="margin-top:15px;">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    <hr>
    <small class="text-muted">
      Demo user: user@example.com / 12345678<br>
      Demo admin: admin@example.com / 12345678
    </small>
  </div>
</div>
@endsection
