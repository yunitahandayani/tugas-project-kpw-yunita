<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load('profile', 'role');
        $jumlahKritik = $user->kritiks()->count();

        return view('profile.show', compact('user', 'jumlahKritik'));
    }

    public function edit(Request $request)
    {
        $user = $request->user()->load('profile');

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'umur' => ['required', 'integer', 'between:1,120'],
            'alamat' => ['required', 'string', 'max:500'],
            'bio' => ['required', 'string', 'max:500'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $profile = $user->profile ?? new Profile();
        $profile->fill([
            'umur' => $data['umur'],
            'alamat' => $data['alamat'],
            'bio' => $data['bio'],
        ])->save();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->profile_id = $profile->id;
        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
