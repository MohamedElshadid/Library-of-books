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
                {{----------------------- Collective HTML ----------------------}}
                <div class="text-center mb-2">
                    <img src="{{ asset('upload/' . Auth::user()->image) }}" style="width:70%;height:70%;border-radius:50%">
                </div>

                {!! Form::model($user,['route' =>['users.updateAdmin',$user],'method'=>'patch' , 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group" >
                        {!! Form::text('username',NULL,['class'=>'form-control mb-2']) !!}
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {!! Form::email('email',NULL,['class'=>'form-control mb-2' , 'readonly']) !!}
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- {!! Form::file('image' , ['class'=>'form-control mb-2']) !!}
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror --}}

                        {!! Form::password('old_password',['class'=>'form-control mb-2' , 'placeholder'=>'Old Password']) !!}
                        @error('old_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{--------- Flash Session -------}}
                        @if(Session::has('danger'))
                            <div class="alert alert-danger">
                                {{ Session::get('danger') }}
                            </div>
                        @endif

                        {!! Form::password('new_password',['class'=>'form-control mb-2' , 'placeholder'=>'New Password (or confirm as old password)']) !!}
                        @error('new_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {!! Form::submit('Update',['class'=>'btn btn-primary col-12']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        </div>
    </div>
@endsection