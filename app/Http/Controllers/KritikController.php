<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Kritik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KritikController extends Controller
{
    /**
     * User biasa memberi komentar/kritik pada film.
     * Administrator TIDAK boleh memberi komentar.
     */
    public function store(Request $request, Film $film): RedirectResponse
    {
        abort_if($request->user()->isAdmin(), 403, 'Administrator tidak bisa memberikan komentar pada film.');

        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'min:3', 'max:1000'],
        ]);

        Kritik::create([
            'film_id' => $film->id,
            'user_id' => $request->user()->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return redirect()->to(route('movies.show', $film) . '#komentar')
            ->with('success', 'Komentar kamu berhasil dikirim.');
    }

    /**
     * User hanya boleh menghapus komentarnya sendiri.
     */
    public function destroy(Request $request, Kritik $kritik): RedirectResponse
    {
        abort_unless((int) $kritik->user_id === (int) $request->user()->id, 403);

        $filmId = $kritik->film_id;
        $kritik->delete();

        return redirect()->to(route('movies.show', $filmId) . '#komentar')
            ->with('success', 'Komentar dihapus.');
    }
}
