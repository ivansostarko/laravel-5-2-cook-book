<ul class="list-group">
    <li class="list-group-item orange">{{ trans('words.menu') }}</li>
    <li class="list-group-item"><a href="{{ route('user.items') }}">{{ trans('words.my_items') }}</a></li>
    <li class="list-group-item"><a href="{{ route('user.items.create') }}">{{ trans('words.add_new_recipe') }}</a></li>
</ul>