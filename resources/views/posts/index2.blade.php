<div class="container">
    @if($eventPosts->isEmpty())
    <p>Tidak ada acara yang tersedia.</p>
    @else
    <div id="eventsCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($eventPosts as $index => $post)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @include('posts.events', [
                        'username' => $post->user->username,
                        'time' => $post->created_at->diffForHumans(),
                        'title' => $post->title,
                        'isOn_start' => $post->isOn_start,
                        'isOn_end' => $post->isOn_end,
                        'text' => $post->text
                    ])
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#eventsCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="carousel-control-next" href="#eventsCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Berikutnya</span>
        </a>
    </div>
@endif
</div>
