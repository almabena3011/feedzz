@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">  
            <div class="card">
            <div class="card-body">
                <x-post :post="$post" isShow="true"/>
                <hr>

               {{-- LIMIT USER TO COMMENT --}}
               @if(count($post->comments->where('user_id', $user->id)) === 3)
                  <p>Sudah berkomentar</p>
               @else
                <form method="POST" action="/post/{{ $post->id }}/comment">
                    @csrf 
                  <x-textarea-simple  name="body"/>
                  <x-submitbtn text="Post Comment" />
                </form>

               @endif
   
                @forelse ($post->comments as $comment)
                <div class="card mt-3">
                    <div class="card-body">
                      <div>
                        <x-avatar :object="$comment->user" size="32"/>
                        <a href="/{{ '@'.$comment->user->username }}"> {{'@'. $comment->user->username }}</a>
                      </div>
                     

                      <p class="card-text">{{ $comment->body }}</p>

                    
                    @if (Auth::user()->id == $comment->user_id)
                        <a href="/comment/{{ $comment->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                        <a onclick="event.preventDefault(); document.getElementById('delete-form').submit();" class="btn btn-danger btn-sm">Hapus</a>
                        <form id="delete-form" action="/comment/{{ $comment->id }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                      </form>
                    @endif

                    <button class="btn btn-warning btn-sm" onclick="like({{ $comment->id }}, 'COMMENT')" id="comment-btn-{{ $comment->id }}">
                        {{ ($comment->is_liked() ? 'unlike' : 'like') }}
                    </button>
                    <span class="total_count card-link" id="comment-likescount-{{ $comment->id }}">{{ $comment->likes_count }}</span>

                    @if($comment->isReport())
                      
                    @else
                         @if (Auth::user()->id != $comment->user_id)
                            <a href="/comment/{{ $comment->id }}/report" class="">Laporkan</a>
                        @endif
                    @endif
                     </div>
             
                </div>
                @empty
                    <p>Tidak ada komentar</p>
                @endforelse
            </div>
        </div>
    </div>
    </div>
</div>
<script src="{{ asset('js/feed.js') }}"></script>
@endsection
