@extends('layouts.master')
@section('content')
<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-10">
                <h3 class="display-2 pb-3 mb-4 font-italic border-bottom">
                    <strong>{{ $data['scene']->title}}</strong>
                </h3>
            </div>
            <div class="col-md-10">
                <p>
                    {{ $data['scene']->description }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection