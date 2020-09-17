@extends('layouts.master')
@section('content')
<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <h3 class="display-2 pb-3 mb-4 font-italic border-bottom">
                    <strong>{{ $data['actor']->first_name }} {{ $data['actor']->last_name }}</strong>
                </h3>
            </div>
            <div class="col-md-12 text-center mb-3">
                <h3>Roles</h3>
            </div>
            <div class="col-md-12">
                @if( count($data['roles']) > 0 )
                <ul>
                    @foreach($data['roles'] as $role)
                    <li> <a href="{{ route('projektai.roles.show', ['projektai' => $role->project_id, 'role' => $role->id ] )}}">{{ $role->name }}</a> </li>
                    @endforeach
                </ul>
                @else
                    <p>Aktorius neturi roliu...</p>
                @endif
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Projektai</h3>
            <div class="float-right mb-4">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#attachProjectModal">Priskirti projekta +</button>
            </div>
            </div>
            <div class="col-md-12">
                @if( count($data['actorProjects']) > 0 )
                <ul>
                    @foreach($data['actorProjects'] as $project)
                    <li> <a href="{{ route('projektai.show', $project->id )}}">{{ $project->title }}</a> </li>
                    @endforeach
                </ul>
                @else
                    <p>Aktorius neturi projektu...</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="attachProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Projekto priskyrimas aktoriui <br/> {{ $data['actor']->first_name }} {{ $data['actor']->last_name }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{route('projektai.add-actor-to-project',
             [
              'project_id' => $data['actor']->project_id,
              'actor_id' => $data['actor']->id
             ])}}"
            method="post"
        >
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="project_id">Projektu sarasas</label>
                    <select name="project_id" id="project_id" class="form-control">
                        @foreach($data['potentialProjects'] as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                <button type="submit" class="btn btn-primary">Priskirti</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection