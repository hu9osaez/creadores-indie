@extends('layouts.admin')

@section('content')
<div class="tabs is-medium">
    <ul>
        <li class="is-active"><a>Explorar historias</a></li>
        <li><a href="{{ route('radar::stories.create') }}">Registrar nuevo historia</a></li>
    </ul>
</div>

<div class="box">
    <table class="table is-fullwidth is-sortable">
        <thead>
        <tr>
            <th>Título</th>
            <th>Fecha inicio</th>
            <th>Usuario</th>
            <th class="no-sort"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($stories as $story)
            <tr>
                <td>{{ $story->title }}</td>
                <td>{{ $story->started_date }}</td>
                <td>{{ $story['user']['name'] }}</td>
                <td>
                    <a href="#" class="button is-link is-tiny is-outlined">Ver</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
