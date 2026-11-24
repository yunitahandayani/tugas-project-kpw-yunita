@extends('admin.layout')
@section('title', $genre->exists ? 'Edit Genre' : 'Tambah Genre')

@section('content')
<div class="panel-box" style="max-width:520px;">
  <h4 style="margin-top:0;">{{ $genre->exists ? 'Edit Genre' : 'Tambah Genre' }}</h4>
  <form action="{{ $genre->exists ? route('admin.genres.update', $genre) : route('admin.genres.store') }}" method="post">
    @csrf
    @if ($genre->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Nama genre</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $genre->name) }}" required>
    </div>
    <button class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
