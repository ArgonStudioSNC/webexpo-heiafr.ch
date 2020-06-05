<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Project as ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
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
    | Get All Projects
    |-------------------------------------------------------------------------------
    | URL:            /api/v1/projects/{year}
    | @param year $year
    | Method:         GET
    | Description:    Gets all of the projects of the given year
    */
    public function index($year){
        return ProjectResource::collection(Project::where('year', $year)->get());
    }
    //
}
