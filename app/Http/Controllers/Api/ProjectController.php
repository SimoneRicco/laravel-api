<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchString = $request->query('q', '');
        $project = Project::with('type', 'technologies')->where('title', 'LIKE', "%${searchString}%")->paginate(5);
        return response()->json([
            'results'   => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\MoProjectdels\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return response()->json([
            'results'   => $project,
        ]);
    }
    public function random()
    {
        $project = Project::inRandomOrder()->limit(9)->get();

        return response()->json([
            'results'   => $project,
        ]);
    }
}
