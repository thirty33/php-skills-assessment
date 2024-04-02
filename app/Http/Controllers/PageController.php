<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(User $user)
    {
        return Inertia::render('Dashboard', [
            'user' => $user
        ]); 
    }
}
