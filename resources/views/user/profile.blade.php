@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"> {{ $user->username }}</div>
                 
                <div class="card-body text-center" >
                    <x-avatar :object="$user"/>
                    <h3 class="mb-0">{{ $user->fullname }}</h3>
                    <p class="mb-0">{{ $user->bio }}</p>
                    <div class="row">
                        
                        @if(Auth::user()->id == $user->id)
                            <div class="flex">
                                <a href="/user/edit" class="btn btn-primary btn-sm w-50">Edit Profil</a>
                            </div>
                        @else
                            <div class="flex">
                                <button class="btn btn-primary btn-sm w-50" onclick="follow({{ $user->id }}, this)">
                                    {{ (Auth::user()->following->contains($user->id) ? 'UNFOLLOW' : 'FOLLOW') }}
                                </button>
                            </div>               
                        @endif


                      
                    </div>
                 
                  
                   
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Pengikut</th>
                            <th scope="col">Mengikuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="totalFollower">{{ $user->follower()->count() }}</td>
                                <td> {{ $user->following()->count() }}</td>
                          
                            </tr>
                        </tbody>
                    </table>
                                
                   
                  
                    <h3 class="mt-3">Feed</h3>
                    <div class="row">
                    @foreach ($user->posts as $post)
                        <div class="col-md-6">
                            <a href="/post/{{ $post->id }}">
                            <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->caption }}" width="100%" height="auto"/>
                            </a>
                            <br>
                            @if(Auth::user()->id == $user->id)
                                 <a href="/post/{{ $post->id }}/edit">Edit</a>
                            @endif
                           
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<script>
    function follow(id, el){
        // Route dari follow
        fetch('/follow/' + id)
            .then(response => response.json())
            .then(data => { 
                    let followsCount = document.getElementById('totalFollower') 
                    let currentCount = 0
                    if(data.status == 'FOLLOW'){
                        currentCount = parseInt(followsCount.innerHTML) + 1
                        el.innerText = 'UNFOLLOW'
                    } else {
                        currentCount = parseInt(followsCount.innerHTML) - 1
                        el.innerText = 'FOLLOW'
                    }
                    followsCount.innerHTML = currentCount
            });
    }
</script>
@endsection
