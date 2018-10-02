@extends('layouts.app')

@section('title', 'Configuración de mi cuenta')

@section('content')
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-two-fifths">
                @includeWhen($errors->isNotEmpty(), 'partials.errors')
                @includeWhen(session()->has('message'), 'partials.message')

                {{ html()->form('POST', route('front::profile.settings.update'))->acceptsFiles()->open() }}
                <div class="widget">
                    <div class="widget__body userSettings">
                        <h5 class="subtitle">Perfil</h5>
                        <div class="field is-required">
                            {{ html()->label('Nombre', 'name')->class('label') }}
                            <div class="control">
                                {{ html()->text('name', $loggedInUser->name)->class('input')->required() }}
                            </div>
                        </div>
                        <div class="field is-required">
                            {{ html()->label('Nombre de usuario', 'username')->class('label') }}
                            <div class="control">
                                {{ html()->text('username', $loggedInUser->username)->class('input')->required() }}
                            </div>
                        </div>
                        <div class="field">
                            {{ html()->label('Foto de perfil', 'avatar')->class('label') }}
                            <img class="avatar" src="{{ $loggedInUser->avatar_url }}">
                            {{ html()->file('avatar')->class('input-file') }}
                        </div>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget__body">
                        <h5 class="subtitle">Cuenta</h5>
                        <div class="field is-required">
                            {{ html()->label('Correo electrónico', 'email')->class('label') }}
                            <div class="control">
                                {{ html()->email('email', $loggedInUser->email)->class('input')->required() }}
                            </div>
                        </div>
                        <div class="field">
                            {{ html()->label('Contraseña', 'password')->class('label') }}
                            <div class="control">
                                {{ html()->password('password')->class('input') }}
                            </div>
                        </div>
                    </div>
                </div>

                <input class="button is-outlined is-primary is-fullwidth" type="submit" value="Guardar">
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</section>
@endsection
