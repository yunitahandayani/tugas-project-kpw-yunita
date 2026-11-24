@extends('admin.layout')
@section('title', 'Data User')

@section('content')
<div class="panel-box">
  <div class="clearfix" style="margin-bottom:15px;">
    <h4 class="pull-left" style="margin:6px 0;">Data User <small>(hanya lihat)</small></h4>
    <form class="form-inline pull-right" method="get">
      <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama/email...">
      <button class="btn btn-default">Cari</button>
    </form>
  </div>
  <div class="table-responsive">
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Umur</th><th>Alamat</th><th>Komentar</th><th>Terdaftar</th></tr></thead>
    <tbody>
      @forelse ($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td><span class="label {{ $u->isAdmin() ? 'label-danger' : 'label-default' }}">{{ $u->role->name ?? '-' }}</span></td>
          <td>{{ $u->profile->umur ?? '-' }}</td>
          <td>{{ \Illuminate\Support\Str::limit($u->profile->alamat ?? '-', 40) }}</td>
          <td>{{ $u->kritiks_count }}</td>
          <td>{{ $u->created_at?->format('d M Y') }}</td>
        </tr>
      @empty
        <tr><td colspan="8" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
  {{ $users->links() }}
</div>
@endsection
