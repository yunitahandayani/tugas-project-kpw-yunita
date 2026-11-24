<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\Peran;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Bagian publik: dashboard (home) dan list film yang bisa dilihat semua user.
 */
class FilmController extends Controller
{
    public function movies(Request $request)
    {
        $genreFilm = null;
        $search = trim((string) $request->query('q', ''));

        $films = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->when($search !== '', fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderByDesc('year')
            ->orderBy('created_at', 'asc')
            ->paginate(18)
            ->withQueryString();

        return view('components.movies', compact('films', 'genreFilm', 'search'));
    }

    public function show(Film $film)
    {
        $film->load('genre');
        $film->loadAvg('kritiks', 'rating');
        $film->loadCount('kritiks');

        $filmByGenre = Film::select('id', 'title', 'poster', 'year', 'sinopsis')
            ->where('genre_id', $film->genre_id)
            ->where('id', '!=', $film->id)
            ->orderBy('created_at', 'asc')
            ->limit(7)
            ->get();

        $filmByRelease = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->where('year', Carbon::now()->format('Y'))
            ->orderBy('created_at', 'asc')
            ->limit(9)
            ->get();

        // jika belum ada film tahun ini, tampilkan film terbaru saja
        if ($filmByRelease->isEmpty()) {
            $filmByRelease = Film::select('id', 'title', 'poster', 'year')
                ->withAvg('kritiks', 'rating')
                ->orderByDesc('year')
                ->limit(9)
                ->get();
        }

        $comments = Kritik::with(['user:id,name,role_id'])
            ->where('film_id', $film->id)
            ->latest()
            ->limit(30)
            ->get();

        $perans = Peran::with('cast:id,name')
            ->where('film_id', $film->id)
            ->get();

        return view('components.movie-show', compact('film', 'filmByGenre', 'filmByRelease', 'comments', 'perans'));
    }

    public function movieHome()
    {
        $films = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->orderBy('created_at', 'asc')
            ->limit(9)->get();

        $filmFutured = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->orderByDesc('year')
            ->orderBy('created_at', 'asc')
            ->limit(6)->get();

        $filmRecentAdded = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(6)->get();

        $filmSlidey = Film::select('title', 'poster', 'sinopsis')
            ->orderByDesc('year')
            ->orderBy('created_at', 'asc')
            ->limit(6)->get();

        return view('components.home', compact('filmSlidey', 'films', 'filmFutured', 'filmRecentAdded'));
    }

    public function moviesByGenre($genre)
    {
        $genreFilm = Genre::findOrFail($genre);
        $search = '';

        $films = Film::select('id', 'title', 'poster', 'year')
            ->withAvg('kritiks', 'rating')
            ->where('genre_id', $genreFilm->id)
            ->orderByDesc('year')
            ->orderBy('created_at', 'asc')
            ->paginate(18);

        return view('components.movies', compact('films', 'genreFilm', 'search'));
    }
}
