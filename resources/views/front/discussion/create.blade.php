@extends('layouts.app')

@push('custom-css')
<link href="{{ asset('3rdparty/trumbowyg/ui/trumbowyg.min.css') }}" rel="stylesheet" />
@endpush

@push('custom-js')
<script src="{{ asset('3rdparty/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('3rdparty/trumbowyg/trumbowyg.es.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('#editor').trumbowyg({
        lang: 'es',
        autogrow: true,
        minimalLinks: true,
        removeformatPasted: true,
        resetCss: true,
        semantic: true,
        btns: [
            ['strong', 'em', 'underline', 'del'],
            ['blockquote'],
            ['link', 'insertImage']
        ]
    });
});
</script>
@endpush

@section('content')
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-7">
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
                        <div class="field">
                            <div class="control">
                                {{ html()->textarea('body', old('body'))->class('textarea')->id('editor')->required() }}
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
