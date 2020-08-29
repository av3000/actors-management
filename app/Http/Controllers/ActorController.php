<?php

namespace App\Http\Controllers;

use App\Http\Models\Actor;
use App\Http\Models\ActorSchedule;
use DB;

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
        $actorsResponse = Actor::paginate(20);
        $actors = $actorsResponse->all();
        $actorsTotal = 0;
        foreach($actors as $actor)
        {
            $actorsTotal++;
            $actor->timeScheduleArray = $this->getActorTimeScheduleList($actor->id);
            if(count($actor->timeScheduleArray) > 0)
            {
                $actor->timeScheduleMondayFrom = $actor->timeScheduleArray[0]->available_from;
                $actor->timeScheduleMondayUntil = $actor->timeScheduleArray[0]->available_until;

                $actor->timeScheduleTuesdayFrom = $actor->timeScheduleArray[1]->available_from;
                $actor->timeScheduleTuesdayUntil = $actor->timeScheduleArray[1]->available_until;

                $actor->timeScheduleWednesdayFrom = $actor->timeScheduleArray[2]->available_from;
                $actor->timeScheduleWednesdayUntil = $actor->timeScheduleArray[2]->available_until;

                $actor->timeScheduleThursdayFrom = $actor->timeScheduleArray[3]->available_from;
                $actor->timeScheduleThursdayUntil = $actor->timeScheduleArray[3]->available_until;

                $actor->timeScheduleFridayFrom = $actor->timeScheduleArray[4]->available_from;
                $actor->timeScheduleFridayUntil = $actor->timeScheduleArray[4]->available_until;
            }
        }

        // return response()->json($actors);
        return view('actors.index', [
            'actorsResponse' => $actorsResponse,
            'actors' => $actors, 
            'timeOptionsList' => $this->getTimeOptionsList(),
            'actorsTotal' => $actorsTotal
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

        for($i=0; $i<5; $i++){
            $newActorSchedule = new ActorSchedule();
            $newActorSchedule->actor_id = $newActor->id;
            $newActorSchedule->weekday = $i+1;
            $newActorSchedule->available_from = $this->getTimeOptionsList()[0];
            $newActorSchedule->available_until = $this->getTimeOptionsList()[0];
            $newActorSchedule->created_at = Carbon::now();
            $newActorSchedule->updated_at = Carbon::now();
            $newActorSchedule->save();
        }
        

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
    public function update(Request $request, $actorId)
    {
        $updatedActor = Actor::find($actorId);
        if($updatedActor->first_name != $request->get('first_name'))
        {
            $updatedActor->first_name = $request->get('first_name');
        }
        if($updatedActor->last_name != $request->get('last_name'))
        {
            $updatedActor->last_name = $request->get('last_name');
        }

        $updatedActor->save();

        return redirect('aktoriai');
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

    public function timeUpdate(Request $request, $actorId)
    {
        $updatedActorSchedule1 = ActorSchedule::where('actor_id', $actorId)->where('weekday', 1)->first();
        
        $updatedActorSchedule1->available_from = $request->get('timeItem-pirmadienis-from');
        $updatedActorSchedule1->available_until = $request->get('timeItem-pirmadienis-until');
        $updatedActorSchedule1->save();

        $updatedActorSchedule2 = ActorSchedule::where('actor_id', $actorId)->where('weekday', 2)->first();
        $updatedActorSchedule2->available_from = $request->get('timeItem-antradienis-from');
        $updatedActorSchedule2->available_until = $request->get('timeItem-antradienis-until');
        $updatedActorSchedule2->save();

        $updatedActorSchedule3 = ActorSchedule::where('actor_id', $actorId)->where('weekday', 3)->first();
        $updatedActorSchedule3->available_from = $request->get('timeItem-treciadienis-from');
        $updatedActorSchedule3->available_until = $request->get('timeItem-treciadienis-until');
        $updatedActorSchedule3->save();

        $updatedActorSchedule4 = ActorSchedule::where('actor_id', $actorId)->where('weekday', 4)->first();
        $updatedActorSchedule4->available_from = $request->get('timeItem-ketvirtadienis-from');
        $updatedActorSchedule4->available_until = $request->get('timeItem-ketvirtadienis-until');
        $updatedActorSchedule4->save();

        $updatedActorSchedule5 = ActorSchedule::where('actor_id', $actorId)->where('weekday', 5)->first();
        $updatedActorSchedule5->available_from = $request->get('timeItem-penktadienis-from');
        $updatedActorSchedule5->available_until = $request->get('timeItem-penktadienis-until');
        $updatedActorSchedule5->save();

        return redirect('aktoriai');
    }

    public function getTimeOptionsList() 
    {
        $timeOptionsArray = [
            "-",
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

    public function getActorTimeScheduleList($actorId)
    {
        $timeScheduleArray = DB::table('actorschedule')->where('actor_id', $actorId)->orderBy('weekday')->get();

        return $timeScheduleArray;
    }
}
