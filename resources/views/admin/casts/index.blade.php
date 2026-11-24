@extends('admin.layout')
@section('title', 'Data Cast')

@section('content')
<div class="panel-box">
  <div class="clearfix" style="margin-bottom:15px;">
    <h4 class="pull-left" style="margin:6px 0;">Data Cast</h4>
    <a href="{{ route('admin.casts.create') }}" class="btn btn-warning pull-right">+ Tambah Cast</a>
    <form class="form-inline pull-right" style="margin-right:10px;" method="get">
      <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama...">
      <button class="btn btn-default">Cari</button>
    </form>
  </div>
  <div class="table-responsive">
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Nama</th><th>Umur</th><th>Bio</th><th>Peran</th><th style="width:150px;">Aksi</th></tr></thead>
    <tbody>
      @forelse ($casts as $cast)
        <tr>
          <td>{{ $cast->id }}</td>
          <td>{{ $cast->name }}</td>
          <td>{{ $cast->age }}</td>
          <td>{{ \Illuminate\Support\Str::limit($cast->bio, 70) }}</td>
          <td>{{ $cast->perans_count }}</td>
          <td>
            <a href="{{ route('admin.casts.edit', $cast) }}" class="btn btn-xs btn-primary">Edit</a>
            <form action="{{ route('admin.casts.destroy', $cast) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus cast ini beserta perannya?')">
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
  {{ $casts->links() }}
</div>
@endsection
