<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BioLinkController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.biolink', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'links'         => 'nullable|array',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url'   => 'nullable|url|max:255',
        ]);
    
        $links = $validated['links'] ?? [];
    
        $sanitizedLinks = array_map(function ($link) {
            return [
                'title' => htmlspecialchars(strip_tags($link['title'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'url'   => htmlspecialchars(strip_tags($link['url'] ?? ''), ENT_QUOTES, 'UTF-8'),
            ];
        }, $links);
    
        foreach ($sanitizedLinks as $index => $link) {
            $hasTitle = !empty($link['title']);
            $hasUrl   = !empty($link['url']);
        
            if ($hasTitle xor $hasUrl) {
                return redirect()->back()
                    ->withErrors([
                        "links.{$index}.title" => "Her bir linkin hem başlığı hem de URL’si dolu olmalıdır.",
                        "links.{$index}.url"   => "Her bir linkin hem başlığı hem de URL’si dolu olmalıdır.",
                    ])
                    ->withInput();
            }
        }
        
    
        $filteredLinks = array_filter($sanitizedLinks, function ($link) {
            return !empty($link['title']) || !empty($link['url']);
        });
    
        $user = Auth::user();
        $user->links = array_values($filteredLinks); // Boş olursa [] kaydeder
        $user->save();
    
        return back()->with('success', 'Linkler başarıyla güncellendi.');
    }
    

}
