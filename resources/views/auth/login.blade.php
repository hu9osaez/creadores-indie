@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-one-third">
                    <div class="box">
                        <h3 class="title is-4 has-text-dark has-text-centered">Iniciar sesión</h3>

                        {{ html()->form('POST', route('login'))->open() }}
                        <div class="field">
                            {{ html()->label('Correo electrónico', 'email')->class('label') }}
                            <div class="control">
                                {{ html()->email('email', old('email'))
                                    ->class('input is-medium')
                                    ->required()
                                    ->if($errors->has('email'), function ($el) {
                                        return $el->addClass('is-danger');
                                    })
                                }}
                            </div>
                            @if ($errors->has('email'))
                            <p class="help is-danger" role="alert">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            {{ html()->label('Contraseña', 'password')->class('label') }}
                            <div class="control">
                                {{ html()->password('password')
                                    ->class('input is-medium')
                                    ->required()
                                    ->if($errors->has('password'), function ($el) {
                                        return $el->addClass('is-danger');
                                    })
                                }}
                            </div>
                            @if ($errors->has('password'))
                            <p class="help is-danger" role="alert">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox">
                                            {{ html()->checkbox('remember')->checked(old('remember') ? true : false) }}
                                            <span class="is-size-7">Mantenerme conectado</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <a class="is-size-7" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                {{ html()->button('Ingresar', 'submit')->class('button is-fullwidth is-primary') }}
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
