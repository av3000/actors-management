@extends('layouts.master')

@section('content')
    <h1>Projektai</h1>
    <div class="float-right mb-4">
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#createProjectModal">Naujas Projektas +</button>
    </div>
    <table class="table table-striped">
    <th>#</th>
    <th scope="col">Pavadinimas</th>
    <th scope="col">Scenos</th>
    <th scope="col">Aktoriai</th>
    <th scope="col">Roles</th>
    <th scope="col" class="float-right">Veiksmai</th>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>
                <a href="{{route('projektai.show', $project->id)}}">{{ $project->title }}</a>
            </td>
            <td> 
                <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#showScenesModal-{{ $project->id }}">( <i> <strong> 2 </strong></i> )</a>
            </td>
            <td>
                <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#showActorsModal-{{ $project->id }}">( <i> <strong> 5 </strong></i> )</a>
            </td>
            <td> 
                <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#showRolesModal-{{ $project->id }}">( <i> <strong> 4 </strong></i> )</a>
            </td>
            <td class="float-right">
            <button type="button" data-toggle="modal" class="btn btn-primary" data-target="#editProjectModal-{{ $project->id }}">Redaguoti</button>
            <button type="button" data-toggle="modal" class="btn btn-danger" data-target="#deleteProjectModal-{{ $project->id }}">Panaikinti</button>
            <button type="button" data-toggle="modal" class="btn btn-success" data-target="#createSceneModal-{{ $project->id }}">Prideti Scena +</button>
            </td>
        </tr>
        <!-- Modals -->
        <div class="modal fade" id="deleteProjectModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title" id="myModalLabel">
                        Projektas <strong>{{ $project->title }} </strong> bus istrintas!
                    </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>Istrinto projekto ir su juo susijusios medziagos sugrazinti nebus galima</strong>.</br> Trinti?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Atsaukti</button>
                <form  method="POST" id="deletePost-{{ $project->id }}" action="{{route('projektai.destroy', $project->id)}}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Taip, istrinti</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="showScenesModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="text-align: center;" class="modal-title" id="myModalLabel">
                            Projekto <strong> {{ $project->title }} </strong> scenos
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">Scenos numeris</div>
                            <div class="col-md-4">Pavadinimas</div>
                            <div class="col-md-4">Uzpildymas</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">1</div>
                            <div class="col-md-4"> <a href="#">Laukas</a> </div>
                            <div class="col-md-4">( <span class="text-danger">3/4</span> )</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">2</div>
                            <div class="col-md-4"> <a href="#">Kambarys</a> </div>
                            <div class="col-md-4">( <span class="text-success">2/2</span> )</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="showActorsModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="text-align: center;" class="modal-title" id="myModalLabel">
                            Projekto <strong> {{ $project->title }} </strong> Aktoriai
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">Aktoriaus ID</div>
                            <div class="col-md-4">Aktorius</div>
                            <div class="col-md-4">Roles</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">1</div>
                            <div class="col-md-4"> <a href="#">Toma Tomaite</a> </div>
                            <div class="col-md-4"> <a href="#">Toma</a>, <a href="#">Svirksmante</a> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">2</div>
                            <div class="col-md-4"> <a href="#">Jonas Jonaitis</a> </div>
                            <div class="col-md-4"> <a href="#">Tragedijus</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editProjectModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Redaguoti <strong>{{ $project->title }} </strong>Projekta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('projektai.update', $project->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pavadinimas">Pavadinimas</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $project->title }}">
                        </div>
                        <div class="form-group">
                            <label for="aprasymas">Aprasymas</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ $project->description }}">
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

        <div class="modal fade" id="createSceneModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nauja projekto {{ $project->title }} Scena</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('projektai.scenos.store', $project->id)}}" method="post">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pavadinimas">Pavadinimas</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Laukas">
                    </div>
                    <div class="form-group">
                        <label for="aprasymas">Aprasymas</label>
                        <textarea maxlength="400" rows="4" type="text" class="form-control" name="description" id="description" placeholder="Pokalbis lauke prie mokyklos. Veikejai nusprendzia ryztis paskutiniam zingsniui, taciau Vardzius dar turi dvejoniu."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="scene_sequence_number">Scenos eiliskumas</label>
                        <select name="scene_sequence_number" id="scene_sequence_number" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                    <button type="submit" class="btn btn-primary">Sukurti Scena</button>
                </div>
            </form>
            </div>
        </div>
    </div>
        @endforeach
    </table>

    <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Naujas Projektas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('projektai.store')}}" method="post">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pavadinimas">Pavadinimas</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titanikas">
                    </div>
                    <div class="form-group">
                        <label for="aprasymas">Aprasymas</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Romantine drama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                    <button type="submit" class="btn btn-primary">Sukurti Projekta</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection