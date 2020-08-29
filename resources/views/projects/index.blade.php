@extends('layouts.master')

@section('content')
    <h1>Projektai</h1>
    <table class="table table-striped">
    <th>#</th>
    <th scope="col">Pavadinimas</th>
    <th scope="col">Scenos</th>
    <th scope="col">Veiksmai</th>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>
                {{ $project->title }}
            </td>
            <td> 
                <span class="text-success">({{ $project->scenosTotal }})</span>
                <button type="button" data-toggle="modal" class="btn btn-primary" data-target="#showScenesModal-{{ $project->id }}">Perziureti</button>
            </td>
            <td>
                <button>Redaguoti</button>
            </td>
        </tr>
        <!-- Modals -->
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
                    <table>
                    <th scope="col">#</th>
                    <th scope="col">Pavadinimas</th>
                    <th scope="col">Veiksmai</th>
                    @foreach($project->scenes as $scene)
                        <td>{{$scene->number}}</td>
                        <td> <a href="#"> {{$scene->title}} </a> </td>
                    @endforeach
                    </table>
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </table>
@endsection