<div class="post">
    <div class="avatar-container">
        <div class="avatar">
            <div class="avatar">
                <img src="{{ $post->user->profile_photo_url }}" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
            </div>
        </div>
        @if(Auth::check() && Auth::user()->id !== $post->user->id)
            <button class="follow-button btn-sm {{ $post->isFollowing ? 'btn-danger' : 'btn-primary' }}" data-user-id="{{ $post->user->id }}">
                {{ $post->isFollowing ? 'Unfollow' : 'Follow' }}
            </button>
        @endif
    </div>    
    <div class="contentr">
        <a href="{{ route('posts.singlepost', ['id' => $post->id]) }}" data-id="{{ $post->id }}">
        <div class="username">{{ $username }}</div> <p class="text-sm-end" style="color:lightblue">{{$jurusan}}</p>
        <div class="time">{{ $time }}</div>
        <div class="text">{{ $text }}</div>
        </a>
    </div>
    <div class="post-icons">     
        <i class="fas fa-flag report-icon" id="flagIcon"></i>
        <form id="likeForm{{$post->id}}" method="POST" action="{{ route('posts.like', $post->id) }}">
            @csrf
            @if($post->isLiked()) <!-- Anda perlu mengganti ini dengan metode yang sesuai untuk memeriksa apakah post sudah dilike -->
                <a href="#" class="like-btn" style="fill: red;" data-post-id="{{$post->id}}">
                    <x-like-logo></x-like-logo> <!-- Gunakan x-liked-logo jika post sudah dilike -->
                    <p class="text-center text-black"><sm>{{$post->likes}}</sm></p>
                </a>
            @else
                <a href="#" class="like-btn" data-post-id="{{$post->id}}">
                    <x-like-logo></x-like-logo> <!-- Gunakan x-like-logo jika post belum dilike -->
                    <p class="text-center text-black"><sm>{{$post->likes}}</sm></p>
                </a>
            @endif
        </form>
    </div>    
</div>

<!-- Pop-up container -->
<div id="popup" class="report-popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <ul>
            <li>Spam</li>
            <li>Inappropriate Content</li>
            <li>Harassment</li>
            <li>Offensive Language</li>
            <li>False Information</li>
            <li> <input type="text" class="other-input" placeholder="Other..."></li>
        </ul>
        <button class="submit-report">Submit</button>
    </div>
</div>
