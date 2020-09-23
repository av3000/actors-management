<?php

namespace App\Http\Controllers;

use App\Http\Models\Role;
use App\Http\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoleController extends Controller
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
        $newRole = new Role();
        $newRole->name = $request->get('name');
        $newRole->description = $request->get('description');
        $newRole->project_id = $id;
        $newRole->created_at = Carbon::now();
        $newRole->updated_at = Carbon::now();
        $newRole->save();

        return redirect('projektai/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id, $role)
    {
        $updatedRole = Role::find($role)->first();
        $updatedRole->name = $request->get('name');
        $updatedRole->description = $request->get('description');
        $updatedRole->updated_at = Carbon::now();
        $updatedRole->save();

        return redirect('projektai/'.$id);
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
