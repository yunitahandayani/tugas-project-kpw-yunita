@extends('templates.index')

@section('content')
<div class="container" style="padding:40px 15px;">
  <div style="max-width:460px;margin:0 auto;background:#fff;color:#333;padding:30px;border-radius:4px;">
    <h3 style="margin-top:0;">Daftar Akun</h3>
    <form action="{{ route('register.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Password (min. 8 karakter)</label>
        <input type="password" name="password" class="form-control" required>
        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning btn-block">Daftar</button>
    </form>
    <p style="margin-top:15px;">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
  </div>
</div>
@endsection
