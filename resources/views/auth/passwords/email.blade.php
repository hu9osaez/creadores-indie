@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-one-third">
                    <div class="box">
                        <h3 class="title is-4 has-text-dark has-text-centered">Restablecer la contraseña</h3>

                        @if (session('status'))
                        <div class="notification is-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{ html()->form('POST', route('password.email'))->open() }}
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
                                <div class="control">
                                    {{ html()->button('Enviar', 'submit')->class('button is-fullwidth is-primary') }}
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
