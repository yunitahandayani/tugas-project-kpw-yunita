<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('films')->orderBy('name')->paginate(20);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.form', ['genre' => new Genre()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:45', 'unique:genres,name']]);
        Genre::create($data);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.form', compact('genre'));
    }

    public function update(Request $request, Genre $genre): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:45', 'unique:genres,name,' . $genre->id]]);
        $genre->update($data);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        if ($genre->films()->exists()) {
            return back()->with('error', 'Genre masih dipakai oleh film, tidak bisa dihapus.');
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil dihapus.');
    }
}
