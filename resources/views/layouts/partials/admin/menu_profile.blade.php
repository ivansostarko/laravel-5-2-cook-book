<ul class="list-group">
    <li class="list-group-item green">{{ trans('words.menu') }}</li>
    <li class="list-group-item"><a href="{{ route('admin.profile') }}">{{ trans('words.my_profile') }}</a></li>
    <li class="list-group-item"><a href="{{ route('admin.profile.edit') }}">{{ trans('words.edit_profile') }}</a></li>
    <li class="list-group-item"><a href="{{ route('admin.profile.password.edit') }}">{{ trans('words.edit_password') }}</a></li>

</ul>