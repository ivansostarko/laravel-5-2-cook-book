<ul class="list-group">
    <li class="list-group-item orange">{{ trans('words.menu') }}</li>
    <li class="list-group-item"><a href="{{ route('user.profile') }}">{{ trans('words.my_profile') }}</a></li>
    <li class="list-group-item"><a href="{{ route('user.profile.edit') }}">{{ trans('words.edit_profile') }}</a></li>
    <li class="list-group-item"><a href="{{ route('user.profile.edit.password') }}">{{ trans('words.edit_password') }}</a></li>
</ul>