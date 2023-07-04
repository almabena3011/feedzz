@extends('layouts.app')
@section('content')
<div class="container" id="feedContainer">
    <div class="row justify-content-center">
        <div class="col-lg-5 mb-2">
            <div class="card">
                <div class="card-header">Feed @isset($querySearch)
                    "{{ $querySearch }}"
                @endisset</div>
                 
                <div class="card-body" id="post-wrapper">
                    @forelse ($posts as $post)
                        <div>
                            <x-post :post="$post"/>
                            <br>
                        </div>                     
                        @empty 
                            <p>Tidak ada postingan</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow-sm p-3 mb-2 bg-white rounded">
                <h5><b>Pengguna Baru 😙</b></h5>
                <div class="card-body ">
                    <ul class="list-group overflow-auto">
                        @foreach($alluser as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <x-avatar :object="$user" size="28"/>
                                <a href="/{{ '@'. $user->username }}">{{'@'. $user->username }}</a>      
                            </div>
                           
                            <button class="btn btn-outline-primary btn-sm" onclick="follow({{ $user->id }}, this)">
                                {{ (Auth::user()->following->contains($user->id) ? 'UNFOLLOW' : 'FOLLOW') }}
                            </button>
                        </li>
                        @endforeach

                      </ul>
                      <a href="/findfriends" class="text-center">cari lebih banyak teman >></a>
                </div>
              </div>

              <div class="card shadow-sm p-3 bg-white rounded">
                <h5><b>Salam dari Feeds</b></h5>
                <div class="card-body bg-light">
                    <p>Halo Feedzen, yuk share foto terbaikmu ke ke lebih banyak orang lagi 🤩🤩 
                    </p>
                </div>
              </div>
              <div class="text-center">
                <small class="text-muted">Built by Albet Matthew Best Nainggolan</small>
              </div>
             
        </div>
    </div>
</div>

<script src="{{ asset('js/feed.js') }}"></script>
<script>
    function follow(id, el){
        // Route dari follow
        fetch('/follow/' + id)
            .then(response => response.json())
            .then(data => { 
                el.innerText = (data.status == 'FOLLOW') ? 'UNFOLLOW' : 'FOLLOW'
            });
    }
</script>
@endsection
