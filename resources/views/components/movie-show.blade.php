@extends('templates.index')

@push('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('template/list-css/table-style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('template/list-css/basictable.css') }}" />
@endpush

@push('scripts')

<script type="text/javascript" src="{{ asset('template/list-js/jquery.basictable.min.js') }}"></script>
 <script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
      $('#table-breakpoint').basictable({
        breakpoint: 768
      });
    });
  </script>
@endpush

@section('content')

<div class="container">
  <br />
  <!-- /w3l-medile-movies-grids -->
    <div class="agileits-single-top">
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('movies') }}">Movies</a></li>
        <li class="active">{{ $film->title }}</li>
      </ol>
    </div>
    <div class="single-page-agile-info">
                 <!-- /movie-browse-agile -->
                         <div class="show-top-grids-w3lagile">
      <div class="col-sm-8 single-left">
        <div class="song">
          <div class="single-right-grids">

            <div class="col-md-4 single-right-grid-left">
              <a href="{{ route('movies.show', $film->id) }}"><img src="{{ asset($film->poster) }}" alt="{{ $film->title }}" /></a>
            </div>
            <div class="col-md-8 single-right-grid-right">
              <div class="song-info">
                <h2>{{ $film->title }}</h2>	
                <p class="author"><a href="{{ route('genre', $film->genre_id) }}" class="author">{{ $film->genre->name ?? '' }}</a> &middot; {{ $film->year }}</p>
                <div class="block-stars" style="margin:8px 0;">
                  @include('partials.stars', ['rating' => $film->kritiks_avg_rating])
                  <span style="color:#999;">{{ number_format($film->kritiks_avg_rating ?? 0, 1) }}/5 ({{ $film->kritiks_count }} komentar)</span>
                </div>
                <p class="views">{{ $film->sinopsis }}</p>
              </div>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  <div class="agile-news-table">
                    <table id="table-breakpoint">
                      <thead>
                        <tr>
                        <th>Cast</th>
                        <th>Peran</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($perans as $peran)
                        <tr>
                          <td class="w3-list-info">{{ $peran->cast->name ?? '-' }}</td>
                          <td class="w3-list-info">{{ $peran->actor }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
        <div class="song-grid-right">
          <div class="share">
            <h5>Share this</h5>
            <div class="single-agile-shar-buttons">
            <ul>
              <li>
                <div class="fb-like" data-href="https://www.facebook.com/w3layouts" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
              </li>
              <li>
                <div class="fb-share-button" data-href="https://www.facebook.com/w3layouts" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fw3layouts&amp;src=sdkpreparse">Share</a></div>
              </li>
              <li class="news-twitter">
                <a href="https://twitter.com/w3layouts" class="twitter-follow-button" data-show-count="false">Follow @w3layouts</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
              </li>
              <li>
                <a href="https://twitter.com/intent/tweet?screen_name=w3layouts" class="twitter-mention-button" data-show-count="false">Tweet to @w3layouts</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
              </li>
              <li>
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="medium"></div>

                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                  (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/platform.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
              </li>
            </ul>
          </div>
          </div>
        </div>
        <div class="clearfix"> </div>
        <div class="all-comments" id="komentar">
          <div class="all-comments-info">
            <a href="#komentar">Komentar &amp; Kritik</a>
            <div class="agile-info-wthree-box">
              @guest
                <p style="color:#ccc;">Silakan <a href="{{ route('login') }}" style="color:#FF8D1B;">login</a> atau <a href="{{ route('register') }}" style="color:#FF8D1B;">daftar</a> untuk memberikan komentar.</p>
              @else
                @if (auth()->user()->isAdmin())
                  <p style="color:#ccc;">Administrator tidak bisa memberikan komentar pada film.</p>
                @else
                  <form action="{{ route('kritik.store', $film) }}" method="post">
                    @csrf
                    <select name="rating" required style="width:100%;padding:10px;margin-bottom:10px;">
                      <option value="">Pilih rating</option>
                      @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating') == $i)>{{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }} ({{ $i }})</option>
                      @endfor
                    </select>
                    <textarea name="comment" placeholder="Tulis komentar/kritik kamu untuk film ini..." required>{{ old('comment') }}</textarea>
                    @if ($errors->any())
                      <div class="alert alert-danger" style="margin-top:10px;">
                        @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                      </div>
                    @endif
                    <input type="submit" value="KIRIM">
                    <div class="clearfix"> </div>
                  </form>
                @endif
              @endguest
            </div>
          </div>
          <div class="media-grids">
            @forelse ($comments as $comment)
              <div class="media">
                <h5>{{ $comment->user->name ?? 'Pengguna' }}
                  <small style="color:#999;">&middot; {{ $comment->created_at?->diffForHumans() }}</small>
                </h5>
                <div class="media-left">
                  <a href="#">
                    <img src="{{ asset('template/images/user.jpg') }}" title="{{ $comment->user->name ?? '' }}" alt=" " />
                  </a>
                </div>
                <div class="media-body">
                  <div class="block-stars">@include('partials.stars', ['rating' => $comment->rating])</div>
                  <p>{{ $comment->comment }}</p>
                  @auth
                    @if ((int) $comment->user_id === (int) auth()->id())
                      <form action="{{ route('kritik.destroy', $comment) }}" method="post" onsubmit="return confirm('Hapus komentar ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-danger">Hapus</button>
                      </form>
                    @endif
                  @endauth
                </div>
              </div>
            @empty
              <p style="color:#999;">Belum ada komentar. Jadilah yang pertama!</p>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-md-4 single-right">
        <h3>Similar Film By Genre</h3>
        @foreach ($filmByGenre as $similar)
          <div class="single-grid-right">
            <div class="single-right-grids">
              <div class="col-md-4 single-right-grid-left">
                <a href="{{ route('movies.show', $similar->id) }}"><img src="{{ asset($similar->poster) }}" alt="{{ $similar->title }}" /></a>
              </div>
              <div class="col-md-8 single-right-grid-right">
                <a href="{{ route('movies.show', $similar->id) }}" class="title">{{ $similar->title }}</a>
                <p class="author"><a href="#" class="author">{{ $similar->year }}</a></p>
                <p class="views" style="text-align: justify; margin-right: 10px">{{ $similar->sinopsis }}</p>
              </div>
              <div class="clearfix"> </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="clearfix"> </div>
    </div>
      <!-- //movie-browse-agile -->
      <!--body wrapper start-->
    <div class="w3_agile_banner_bottom_grid">
      <div id="owl-demo" class="owl-carousel owl-theme">
        @foreach ($filmByRelease as $filmRelease)
          <div class="item">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
              <a href="{{ route('movies.show', $filmRelease->id) }}" class="hvr-shutter-out-horizontal"><img src="{{ asset($filmRelease->poster) }}" title="{{ $filmRelease->title }}" class="img-responsive" alt=" " />
                <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
              </a>
              <div class="mid-1 agileits_w3layouts_mid_1_home">
                <div class="w3l-movie-text">
                  <h6><a href="{{ route('movies.show', $filmRelease->id) }}">{{ $filmRelease->title }}</a></h6>							
                </div>
                <div class="mid-2 agile_mid_2_home">
                  <p>{{ $filmRelease->year }}</p>
                  <div class="block-stars">
                    @include('partials.stars', ['rating' => $filmRelease->kritiks_avg_rating])
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              @if ($filmRelease->year == now()->year)
                <div class="ribben">
                  <p>NEW</p>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  <!--body wrapper end-->
          
             
      </div>
      <!-- //w3l-latest-movies-grids -->
    </div>	
  </div>
@endsection

