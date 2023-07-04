@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Notification</div>
                 
                <div class="card-body text-center" >
                    <ul class="list-group">
                        @foreach ($notifs as $notif)
                        <li class="list-group-item">
                          
                            <a href="
                            @if($notif->post_id)
                            /post/{{ $notif->post_id }}
                            
                            @else
                            
                            {{ '@'. $notif->from_username}}
                            @endif
                            " class="{{ ($notif->seen) ? 'text-dark' : ''}}">
                            {{ $notif->message }}
                            </a>  
                        </li>
                   @endforeach

                    </ul>
                 
                   {{-- {{ $notifs->links() }} --}}
                </div>

                <script>
                    // Request ajax
                    fetch('/notification/seen') 
                         .then(response => response.json())
                         .catch(error => console.log(error))
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
