@extends('layouts.master')
@section('content')
<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-12 pb-3 mb-4 border-bottom">
                <h3 class="display-2 font-italic">
                    <strong>{{ $data['project']->title}}</strong>
                </h3>
            </div>
            <div class="col-md-12 mb-3 border-bottom">
                <p>
                    {{ $data['project']->description }}
                </p>
            </div>
            <div class="col-md-12 text-center mb-3">
                <h3>Roles</h3>
                <div class="float-right mb-4">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#createRoleModal">Sukurti Role +</button>
                </div>
            </div>
            <div class="col-md-12 pb-3 mb-4 border-bottom">
                <ul>
                    @foreach($data['roles'] as $role)
                    <li> 
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#editRoleModal-{{$role->id}}">{{ $role->name }}</button>
                    <!-- <a href="{{ route('projektai.roles.show', ['projektai' => $data['project']->id, 'role' => $role->id ] )}}">{{ $role->name }}</a> -->
                    <div class="modal fade" id="editRoleModal-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">{{$role->name}} Vaidmuo/Role Redagavimas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('projektai.roles.update', ['projektai' => $data['project']->id, 'role' => $role->id])}}" method="post">
                            @csrf
                            {{ method_field('PUT') }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="pavadinimas">Pavadinimas</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Švirkšmantas" value="{{$role->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="aprasymas">Aprasymas</label>
                                        <textarea maxlength="400" rows="4" type="text" class="form-control" name="description" id="description" placeholder="Veikėjui, kaip ir jo vardas byloja, buvo lemta tapti daktaru. Jis isties leidžia laiką prie ligoninių, tačiau... Švirkštai, kuriuos jis naudoja, skirti gydyti ne kūnui, o sielai. Ir taip kasdien Švirkšmanto gyvenime...">{{$role->description}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                                    <button type="submit" class="btn btn-primary">Atnaujinti role</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                     </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Scenos</h3>
            </div>
            <div class="col-md-12 pb-3 mb-4 border-bottom">
                <ul>
                    @foreach($data['scenes'] as $scene)
                    <li> <a href="{{ route('projektai.scenos.show', ['projektai' => $data['project']->id, 'sceno' => $scene->id ] )}}">{{ $scene->title }}</a> </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Projekte esantys Aktoriai</h3>
            </div>
            <div class="col-md-12">
                <ul>
                    @foreach($data['actors'] as $actor)
                    <li> 
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editActorModal-{{$actor->id}}">{{ $actor->first_name }} {{ $actor->last_name }}</button>
                    <!-- <a href="{{ route('aktoriai.show', $actor->id )}}">{{ $actor->first_name }} {{ $actor->last_name }}</a>  -->
                    <div class="modal fade" id="editActorModal-{{$actor->id}}" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">
                                <a href="{{ route('aktoriai.show', $actor->id ) }}">{{ $actor->first_name }} {{ $actor->last_name }}</a> Roliu valdymas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                    <form 
                                        action="{{ route('projektai.add-role-to-actor', [ 'projectId' => $data['id'], 'actorId' => $actor->id ])}}"
                                        method="post"
                                    >
                                    @csrf
                                        @if($actor->rolesCount > 0)
                                            <label for="pavadinimas"> <u>Esamos roles:</u> </label>
                                            @foreach($actor->assignedRoles as $singleRole)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{ $singleRole->name }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="btn-group float-right">
                                                            <button type="button" data-toggle="modal" class="btn btn-danger" data-target="#detachModal-{{ $singleRole->id }}">Atkabinti</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="detachModal-{{ $singleRole->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 style="text-align: center;" class="modal-title" id="myModalLabel2">
                                                                    Roles atkabinimas
                                                                </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Ar tikrai norite Atkabinti role <i>{{$singleRole->name}}</i> nuo aktoriaus <i>{{$actor->first_name}} {{$actor->last_name}}</i> ? </strong></br>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <form  method="POST" id="detachModal-{{ $singleRole->id }}" action="{{route('projektai.detach-role-from-actor', ['roleId' => $singleRole->id, 'actorId' => $actor->id, 'projectId' => $data['id']])}}">
                                                                @csrf
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Atsaukti</button>
                                                                <button type="submit" class="btn btn-danger">Taip, Atkabinti</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Aktorius roliu dar neturi...</p>
                                        @endif
                                    </form>
                                    </div>
                                    <div class="form-group">
                                    @if(count($actor->potentialRoles) > 0)
                                    <form 
                                        action="{{ route('projektai.add-role-to-actor', [ 'projectId' => $data['id'], 'actorId' => $actor->id ])}}"
                                        method="post"
                                    >
                                    @csrf
                                        <label for=""> <u>Galimos roles:</u> </label>
                                        <select name="potentialRoles" id="potentialRoles" class="form-control">
                                        @foreach($actor->potentialRoles as $singleRole)
                                            <option value="{{ $singleRole->id }}">{{ $singleRole->name }}</option>
                                        @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Priskirti</button>
                                    </form>
                                    @else
                                        Nebera aktoriui galimu roliu...
                                        <br/>
                                        <small>
                                            P.S.Galima sukurti reikalavimus rolei pvz: lytis, ir aktoriui vyrui nerodytu moteru roliu ar pan.
                                        </small>
                                    @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Naujas Vaidmuo/Role </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{route('projektai.roles.store', $data['project']->id)}}" method="post">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Švirkšmantas">
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprasymas</label>
                    <textarea maxlength="400" rows="4" type="text" class="form-control" name="description" id="description" placeholder="Veikėjui, kaip ir jo vardas byloja, buvo lemta tapti daktaru. Jis isties leidžia laiką prie ligoninių, tačiau... Švirkštai, kuriuos jis naudoja, skirti gydyti ne kūnui, o sielai. Ir taip kasdien Švirkšmanto gyvenime..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                <button type="submit" class="btn btn-primary">Sukurti role</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection