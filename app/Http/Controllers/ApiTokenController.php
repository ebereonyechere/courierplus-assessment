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
        return view('tokens.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->createToken("Api Token");

        return redirect()->back();
    }
}
