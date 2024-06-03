@extends('layouts.app')

@section('main-content')
    @include('posts.singlepost', [
        'id' => $post->id,
        'username' => $post->user->username,
        'tipe' => $post->type,
        'jurusan'=>$post->user->jurusan,
        'userid' => $post->user->id,
        'time' => $post->created_at->diffForHumans(),
        'text' => $post->text
    ])
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
