<div class="container">
    <!-- Menampilkan pesan kesalahan validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="trends-container">
        <div class="trend-info">
            <div class="trend-title">{{ $post->title }}</div>
            <div class="trend-time">
                {{ $post->isOn_start ? $post->isOn_start->format('d M Y, H:i') : 'N/A' }} - 
                {{ $post->isOn_end ? $post->isOn_end->format('d M Y, H:i') : 'N/A' }}
            </div>
            <div class="trend-text">{{ substr($post->text, 0, 150) }}{{ strlen($post->text) > 30 ? '...' : '' }}</div>
            @if($post->isOn_start && $post->isOn_end)
                <a href="{{ route('posts.singlepost', ['id' => $post->id]) }}" data-id="{{ $post->id }}">
                    @if(now()->between($post->isOn_start, $post->isOn_end))
                        <div class="live-now">Live Now</div>
                    @elseif(now() < $post->isOn_start)
                        <div class="live-now">Coming Soon</div>
                    @elseif(now() > $post->isOn_end)
                        <div class="live-now">Ended</div>
                    @endif
                </a>            
            @endif
        </div>
    </div>
</div>
