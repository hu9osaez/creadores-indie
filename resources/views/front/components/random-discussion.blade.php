<div class="category-viewing">
    <div class="category-viewing__circle" style="background-color: {{ $category->bg_color }}"></div>
    Otros temas en "{{ $category->name }}"
</div>

@include('front.partials.loop-discussions', ['discussions' => $discussions, 'isRandomDiscussions' => true])
