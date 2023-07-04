@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">  
            <div class="card">
            <div class="card-header">Edit Caption</div>
            <div class="card-body">
                <form method="POST" action="/post/{{ $post->id }}">
                    @csrf 
                    @method("PUT")
                   <div class="row mb-3">
                        <label for="" class="col-md-4 col-form-label text-md-end">Foto</label>
                        <div class="col-md-6">
                            <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->caption }}" width="100" />
                        </div>
                   </div>
                  
                  <x-textarea  name="caption" label="caption kamu" :object="$post" />
                  
                  <x-submitbtn text="Update Post" />
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
