@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="widget">
                    <div class="widget__body">
                        <h3 class="title is-4 has-text-dark has-text-centered">Crear nuevo tema</h3>

                        {{ html()->form('POST', route('front::discussion.store'))->open() }}
                        <div class="field has-text-centered">
                            {{ html()->label('Categoría', 'category')->class('label') }}
                            <div class="control has-text-centered">
                                <div class="select">
                                    {{ html()->select('category', $categories, is_null($selectedCategory) ? old('category') : $selectedCategory)
                                        ->placeholder('Seleccione una categoría')
                                        ->required()
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            {{ html()->label('Título', 'title')->class('label') }}
                            <div class="control">
                                {{ html()->text('title', old('title'))->class('input')->required() }}
                            </div>
                        </div>
                        <br />
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control">
                                        {{ html()->textarea('body', old('body'))->class('textarea')->required() }}
                                    </div>
                                </div>
                            </div>
                            <div class="column is-one-quarter">
                                <div class="repliesBox__form__format">
                                    <div class="tag is-dark is-fullwidth">
                                        <i class="icon ion-md-color-wand"></i>
                                        <span>Formateo de texto</span>
                                    </div>
                                    <ul>
                                        <li><strong>**Negrita**</strong></li>
                                        <li><em>*Cursiva*</em></li>
                                        <li>Links automaticos</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <button class="button is-primary is-outlined" type="submit">Publicar tema</button>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
