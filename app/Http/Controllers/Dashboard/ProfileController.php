<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => Auth::user(),
        ]);
    }
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasyon Kuralları
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone'     => ['nullable', 'string', 'max:20'],
            'bio'       => ['nullable', 'string'],
            'facebook'  => ['nullable', 'url'],
            'x'         => ['nullable', 'url'],
            'linkedin'  => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'github'    => ['nullable', 'url'],
        ]);

        // Kullanıcı Bilgilerini Güncelle
        $user->update([
            'name'      => $request->name,
            'surname'   => $request->surname,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'bio'       => $request->bio,
            'facebook'  => $request->facebook,
            'x'         => $request->x,
            'linkedin'  => $request->linkedin,
            'instagram' => $request->instagram,
            'github'    => $request->github,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
