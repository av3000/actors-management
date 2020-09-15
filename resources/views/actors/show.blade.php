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
                <ul>
                    <li>Role 1</li>
                    <li>Role 2</li>
                </ul>
            </div>
            <div class="col-md-12 text-center mb-3">
            <h3>Projektai</h3>
            </div>
            <div class="col-md-12">
                <ul>
                    @foreach($data['projects'] as $project)
                    <li> <a href="{{ route('projektai.show', $project->id )}}">{{ $project->title }}</a> </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection