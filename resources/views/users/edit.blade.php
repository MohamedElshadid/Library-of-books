@extends('layouts.app')

@section('content')
<div class="overlay"></div>

    <div class="users">

        <div style="position: relative;z-index: 8;">
            <p class="h3 alert alert-info text-center" style="width:30%;margin: 20px auto;">Update Profile</p>

            <form method="post" action="{{route('users.update', $user)}}" enctype="multipart/form-data" style="width:30%;margin: 0 auto;">
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

                {{-- <img src="upload/{{ Auth::user()->image }}" style="width:70px;height:70px;border-radius:50%"> --}}
{{-- 
                <input id="image" type="file" value="{{ Auth::user()->image }}" class="form-control mb-2" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}

                <input class="form-control mb-2" type="password" name="password" placeholder="New Password"/>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input class="form-control mb-2" type="password" name="password_confirmation" placeholder="Confirm password" />
                
                <input type="submit" value="Update"
                    class="mt-1 form-control  btn btn-primary btn-lg">

                <a href="{{ route('home') }}"><input type="button" value="Back to home"
                    class="mt-1 form-control  btn btn-success btn-lg">
                </a>
            </form>
        </div>
    </div>

@endsection
