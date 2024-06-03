<div class="post">
    <div class="avatar-container">
        <div class="avatar">
            <img src="{{ $post->user->profile_photo_url }}" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
        </div>
        @if(Auth::check() && Auth::user()->id !== $post->user->id)
            <button class="follow-button btn-sm {{ $post->isFollowing ? 'btn-danger' : 'btn-primary' }}" data-user-id="{{ $post->user->id }}">
                {{ $post->isFollowing ? 'Unfollow' : 'Follow' }}
            </button>
        @endif
    </div>    
    <div class="contentr">
        <div class="username">{{ $username }}</div> <p class="text-sm-end" style="color:lightblue">{{$jurusan}}</p>
        <div class="time">{{ $time }}</div>
        @if($tipe=="post")
            <div class="text"> {{$text}} </div>
            {{-- @dd($post->comments) --}}
            @include('posts.comments',['comments'=>$post->comments])
        @endif
        @if($tipe=="event")
            <div class="container text-center">
                <h3 class="display-5 text-uppercase">{{ $post->title }}</h3>
            </div>
            <div class="tanggal">Event starts at: {{ $post->isOn_start ? $post->isOn_start->format('d M Y, H:i') : 'N/A' }}</div>
            <div class="tanggal">Event ends at: {{ $post->isOn_start ? $post->isOn_start->format('d M Y, H:i') : 'N/A' }}</div>
            <div class="text-info mt-3"> {{$text}} </div>
            @include('posts.comments',['comments'=>$post->comments])
        @endif
        @if($tipe=="news")
            <div class="container text-center">
                <h3 class="display-5 text-uppercase">{{ $post->title }}</h3>
            </div>
            <div class="text-info"> {{$text}} </div>
            @include('posts.comments',['comments'=>$post->comments])
        @endif
        <div class="text-end p-3 mt-5">
            <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
        </div>
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
