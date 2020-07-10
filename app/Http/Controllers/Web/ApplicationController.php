<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Storage;

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
