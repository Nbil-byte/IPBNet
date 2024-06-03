<div class="container">
    <div class="trends-container">
        <div class="trend-info">
            <a href="{{ route('posts.singlepost', ['id' => $post->id]) }}" data-id="{{ $post->id }}">
                <div class="trend-user">{{ $username }}</div>
                <div class="trend-time">{{ $time }}</div>
                <div class="trend-title">{{ $title }}</div>
                <div class="trend-text">{{ $text }}</div>

                @if(isset($user) && isset($post->user) && $post->user->id == $user->id)
                    @if($post->found==0)
                        <form action="{{ route('news.updateStatus', $post->id) }}" class="form-inline" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-sm btn-success">Mark as Found</button>
                        </form>
                    @else
                    <div class="d-flex justify-content-center container rounded bg-info text-white">Found</div>
                    @endif
                @else
                    <div class="trend-status">
                        {{ $post->found ? 'Found' : 'Not Found' }}
                    </div>
                @endif
            </a>
        </div>
    </div>
</div>