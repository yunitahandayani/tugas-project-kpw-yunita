@extends('templates.index')

@section('content')
<div class="container" style="padding:40px 15px;">
  <div style="max-width:640px;margin:0 auto;background:#fff;color:#333;padding:30px;border-radius:4px;">
    <h3 style="margin-top:0;">Profil Saya</h3>
    <table class="table">
      <tr><th style="width:160px;">Nama</th><td>{{ $user->name }}</td></tr>
      <tr><th>Email</th><td>{{ $user->email }}</td></tr>
      <tr><th>Role</th><td>{{ ucfirst($user->role->name ?? '-') }}</td></tr>
      <tr><th>Umur</th><td>{{ $user->profile->umur ?? '-' }} tahun</td></tr>
      <tr><th>Alamat</th><td>{{ $user->profile->alamat ?? '-' }}</td></tr>
      <tr><th>Bio</th><td>{{ $user->profile->bio ?? '-' }}</td></tr>
      @unless ($user->isAdmin())
        <tr><th>Komentar ditulis</th><td>{{ $jumlahKritik }}</td></tr>
      @endunless
    </table>
    <a href="{{ route('profile.edit') }}" class="btn btn-warning">Ubah Profil</a>
    <a href="{{ route('home') }}" class="btn btn-default">Kembali</a>
  </div>
</div>
@endsection
