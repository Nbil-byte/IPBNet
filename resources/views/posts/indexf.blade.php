<div class="container">
    <h1>All Posts</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        @foreach($posts as $post)
            @if($post->type === 'post')
                @include('posts.posts', [
                    'id' => $post->id,
                    'username' => $post->user->username,
                    'jurusan'=>$post->user->jurusan,
                    'userid' => $post->user->id,
                    'time' => $post->created_at->diffForHumans(),
                    'text' => $post->text
                ])
            @endif
        @endforeach
    @endif
</div>
