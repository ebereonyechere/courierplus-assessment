<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tokens.index', ['token' => null]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken("Api Token");

        return view('tokens.index', ['token' => $token->plainTextToken]);
    }
}
