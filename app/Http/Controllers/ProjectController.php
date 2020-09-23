<?php

namespace App\Http\Controllers;

use App\Http\Models\Project;
use App\Http\Models\Scene;
use App\Http\Models\Role;
use App\Http\Models\Actor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectsResponse = Project::paginate(10);
        $projects = $projectsResponse->all();
        // return response()->json($projects);
        return view('projects.index', ['projectsResponse' => $projectsResponse, 'projects' => $projects]);
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
    public function store(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');

        $newProject = new Project();
        $newProject->title = $title;
        $newProject->description = $description;
        $newProject->created_at = Carbon::now();
        $newProject->updated_at = Carbon::now();
        $newProject->save();

        return redirect('projektai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id', $id)->first();
        $scenes = Scene::where('project_id', $id)->get()->all();
        $roles = Role::where('project_id', $id)->get()->all();
        $actors = $project->actors->all();

        foreach($actors as $actor)
        {
            $actor->assignedRoles = $actor->roles()->get()->all();
            $actor->rolesCount = count($actor->assignedRoles);
        }

        $data = [
            'actors' => $actors,
            'project' => $project,
            'scenes' => $scenes,
            'roles' => $roles,
            'id' => $id
        ];

        return view('projects.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Add Actor to the project
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addActorToProject(Request $request)
    {
        $actorId = $request->get('actor_id');
        $projectId = $request->get('project_id');

        $actor = Actor::find($actorId);

        $project = Project::find($projectId);
        $project->actors()->attach($actor);

        return redirect("aktoriai/".$actorId);
    }

    public function addRoleToActor(Request $request)
    {
        $actorId = $request->get('actorId');
        $projectId = $request->get('projectId');
        $roleId = $request->get('potentialRoles');

        $actor = Actor::find($actorId);
        $role = Role::find($roleId);
        $actor->roles()->attach($role);

        return redirect("projektai/".$projectId);

        return response()->json([
            'request' => $request->all(),
            'projectId' => $projectId,
            'actorId' => $actorId,
            'roleId' => $roleId
        ]);
    }
}
