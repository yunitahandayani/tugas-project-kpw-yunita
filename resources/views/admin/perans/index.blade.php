@extends('admin.layout')
@section('title', 'Data Peran')

@section('content')
<div class="panel-box">
  <div class="clearfix" style="margin-bottom:15px;">
    <h4 class="pull-left" style="margin:6px 0;">Data Peran</h4>
    <a href="{{ route('admin.perans.create') }}" class="btn btn-warning pull-right">+ Tambah Peran</a>
    <form class="form-inline pull-right" style="margin-right:10px;" method="get">
      <select name="film_id" class="form-control" onchange="this.form.submit()">
        <option value="">Semua film</option>
        @foreach ($films as $f)
          <option value="{{ $f->id }}" @selected($filmId == $f->id)>{{ $f->title }} ({{ $f->year }}) #{{ $f->id }}</option>
        @endforeach
      </select>
    </form>
  </div>
  <div class="table-responsive">
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Film</th><th>Cast</th><th>Peran</th><th style="width:150px;">Aksi</th></tr></thead>
    <tbody>
      @forelse ($perans as $peran)
        <tr>
          <td>{{ $peran->id }}</td>
          <td>{{ $peran->film->title ?? '-' }}</td>
          <td>{{ $peran->cast->name ?? '-' }}</td>
          <td>{{ $peran->actor }}</td>
          <td>
            <a href="{{ route('admin.perans.edit', $peran) }}" class="btn btn-xs btn-primary">Edit</a>
            <form action="{{ route('admin.perans.destroy', $peran) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus peran ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-xs btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
  {{ $perans->links() }}
</div>
@endsection
