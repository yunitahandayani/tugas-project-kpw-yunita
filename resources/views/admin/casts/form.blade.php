@extends('admin.layout')
@section('title', $cast->exists ? 'Edit Cast' : 'Tambah Cast')

@section('content')
<div class="panel-box" style="max-width:640px;">
  <h4 style="margin-top:0;">{{ $cast->exists ? 'Edit Cast' : 'Tambah Cast' }}</h4>
  <form action="{{ $cast->exists ? route('admin.casts.update', $cast) : route('admin.casts.store') }}" method="post">
    @csrf
    @if ($cast->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $cast->name) }}" required>
    </div>
    <div class="form-group">
      <label>Umur</label>
      <input type="number" name="age" class="form-control" value="{{ old('age', $cast->age) }}" required>
    </div>
    <div class="form-group">
      <label>Bio</label>
      <textarea name="bio" rows="4" class="form-control" required>{{ old('bio', $cast->bio) }}</textarea>
    </div>
    <button class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
