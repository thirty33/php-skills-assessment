<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        return Inertia::render('Dashboard', [
            'user' => $request->user()
        ]); 
    }
}
