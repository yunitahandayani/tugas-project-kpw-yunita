@extends('admin.layout')
@section('title', $peran->exists ? 'Edit Peran' : 'Tambah Peran')

@section('content')
<div class="panel-box" style="max-width:640px;">
  <h4 style="margin-top:0;">{{ $peran->exists ? 'Edit Peran' : 'Tambah Peran' }}</h4>
  <form action="{{ $peran->exists ? route('admin.perans.update', $peran) : route('admin.perans.store') }}" method="post">
    @csrf
    @if ($peran->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Film</label>
      <select name="film_id" class="form-control" required>
        <option value="">-- pilih film --</option>
        @foreach ($films as $f)
          <option value="{{ $f->id }}" @selected(old('film_id', $peran->film_id) == $f->id)>{{ $f->title }} ({{ $f->year }}) #{{ $f->id }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Cast</label>
      <select name="cast_id" class="form-control" required>
        <option value="">-- pilih cast --</option>
        @foreach ($casts as $c)
          <option value="{{ $c->id }}" @selected(old('cast_id', $peran->cast_id) == $c->id)>{{ $c->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Nama peran / karakter</label>
      <input type="text" name="actor" class="form-control" value="{{ old('actor', $peran->actor) }}" placeholder="contoh: Raka (Tokoh Utama)" required>
    </div>
    <button class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.perans.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
