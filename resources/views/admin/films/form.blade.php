@extends('admin.layout')
@section('title', $film->exists ? 'Edit Film' : 'Tambah Film')

@section('content')
<div class="panel-box">
  <h4 style="margin-top:0;">{{ $film->exists ? 'Edit Film' : 'Tambah Film' }}</h4>
  <form action="{{ $film->exists ? route('admin.films.update', $film) : route('admin.films.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($film->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Judul</label>
      <input type="text" name="title" class="form-control" value="{{ old('title', $film->title) }}" required>
    </div>
    <div class="row">
      <div class="col-sm-6 form-group">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $film->year ?? now()->year) }}" required>
      </div>
      <div class="col-sm-6 form-group">
        <label>Genre</label>
        <select name="genre_id" class="form-control" required>
          <option value="">-- pilih genre --</option>
          @foreach ($genres as $g)
            <option value="{{ $g->id }}" @selected(old('genre_id', $film->genre_id) == $g->id)>{{ $g->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label>Sinopsis</label>
      <textarea name="sinopsis" rows="5" class="form-control" required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
    </div>
    <div class="form-group">
      <label>Poster {{ $film->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
      @if ($film->exists && $film->poster)
        <div><img src="{{ asset($film->poster) }}" alt="" style="height:120px;margin-bottom:8px;"></div>
      @endif
      <input type="file" name="poster" accept="image/*" {{ $film->exists ? '' : 'required' }}>
      <p class="help-block">JPG/PNG/WEBP, maksimal 2 MB.</p>
    </div>
    <button class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
