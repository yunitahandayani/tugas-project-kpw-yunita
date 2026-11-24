<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $casts = Cast::withCount('perans')
            ->when($search !== '', fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.casts.index', compact('casts', 'search'));
    }

    public function create()
    {
        return view('admin.casts.form', ['cast' => new Cast()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Cast::create($this->validated($request));

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil ditambahkan.');
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.form', compact('cast'));
    }

    public function update(Request $request, Cast $cast): RedirectResponse
    {
        $cast->update($this->validated($request));

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil diperbarui.');
    }

    public function destroy(Cast $cast): RedirectResponse
    {
        DB::transaction(function () use ($cast) {
            $cast->perans()->delete();
            $cast->delete();
        });

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'age' => ['required', 'integer', 'between:1,120'],
            'bio' => ['required', 'string', 'max:1000'],
        ]);
    }
}
