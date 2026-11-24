<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\Peran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'Film' => Film::count(),
            'Cast' => Cast::count(),
            'Genre' => Genre::count(),
            'Peran' => Peran::count(),
            'User' => User::count(),
            'Komentar' => Kritik::count(),
        ];

        $filmTerbaru = Film::with('genre')->latest('id')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'filmTerbaru'));
    }
}
