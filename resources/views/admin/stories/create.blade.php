@extends('layouts.admin')

@push('custom-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.2/flatpickr.min.css" />
@endpush

@push('custom-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.2/flatpickr.min.js"></script>
<script>
$(document).ready(function() {
    var simplemde = new SimpleMDE({ element: document.getElementById('body') });

    $('#start_date').flatpickr({
        altInput: true,
        altFormat: 'd-m-Y',
        dateFormat: 'd-m-Y'
    });
});
</script>
@endpush

@section('content')
<div class="tabs is-medium">
    <ul>
        <li><a href="{{ route('radar::stories.index') }}">Explorar historias</a></li>
        <li class="is-active"><a>Registrar nueva historia</a></li>
    </ul>
</div>

<div class="box">
    {{ html()->form('POST', route('radar::stories.store'))->open() }}
    <div class="field is-required">
        {{ html()->label('Título', 'title')->class('label') }}
        <div class="control">
            {{ html()->text('title', old('title'))->class('input')->required() }}
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field is-required">
                {{ html()->label('Usuario', 'user')->class('label') }}
                <div class="control">
                    <div class="select is-fullwidth">
                        {{ html()->select('user', $users, old('user'))->placeholder('Seleccione')->required() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field is-required">
                {{ html()->label('Fecha de inicio', 'start_date')->class('label') }}
                <div class="control has-icons-left">
                    {{ html()->text('start_date', old('start_date'))->class('input')->required() }}
                    <span class="icon is-small is-left">
                        <i class="fas fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                {{ html()->label('Ingreso mensual recurrente', 'mrr')->class('label') }}
                <div class="control has-icons-left">
                    {{ html()->text('mrr', old('mrr'))->class('input') }}
                    <span class="icon is-small is-left">
                        <i class="fas fa-money-bill"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="field is-required">
        {{ html()->label('Contenido', 'body')->class('label') }}
        {{ html()->textarea('body')->class('textarea') }}
    </div>
    <button class="button is-link" type="submit">Registrar</button>
    {{ html()->form()->close() }}
</div>
@endsection
