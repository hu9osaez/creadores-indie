@extends('layouts.app')

@push('custom-js')
    {!! NoCaptcha::renderJs('es') !!}
@endpush

@section('title', 'Únete a la comunidad')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-one-third">
                    <div class="box">
                        <h3 class="title is-4 has-text-dark has-text-centered">Únete a {{ config('app.name') }}</h3>

                        {{ html()->form('POST', route('register'))->open() }}
                        <div class="field">
                            {{ html()->label('Nombre', 'name')->class('label') }}
                            <div class="control">
                                {{ html()->text('name', old('name'))
                                    ->class('input is-medium')
                                    ->required()
                                    ->if($errors->has('name'), function ($el) {
                                        return $el->addClass('is-danger');
                                    })
                                }}
                            </div>
                            @if ($errors->has('name'))
                            <p class="help is-danger" role="alert">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            {{ html()->label('Nombre de usuario', 'username')->class('label') }}
                            <div class="control">
                                {{ html()->text('username', old('username'))
                                    ->class('input is-medium')
                                    ->required()
                                    ->if($errors->has('username'), function ($el) {
                                        return $el->addClass('is-danger');
                                    })
                                }}
                            </div>
                            @if ($errors->has('username'))
                                <p class="help is-danger" role="alert">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
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
                        <div class="field field-recaptcha">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                            <p class="help is-danger" role="alert">{{ $errors->first('g-recaptcha-response') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                {{ html()->button('Crear cuenta', 'submit')->class('button is-fullwidth is-primary') }}
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
