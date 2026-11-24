@extends('templates.index')

@section('content')
<div class="container" style="padding:40px 15px;">
  <div style="max-width:640px;margin:0 auto;background:#fff;color:#333;padding:30px;border-radius:4px;">
    <h3 style="margin-top:0;">Ubah Profil</h3>
    <form action="{{ route('profile.update') }}" method="post">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Umur</label>
        <input type="number" name="umur" value="{{ old('umur', $user->profile->umur ?? '') }}" class="form-control" required>
        @error('umur')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
        @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Bio</label>
        <textarea name="bio" class="form-control" rows="3" required>{{ old('bio', $user->profile->bio ?? '') }}</textarea>
        @error('bio')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <hr>
      <p class="text-muted">Kosongkan jika tidak ingin mengganti password.</p>
      <div class="form-group">
        <label>Password baru</label>
        <input type="password" name="password" class="form-control">
        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Konfirmasi password baru</label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>
      <button type="submit" class="btn btn-warning">Simpan</button>
      <a href="{{ route('profile.show') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
</div>
@endsection
