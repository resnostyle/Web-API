@extends('layout.app')

@section('content')
    <h1>Releases for @if ($category->parent != '')
            {{$category->parent->title}}->
        @endif
        {{ $category->title }}</h1>
    <h3>Total: {{ count($releases) }}</h3>

    @forelse($releases as $release)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $release->name }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{ $release->guid }}</h6>
                <ul class="list-group list-group-flush">
                    @forelse($release->groups as $group)
                        <li class="list-group-item">Group: {{ $group->name }}</li>
                    @empty
                        <li class="list-group-item">No group associated.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @empty
        <p>No releases for this category</p>
    @endforelse

@endsection