@extends('layouts.master')

@section('content')
    <table>
    <th>Pavadinimas</th>
    <th>Veiksmai</th>
        @foreach($projects as $project)
        <tr>
            <td>
                {{ $project->title }}
            </td>
            <td>
                <button>Redaguoti</button>
            </td>
        </tr>
        @endforeach
    </table>
@endsection