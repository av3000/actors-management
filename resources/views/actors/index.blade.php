@extends('layouts.master')

@section('content')
    <table>
    <th>Vardas</th>
    <th>Pavarde</th>
        @foreach($actors as $actor)
        <tr>
            <td>
                {{ $actor->first_name }}
            </td>
            <td>
                {{ $actor->last_name }}
            </td>
        </tr>
        @endforeach
    </table>
@endsection