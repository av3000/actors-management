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
            <th> <a href="#">Modal dialog su nuorodomis i atskira scena...</a> </th>
            <td>
                <button>Redaguoti</button>
            </td>
        </tr>
        @endforeach
    </table>
@endsection