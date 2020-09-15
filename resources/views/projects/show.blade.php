@extends('layouts.master')
@section('content')
<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <h3 class="display-2 pb-3 mb-4 font-italic border-bottom">
                    <strong>{{ $data['project']->title}}</strong>
                </h3>
            </div>
            <div class="col-md-12 mb-3">
                <p>
                    {{ $data['project']->description }}
                </p>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Roles</h3>
            </div>
            <div class="col-md-12">
                <ul>
                    <li>Role 1</li>
                    <li>Role 2</li>
                </ul>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Scenos</h3>
            </div>
            <div class="col-md-12">
                <ul>
                    @foreach($data['scenes'] as $scene)
                    <li> <a href="{{ route('projektai.scenos.show', ['projektai' => $data['project']->id, 'sceno' => $scene->id ] )}}">{{ $scene->title }}</a> </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Aktoriai</h3>
            </div>
            <div class="col-md-12">
                <ul>
                    @foreach($data['actors'] as $actor)
                    <li> <a href="{{ route('aktoriai.show', $actor->id )}}">{{ $actor->first_name }} {{ $actor->last_name }}</a> </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection