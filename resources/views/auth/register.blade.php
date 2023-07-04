@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                       <x-input label="Username" name="username" type="text" />
                       <x-input label="Email Address" name="email" type="email" />
                       <x-input label="Password" name="password" type="password" />
                       <x-input label="Ulangi Password" name="password_confirmation" type="password" />
                       <x-submitbtn text="Daftar" />
                        {{-- <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}

                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
