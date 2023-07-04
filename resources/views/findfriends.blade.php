@extends('layouts.app')
@section('content')
<div class="container" id="feedContainer">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm p-3 mb-2 bg-white rounded">
                <h5 class="text-center"><b>🧑🏻👧🏻Temukan teman barumu 👱🏻‍♂️👱🏻‍♀️</b></h5>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($users as $user)
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
                        </div>
                    </div>
                </div>
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
