<?php

namespace App\Http\Controllers;

use App\Http\Models\Actor;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actorsResponse = Actor::paginate(10);
        $actors = $actorsResponse->all();
        // return response()->json($actors);
        return view('actors.index', [
            'actorsResponse' => $actorsResponse,
            'actors' => $actors, 
            'timeOptionsList' => $this->timeOptionsList()
        ]);
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
        $first = $request->input('first_name');
        $last = $request->input('last_name');

        $newActor = new Actor();
        $newActor->first_name = $first;
        $newActor->last_name = $last;
        $newActor->created_at = Carbon::now();
        $newActor->updated_at = Carbon::now();
        $newActor->save();

        return redirect('aktoriai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {

        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy($actorId)
    {
        Actor::find($actorId)->delete();

        return redirect('aktoriai');
    }

    public function timeUpdate(Request $request)
    {
        return response()->json('timeUpdate method');
    }

    public function timeOptionsList() 
    {
        $timeOptionsArray = [
            "12:00",
            "12:30",
            "13:00",
            "13:30",
            "14:00",
            "14:30",
            "15:00",
            "15:30",
            "16:00",
            "16:30",
            "17:00",
            "17:30",
            "18:00",
            "18:30",
            "19:00",
            "19:30",
            "20:00",
            "20:30",
            "21:00",
            ">21:00"
        ];

        return $timeOptionsArray;
    }
}
