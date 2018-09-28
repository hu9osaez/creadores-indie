<div class="sidebar">
    <a class="sidebar__newDiscussion" href="{{ route('front::discussion.create') }}">
        Crear nuevo tema
    </a>
    <p class="subtitle is-5 has-text-grey-light">Categorías</p>
    <ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('front::category.show', $category->slug) }}">
                <span class="circle" style="background-color: {{ $category->color }}"></span>
                {{ $category->name }}
            </a>
        </li>
    @endforeach
    </ul>
</div>
