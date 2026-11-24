@extends('admin.layout')
@section('title', 'Data Film')

@section('content')
<div class="panel-box">
  <div class="clearfix" style="margin-bottom:15px;">
    <h4 class="pull-left" style="margin:6px 0;">Data Film</h4>
    <a href="{{ route('admin.films.create') }}" class="btn btn-warning pull-right">+ Tambah Film</a>
    <form class="form-inline pull-right" style="margin-right:10px;" method="get">
      <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari judul...">
      <button class="btn btn-default">Cari</button>
    </form>
  </div>
  <div class="table-responsive">
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Poster</th><th>Judul</th><th>Genre</th><th>Tahun</th><th style="width:150px;">Aksi</th></tr></thead>
    <tbody>
      @forelse ($films as $film)
        <tr>
          <td>{{ $film->id }}</td>
          <td><img class="poster-thumb" src="{{ asset($film->poster) }}" alt=""></td>
          <td>{{ $film->title }}</td>
          <td>{{ $film->genre->name ?? '-' }}</td>
          <td>{{ $film->year }}</td>
          <td>
            <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-xs btn-primary">Edit</a>
            <form action="{{ route('admin.films.destroy', $film) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus film ini beserta peran & komentarnya?')">
              @csrf @method('DELETE')
              <button class="btn btn-xs btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
  {{ $films->links() }}
</div>
@endsection
