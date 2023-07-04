<div class="mb-3">
    <p>
        <x-avatar :object="$post->user" size="32" />
        <a href="/{{ '@' . $post->user->username }}"> {{ '@' . $post->user->username }}</a>
    </p>

    <div class="mb-2">
        <img src="{{ url('storage/images/' . $post->image) }}" alt="{{ $post->caption }}" class="w-100"
            height="auto" ondblclick="like({{ $post->id }})" />

    </div>
    <p class="mb-0">
        <span class="captions">{{ $post->caption }}</span>
    </p>
    <p>
        <small>
            {{ $post->created_at->diffForHumans() }} - <b>{{ $post->comments->count() }}</b> <i
                class="fa-solid fa-comment"></i>, <b class="total_count"
                id="post-likescount-{{ $post->id }}">{{ $post->likes_count }}</b> <i
                class="fa-solid fa-thumbs-up"></i>
        </small>

    </p>

    <button class="btn btn-primary btn-sm" onclick="like({{ $post->id }})" id="post-btn-{{ $post->id }}">
        {{ $post->is_liked() ? 'unlike' : 'like' }}
    </button>

    @isset($isShow)
    @else
        <a href="/post/{{ $post->id }}" class="btn btn-primary btn-sm">Komentar</a>
    @endisset

</div>
