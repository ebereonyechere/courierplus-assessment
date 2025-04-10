<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::nonAdmins()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('login');
    }

    /**
     * Approve a newly registered pending tenant.
     */
    public function approve(User $user, Request $request)
    {

        $user->approved_at = now();
        $user->save();

        return redirect()->back();
    }

    /**
     * Ban a previously approved tenant
     */
    public function ban(User $user, Request $request)
    {

        $user->approved_at = null;
        $user->save();

        return redirect()->back();
    }
}
