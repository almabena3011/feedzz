@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 8vh;">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/login/network.png') }}" class="w-50" alt="">
                <h3 class="mt-4">Berbagi foto dan cerita terbaikmu</h3>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <x-input label="Alamat Email" name="email" type="email" />
                            <x-input label="Kata Sandi" name="password" type="password" />
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ingat saya') }}
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <x-submitbtn text="Masuk" />

                            {{-- <div class="row mb-0">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                            </div> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
