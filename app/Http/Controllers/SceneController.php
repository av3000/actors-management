<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Project;
use App\Http\Models\Scene;

use Carbon\Carbon;

class SceneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // return response()->json([
        //     'request' => $request->all(),
        //     'id' => $id
        // ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $scene_sequence_number = $request->input('scene_sequence_number');

        $newScene = new Scene();
        $newScene->title = $title;
        $newScene->description = $description;
        $newScene->project_id = $id;
        $newScene->scene_sequence_number = $scene_sequence_number;
        $newScene->created_at = Carbon::now();
        $newScene->updated_at = Carbon::now();
        $newScene->save();

        return redirect("projektai/".$id."/scenos/".$newScene->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $id)
    {   
        $scene = Scene::where('id', $id)->first();
        
        $project = Project::where('id', $projectId)->first();

        $data = [
            'project' => $project,
            'scene' => $scene
        ];

        // return view('projektai/'.$projectId.'/scenos/'.$id);
        return view('scenes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
