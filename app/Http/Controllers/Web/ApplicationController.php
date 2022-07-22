<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    /**
     * Get the SPA.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('webexpo');
    }
}
