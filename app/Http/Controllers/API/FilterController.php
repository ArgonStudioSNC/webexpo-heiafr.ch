<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources;
use App\Models;

class FilterController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    }

    /*
    |-------------------------------------------------------------------------------
    | Get All Filters
    |-------------------------------------------------------------------------------
    | URL:            /api/v1/filters
    | Method:         GET
    | Description:    Gets all the filters in the application
    */
    public function index(){
        return response()->json([
            'sites' => Resources\Site::collection(Models\Site::all()),
            'professors' => Resources\Professor::collection(Models\Professor::all()),
            'workshops' => Resources\Workshop::collection(Models\Workshop::all())
        ]);
    }
    //
}
