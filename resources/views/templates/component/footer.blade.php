<div class="footer">
  <div class="container">
    <div class="w3ls_footer_grid">
      <div class="col-md-6 w3ls_footer_grid_left">
        <div class="w3ls_footer_grid_left1">
          <h2>Temukan film favoritmu</h2>
          <p style="color:#999;">Login untuk memberi komentar dan rating pada film.</p>
        </div>
      </div>
      <div class="col-md-6 w3ls_footer_grid_right">
        <a href="{{ route('home') }}"><h2>One<span>Movies</span></h2></a>
      </div>
      <div class="clearfix"> </div>
    </div>
    <div class="col-md-5 w3ls_footer_grid1_left">
      <p>&copy; {{ date('Y') }} One Movies. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
    <div class="col-md-7 w3ls_footer_grid1_right">
      <ul>
        <li><a href="{{ route('movies') }}">Movies</a></li>
        <li><a href="{{ route('genre', 1) }}">Action</a></li>
        <li><a href="{{ route('genre', 9) }}">Adventure</a></li>
        <li><a href="{{ route('genre', 10) }}">Comedy</a></li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>