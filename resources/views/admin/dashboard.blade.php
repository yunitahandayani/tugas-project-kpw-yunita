@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<h3>Dashboard Administrator</h3>
<div class="row" style="margin-top:20px;">
  @foreach ($stats as $label => $total)
    <div class="col-sm-4 col-md-2">
      <div class="stat"><h2>{{ $total }}</h2><div>{{ $label }}</div></div>
    </div>
  @endforeach
</div>

<div class="panel-box">
  <div class="clearfix" style="margin-bottom:10px;">
    <h4 class="pull-left" style="margin:6px 0;">Film terbaru</h4>
    <a href="{{ route('admin.films.create') }}" class="btn btn-warning pull-right">+ Tambah Film</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th>Poster</th><th>Judul</th><th>Genre</th><th>Tahun</th></tr></thead>
    <tbody>
      @foreach ($filmTerbaru as $f)
        <tr>
          <td><img class="poster-thumb" src="{{ asset($f->poster) }}" alt=""></td>
          <td>{{ $f->title }}</td><td>{{ $f->genre->name ?? '-' }}</td><td>{{ $f->year }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
