<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FishController extends Controller
{
    /**
     * Display the fish listing page (uses Local Storage)
     */
    public function index()
    {
        return view('fish.index');
    }

    /**
     * Display the fish detail page which reads from Local Storage
     */
    public function show($id)
    {
        // id is unused because data is stored in Local Storage
        return view('fish.show');
    }
}
