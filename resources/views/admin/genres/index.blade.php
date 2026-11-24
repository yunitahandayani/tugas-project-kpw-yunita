@extends('admin.layout')
@section('title', 'Data Genre')

@section('content')
<div class="panel-box">
  <div class="clearfix" style="margin-bottom:15px;">
    <h4 class="pull-left" style="margin:6px 0;">Data Genre</h4>
    <a href="{{ route('admin.genres.create') }}" class="btn btn-warning pull-right">+ Tambah Genre</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Nama</th><th>Jumlah Film</th><th style="width:150px;">Aksi</th></tr></thead>
    <tbody>
      @forelse ($genres as $genre)
        <tr>
          <td>{{ $genre->id }}</td>
          <td>{{ $genre->name }}</td>
          <td>{{ $genre->films_count }}</td>
          <td>
            <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-xs btn-primary">Edit</a>
            <form action="{{ route('admin.genres.destroy', $genre) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus genre ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-xs btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  {{ $genres->links() }}
</div>
@endsection
