@extends('layouts.app')


@section('content')
<div class="overlay"></div>
    <div class="users">
        <div style="z-index: 222;position: relative;">
        <div class="container col-4 offset-4 mt-3">
            <div>
                <p class="h3 alert alert-info">Update Profile</p>
            </div>

            <div>
                <form method="post" action="{{route('users.updateAdmin', $user)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <input class="form-control mb-2" type="text" name="username"  value="{{ $user->username }}" />
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input class="form-control mb-2" type="email" name="email"  value="{{ $user->email }}" readonly />
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- <img src="asset('upload/{{ Auth::user()->image }}')" style="width:70px;height:70px;border-radius:50%"> --}}
                    
                    {{-- {{ HTML::image('images/4.PNG/'.Auth::user()->image) }} --}}
                    
                    {{-- <input id="image" type="file" value="{{ Auth::user()->image }}" class="form-control mb-2" name="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}

                    <input class="form-control mb-2" type="password" name="password" placeholder="New Password"/>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input class="form-control mb-2" type="password" name="password_confirmation" placeholder="Confirm password" />
                    
                    <input type="submit" value="Update"
                        class="mt-1 form-control  btn btn-success btn-lg">
{{-- 
                    <a href="{{ route('home') }}"><input type="button" value="Back to home"
                        class="mt-1 form-control  btn btn-success btn-lg">
                    </a> --}}
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection