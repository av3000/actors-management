@extends('layouts.master')

@section('content')
    <h1>Aktoriai</h1>
    <div class="float-right mb-4">
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#createActorModal">Naujas Aktorius +</button>
    </div>
    <div>
        <p>Viso aktoriu( <strong class="text-success">{{ $actorsTotal }}</strong> )</p>
    </div>
    <table class="table table-striped">
    <th>Unikalus ID</th>
    <th scope="col">Vardas</th>
    <th scope="col">Pavarde</th>
    <th scope="col">Uzimtumas</th>
    <th scope="col">Veiksmai</th>
        @foreach($actors as $actor)
        <tr>
            <td>#{{ $actor->id }} <a href="{{ route('aktoriai.show', $actor->id) }}"> Profilis </a> </td>
            <td>
                {{ $actor->first_name }}
            </td>
            <td>
                {{ $actor->last_name }}
            </td>
            <td>
                <button type="button" data-toggle="modal" class="btn btn-secondary" data-target="#timeActorModal-{{ $actor->id }}">Grafikas</button>
            </td>
            <td>
                <button type="button" data-toggle="modal" class="btn btn-primary" data-target="#editActorModal-{{ $actor->id }}">Redaguoti</button>
                <button type="button" data-toggle="modal" class="btn btn-danger" data-target="#deleteActorModal-{{ $actor->id }}">Panaikinti</button>
            </td>
        </tr>
        <!-- Modals -->
        <div class="modal fade" id="deleteActorModal-{{ $actor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title" id="myModalLabel">
                        Aktorius <strong>{{ $actor->first_name }} {{ $actor->last_name }}</strong> bus istrintas!
                    </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>Istrinto aktoriaus ir su juo susijusios medziagos sugrazinti nebus galima</strong>.</br> Trinti?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Atsaukti</button>
                <form  method="POST" id="deletePost-{{ $actor->id }}" action="{{route('aktoriai.destroy', $actor->id)}}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Taip, istrinti</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="editActorModal-{{ $actor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Redaguoti Aktoriu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('aktoriai.update', $actor->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vardas">Vardas</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $actor->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="pavarde">Pavarde</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $actor->last_name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                        <button type="submit" class="btn btn-primary">Issaugoti pakeitimus</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="timeActorModal-{{ $actor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Aktorius <strong>{{ $actor->first_name }} {{ $actor->last_name }}</strong> laisvas:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('aktoriai.timeupdate', $actor->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="row ml-1 mb-4">
                            <label for="pirmadienis">Pirmadienis</label>
                            <div class="col-md-4">
                                <label for="">Nuo</label>
                                <select name="timeItem-pirmadienis-from" id="timeItem-pirmadienis-from" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleMondayFrom ? 'selected' : '' }}  >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Iki</label>
                                <select name="timeItem-pirmadienis-until" id="timeItem-pirmadienis-until" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleMondayUntil ? 'selected' : '' }}  >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row ml-1 mb-4">
                            <label for="antradienis">Antradienis</label>
                            <div class="col-md-4">
                                <label for="">Nuo</label>
                                <select name="timeItem-antradienis-from" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleTuesdayFrom ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Iki</label>
                                <select name="timeItem-antradienis-until" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleTuesdayUntil ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row ml-1 mb-4">
                            <label for="treciadienis">Treciadienis</label>
                            <div class="col-md-4">
                                <label for="">Nuo</label>
                                <select name="timeItem-treciadienis-from" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleWednesdayFrom ? 'selected' : '' }}  >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Iki</label>
                                <select name="timeItem-treciadienis-until" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleWednesdayUntil ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row ml-1 mb-4">
                            <label for="ketvirtadienis">Ketvirtadienis</label>
                            <div class="col-md-4">
                                <label for="">Nuo</label>
                                <select name="timeItem-ketvirtadienis-from" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleThursdayFrom ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Iki</label>
                                <select name="timeItem-ketvirtadienis-until" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleThursdayUntil ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row ml-1 mb-4">
                            <label for="penktadienis">Penktadienis</label>
                            <div class="col-md-4">
                                <label for="">Nuo</label>
                                <select name="timeItem-penktadienis-from" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleFridayFrom ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Iki</label>
                                <select name="timeItem-penktadienis-until" id="" class="form-control">
                                @foreach($timeOptionsList as $timeItem)
                                    <option value="{{ $timeItem }}" {{ $timeItem == $actor->timeScheduleFridayUntil ? 'selected' : '' }} >{{ $timeItem }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                        <button type="submit" class="btn btn-primary">Issaugoti pakeitimus</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @endforeach
    </table>

    <div class="modal fade" id="createActorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Naujas Aktorius</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('aktoriai.store')}}" method="post">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="vardas">Vardas</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Vardzius">
                    </div>
                    <div class="form-group">
                        <label for="pavarde">Pavarde</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Pavardzius">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                    <button type="submit" class="btn btn-primary">Sukurti Aktoriu</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection