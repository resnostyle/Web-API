@extends('layout.app')

@section('content')
    <ul>
        <li>{{ $user->username }}</li>
        <li>{{ $user->email }}</li>
        <li>Roles:
            <ul>
                @foreach($user->roles as $role)
                    <li>{{ $role->display_name }}:
                        <ul>
                            @foreach($role->perms as $permission)
                                <li>{{ $permission->display_name }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>

@endsection