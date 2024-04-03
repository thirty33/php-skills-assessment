<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(Request $request)
    {       
        return Inertia::render('Users/Index', [
            'users' => User::withTrashed()
                ->whereNotIn('id', [$request->user()->id])
                ->get()
        ]);
    }

    public function disable(Request $request, User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('status', 'User disabled');
    }

    public function enable(Request $request, string $id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->route('users.index')
            ->with('status', 'User enabled');
    }
}
