<ul class="list-group">
    <li class="list-group-item orange">Categories</li>
    @foreach($categories as $category)

        <li class="list-group-item"><a href="{{ route('web.category', $category->id) }}">{{ $category->name }}</a></li>

    @endforeach

</ul>