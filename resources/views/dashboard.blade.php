@extends('layouts.app')

@section('main-content')
    <div class="text-center mb-4">
        <h1>What's up, Ruruzen!</h1>
        <div class="btn-group" role="group" aria-label="View toggle">
            <a href="{{ route('dashboard', ['view' => 'for-you']) }}" class="btn btn-primary {{ request('view', 'for-you') === 'for-you' ? 'active' : '' }}">
                For You Page
            </a>
            <a href="{{ route('dashboard', ['view' => 'following']) }}" class="btn btn-primary {{ request('view') === 'following' ? 'active' : '' }}">
                Following
            </a>
        </div>
    </div>
    @if(request('view', 'for-you') === 'following')
        @include('posts.indexf', ['posts' => $posts])
    @else
        @include('posts.index', ['posts' => $posts])
    @endif
@endsection

@section('events-content')
    <div class="headers">Event</div>
    <div class="flex-container">
        <div class="events-section flex-item">
            @include('posts.index2', ['eventPosts' => $eventPosts])
        </div>
    </div>
@endsection

@section('news-content')
    <div class="headers">News</div>
    <div class="flex-container">
        <div class="events-section flex-item">
            @include('posts.index1', ['newsPosts' => $newsPosts])
        </div>
    </div>
@endsection
