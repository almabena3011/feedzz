@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">  
            <div class="card">
            <div class="card-header">All User</div>
            <div class="card-body">

                <ul class="list-group">
                @foreach ($users as $user)
                  <li class="list-group-item"><a href="{{ '/@'. $user->username }}">{{ $user->username }}</a></li>
                @endforeach
                </ul>
                  
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
