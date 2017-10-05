@extends('layouts.app')

@section('content')
    @forelse($releases as $release)
        <ul>
            <li>{{ $release->name }}</li>
            <li>{{ $release->guid }}</li>
            <li>
                @if ($release->category->parent != '')
                    {{$release->category->parent->title}}->
                @endif
                {{ $release->category->title }}</li>
        </ul>
    @empty
        <p>No releases for this category</p>
    @endforelse

    @endsection