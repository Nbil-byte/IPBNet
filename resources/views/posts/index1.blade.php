<div class="container">

    @if($newsPosts->isEmpty())
    <p>Tidak ada berita yang tersedia.</p>
    @else
    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($newsPosts as $index => $post)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @include('posts.news', [
                        'username' => $post->user->username,
                        'time' => $post->created_at->diffForHumans(),
                        'title' => $post->title,
                        'text' => $post->text,
                        'user' => Auth::user(),
                    ])
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Berikutnya</span>
        </a>
    </div>
@endif
</div>
