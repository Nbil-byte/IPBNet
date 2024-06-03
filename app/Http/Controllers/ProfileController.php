<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $id = Auth::user()->id;
        $user->fill($request->validated());

        // Reset email_verified_at jika email diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Memproses file foto profil jika ada
        if ($request->hasFile('profilePhoto')) {
            $file = $request->file('profilePhoto');
            if ($file->isValid()) {
                // Buat direktori khusus untuk user berdasarkan ID
                $userDirectory = 'public/profile/' . $id;

                // Hapus file lama jika ada
                if ($user->profilePhoto) {
                    Storage::disk('public')->delete($user->profilePhoto);
                }

                // Simpan file baru di direktori user
                $photoPath = $file->store($userDirectory);

                // Simpan jalur foto ke user profilePhoto field
                $user->profilePhoto = $photoPath;
            } else {
                Log::error('File tidak valid: ' . $file->getErrorMessage());
            }
        } else {
            Log::warning('Tidak ada file yang diunggah');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
}




    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $follower = Auth::user();

        $isFollowing = Follow::where('follower_id', $follower->id)
                             ->where('followee_id', $user->id)
                             ->exists();

        return view('profile.show', compact('user', 'isFollowing'));
    }
}
