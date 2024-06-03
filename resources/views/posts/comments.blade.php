{{-- @if(isset($comments))
    <p>Belum ada komentar.</p>
@else --}}
    @foreach ($comments as $comment)
        <div class="mb-2">
            <strong>{{ $comment->user->name }}</strong>:
            {{ $comment->comment }}
            @if (Auth::id() == $comment->user_id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            @endif
        </div>
    @endforeach
{{-- @endif --}}

@auth
    <form action="{{ route('comments.store',  ['postId' => $post->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="comment">Add Comment</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" required></textarea>
            @error('comment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endauth
