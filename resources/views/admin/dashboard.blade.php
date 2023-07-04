@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">  
            <div class="card">
            <div class="card-header">Administrator Dashboard</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="/dashboard/users">All User</a></li>
                            <li class="list-group-item"><a href="">All Report</a></li>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
