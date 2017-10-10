@extends('layout.app')

@section('content')
    <ul>
        <li>{{ $user->username }}</li>
        <li>{{ $user->email }}</li>
    </ul>

@endsection