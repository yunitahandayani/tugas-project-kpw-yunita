<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $films = Film::with('genre')
            ->when($search !== '', fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.films.index', compact('films', 'search'));
    }

    public function create()
    {
        return view('admin.films.form', [
            'film' => new Film(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);
        $data['poster'] = $this->savePoster($request);

        Film::create($data);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        return view('admin.films.form', [
            'film' => $film,
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Film $film): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('poster')) {
            $this->deletePoster($film->poster);
            $data['poster'] = $this->savePoster($request);
        }

        $film->update($data);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film): RedirectResponse
    {
        DB::transaction(function () use ($film) {
            // hapus data yang bergantung pada film ini terlebih dahulu
            $film->perans()->delete();
            $film->kritiks()->delete();
            $film->delete();
        });
        $this->deletePoster($film->poster);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus.');
    }

    private function validated(Request $request, bool $posterRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'between:1900,' . (now()->year + 5)],
            'genre_id' => ['required', 'exists:genres,id'],
            'sinopsis' => ['required', 'string', 'max:2000'],
            'poster' => [$posterRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function savePoster(Request $request): string
    {
        $file = $request->file('poster');
        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/posters'), $name);

        return 'uploads/posters/' . $name;
    }

    /** Hanya poster hasil upload yang dihapus, bukan gambar bawaan template. */
    private function deletePoster(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/posters/') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
