<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

        if (! $user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        function cleanPhoneNumber($phone)
        {
            return preg_replace('/[^0-9+]/', '', $phone);
        }

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9._-]{2,254}$/', Rule::unique('users')->ignore($user?->id)],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user?->id)],
            'phone'     => ['nullable', 'string', 'max:20', 'regex:/^\+\d{1,3} \(\d{3}\) \d{3} \d{2} \d{2}$/'],
            'bio'       => ['nullable', 'string'],
            'facebook'  => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
            'x'         => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
            'linkedin'  => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
            'instagram' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
            'youtube' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
            'github'    => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._-]+$/'],
        ], [
            'name.required'     => 'Ad alanı zorunludur.',
            'surname.required'  => 'Soyad alanı zorunludur.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'username.unique'   => 'Bu kullanıcı adı zaten kullanılıyor.',
            'email.required'    => 'E-posta adresi zorunludur.',
            'email.unique'      => 'Bu e-posta adresi zaten kayıtlı.',
            'phone.regex'       => 'Telefon numarası geçerli bir formatta olmalıdır. Örnek: +905324613963',
            'facebook.regex'    => 'Facebook kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
            'x.regex'           => 'X kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
            'linkedin.regex'    => 'LinkedIn kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
            'instagram.regex'   => 'Instagram kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
            'youtube.regex'   => 'Youtube kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
            'github.regex'      => 'GitHub kullanıcı adı sadece harf, rakam, nokta (.), tire (-) ve alt çizgi (_) içerebilir.',
        ]);

        $validatedData = [
            'name'      => htmlspecialchars(strip_tags($request->input('name')), ENT_QUOTES, 'UTF-8'),
            'surname'   => htmlspecialchars(strip_tags($request->input('surname')), ENT_QUOTES, 'UTF-8'),
            'username'  => htmlspecialchars(strip_tags($request->input('username')), ENT_QUOTES, 'UTF-8'),
            'email'     => htmlspecialchars(strip_tags($request->input('email')), ENT_QUOTES, 'UTF-8'),
            'phone'     => cleanPhoneNumber($request->input('phone')),
            'bio'       => htmlspecialchars(strip_tags($request->input('bio')), ENT_QUOTES, 'UTF-8'),
            'facebook'  => htmlspecialchars(strip_tags($request->input('facebook')), ENT_QUOTES, 'UTF-8'),
            'x'         => htmlspecialchars(strip_tags($request->input('x')), ENT_QUOTES, 'UTF-8'),
            'linkedin'  => htmlspecialchars(strip_tags($request->input('linkedin')), ENT_QUOTES, 'UTF-8'),
            'instagram' => htmlspecialchars(strip_tags($request->input('instagram')), ENT_QUOTES, 'UTF-8'),
            'youtube' => htmlspecialchars(strip_tags($request->input('youtube')), ENT_QUOTES, 'UTF-8'),
            'github'    => htmlspecialchars(strip_tags($request->input('github')), ENT_QUOTES, 'UTF-8'),
        ];

        try {
            Log::info('Güncelleme Başlamadan Önce', ['data' => $validatedData]);

            $user->update($validatedData);

            Log::info('Güncelleme Başarılı', [
                'user_id'    => $user->id,
                'updated_by' => auth()->id(),
                'changes'    => $validatedData,
            ]);

            return redirect()->route('dashboard.profile.index')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profil güncelleme hatası', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Profile update failed. Please try again.');
        }

    }

    public function updatePhoto(Request $request)
    {

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $user = Auth::user();

        if ($user->profile_image && Storage::disk('public')->exists('profile_photos/' . $user->profile_image)) {
            Storage::disk('public')->delete('profile_photos/' . $user->profile_image);
        }

        $image    = $request->file('profile_photo');
        $filename = 'profile_' . uniqid() . '.webp';

        $folder = 'profile_photos';
        if (! Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $manager = new ImageManager(new Driver());
        $img     = $manager->read($image->getPathname());

        $img->toWebp(80)->save(storage_path('app/public/' . $folder . '/' . $filename));

        $user->profile_image = $filename;
        $user->save();

        return back()->with('success', 'Profile photo updated successfully.');
    }

}
