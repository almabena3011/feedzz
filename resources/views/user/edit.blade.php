@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">  
            <div class="card">
            <div class="card-header">Update Profilmu, {{ $user->username }}</div>
            <div class="card-body">
                <form method="POST" action="/user/edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                   <x-input label="Username" name="username" type="text" :object="$user" />
                   <x-input label="Fullname" name="fullname" type="text" :object="$user"/>
                   <x-input label="Biodata" name="bio" :object="$user"/>
                   <div class="row mb-3">
                    <label for="avatar" class="col-md-4 col-form-label text-md-end">Avatar</label>
                        <div class="col-md-6">
                            <input type="file" name="avatar" id="avatar">
                            @if ($user->avatar)
                                <img src="{{ asset("images/avatar/". $user->avatar) }}" alt="" width="200px" class="mt-3">
                            @else
                                <strong>belum ada foto profil nih</strong>
                            @endif
                           
                        </div>
                        @if($errors->has('avatar'))
                        <span class="invalid-feedback" role="alert">
                           {{ $errors->first('avatar') }}
                       </span>
                     @endif
                   </div>
                  
                  
                 

                   <x-submitbtn text="Update Profile" />
                
                  
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
