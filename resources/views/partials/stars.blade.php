@php $r = (float) ($rating ?? 0); @endphp
<ul class="w3l-ratings">
  @for ($i = 1; $i <= 5; $i++)
    <li><a href="#"><i class="fa {{ $r >= $i ? 'fa-star' : ($r >= $i - 0.5 ? 'fa-star-half-o' : 'fa-star-o') }}" aria-hidden="true"></i></a></li>
  @endfor
</ul>
