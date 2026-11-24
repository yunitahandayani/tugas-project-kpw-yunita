<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Peran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    public function index(Request $request)
    {
        $filmId = $request->query('film_id');

        $perans = Peran::with(['film:id,title', 'cast:id,name'])
            ->when($filmId, fn ($q) => $q->where('film_id', $filmId))
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $films = Film::orderBy('title')->get(['id', 'title', 'year']);

        return view('admin.perans.index', compact('perans', 'films', 'filmId'));
    }

    public function create()
    {
        return view('admin.perans.form', [
            'peran' => new Peran(),
            'films' => Film::orderBy('title')->get(['id', 'title', 'year']),
            'casts' => Cast::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Peran::create($this->validated($request));

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil ditambahkan.');
    }

    public function edit(Peran $peran)
    {
        return view('admin.perans.form', [
            'peran' => $peran,
            'films' => Film::orderBy('title')->get(['id', 'title', 'year']),
            'casts' => Cast::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Peran $peran): RedirectResponse
    {
        $peran->update($this->validated($request));

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil diperbarui.');
    }

    public function destroy(Peran $peran): RedirectResponse
    {
        $peran->delete();

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'film_id' => ['required', 'exists:films,id'],
            'cast_id' => ['required', 'exists:casts,id'],
            'actor' => ['required', 'string', 'max:255'],
        ]);
    }
}
