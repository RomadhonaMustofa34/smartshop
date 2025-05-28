<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = auth()->user(); // Mengambil data pengguna yang sedang login
        return view('profile.index', compact('user'));
    }

    /**
     * Tampilkan halaman edit profil.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Perbarui data profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => ['nullable', 'regex:/^[0-9]+$/'],
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $filePath;
        }

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->no_hp = preg_replace('/\D/', '', $request->no_hp ?? '');

        if ($user->save()) {
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->route('profile.edit')->withErrors(['error' => 'Gagal memperbarui profil.']);
    }
}
