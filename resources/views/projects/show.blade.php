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
                    <div class="modal fade" id="editActorModal-{{$actor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">
                                <a href="{{ route('aktoriai.show', $actor->id ) }}">{{ $actor->first_name }} {{ $actor->last_name }}</a> Roliu valdymas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form 
                                action="{{ route('projektai.add-role-to-actor', [ 'projectId' => $data['id'], 'actorId' => $actor->id ])}}"
                                method="post"
                            >
                            @csrf
                            
                                <div class="modal-body">
                                    <div class="form-group">
                                        @if($actor->rolesCount > 0)
                                            <label for="pavadinimas">Esamos roles</label>
                                            <ul>
                                            @foreach($actor->assignedRoles as $singleRole)
                                                <li> {{ $singleRole->name }} </li>
                                            @endforeach
                                            </ul>
                                        @else
                                            <p>Aktorius roliu dar neturi...</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Galimos roles</label>
                                        <select name="potentialRoles" id="potentialRoles" class="form-control">
                                        @foreach($data['roles'] as $singleRole)
                                            <option value="{{ $singleRole->id }}">{{ $singleRole->name }}</option>
                                        @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                                    <button type="submit" class="btn btn-primary">Atnaujinti</button>
                                </div>
                            </form>
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