<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;

class PageController extends Controller
{
    public function showProfile(User $user)
    {
        return view('frontend.bio', compact('user'));
    }
}
