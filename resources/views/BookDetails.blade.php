@extends('layouts.userNavbar')
@section('content')

<div class="overlay" style="height:1250px"></div>
<div class="users" style="height:1250px">
    <div class="container" style="z-index:6;position:relative">
        {{--------- Flash Session -------}}
        @if(Session::has('success'))
            <div class="alert alert-success col-10 offset-1">
                {{ Session::get('success') }}
            </div>
        @endif
        
        <div class="card col-10 offset-1" style="background-color:rgba(255, 255, 255, 0.7) !important;width:88% ">
            <div class="card-header row">
                <button style="background-color: transparent; border: transparent;outline:none;position: absolute;left: 85%;top:0;" type="submit">
                    <i class="fa fa-heart" style="font-size: 31px; color: red;" aria-hidden="true"></i>
                </button>                    
                <div class="col-md-4">
                    <img src="<?php echo asset('storage/'.$books->cover)?>" style="width:280px;height:220px;border:2px solid black ;" >
                </div>
                <div class="col-md-8">
                    <h5 style="color:black;font-weight: bold;"> Title: <strong class="text-primary" style="font-size:25px">{{$books->title}}</strong>
                        <div style="width:30%;display:inline;position:relative;left: 10%;">
                            {{-- <small class="text-muted"> --}}
                                @component('components.rating')

                                @endcomponent
                        </div>
                    </h5>
                    <h5 style="color:black;font-weight: bold;">Author: <strong class="text-primary" style="font-size:25px">{{$books->author}}</strong></h5>
                    <h5 style="color:black;font-weight: bold;">Category: <strong class="text-primary" style="font-size:25px">{{$books->category->name}}</strong></h5>
                    <h5 style="color:black;font-weight: bold;">Price: <strong class="text-primary" style="font-size:25px">{{$books->price}}$</strong></h5> 
                    @if($books->available_copies !=0)
                    <h6 style="color:black;font-weight: bold;"><strong>{{$books->available_copies}}</strong> Available</h6>
                    @else
                    <h6 style="color:black;font-weight: bold;">Not Available</h6>
                    @endif
                </div>
            </div>
            {{--------------- Add Comments ----------------}}
            <div class="container mt-2 mb-2">
                @if (Auth::check())
                    {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class'=>'form-control','placeholder'=>'Write your comment here...']) !!}
                        @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{ Form::hidden('book_id', $books->id) }}
                    {!! Form::submit('Add', ['class'=>'btn btn-info btn-block']) !!}
                {{ Form::close() }}
                @endif
                {{----------- List Comments -----------}}
                <h3 class="alert alert-warning mt-2">Comments</h3>
                @forelse ($comments as $comment)
                    <p>{{ $comment->user->username }} </p>
                    <p>{{ $comment->user_id }}</p>
                    <p>{{ $comment->created_at }}</p>
                    <p>{{ $comment->body }}</p>
                    <p>{{ $comment->book->title }}</p>
                    <p>{{ $comment->book_id }}</p>
                    <hr>
                @empty
                    <p class="alert alert-danger">This Book has no comments</p>
                @endforelse
                {{------------- End of Comments --------------}}
            </div>           
        </div>
        <div class="book" style="z-index:11">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($relbooks as $rel)
                    <div class="swiper-slide">
                        <div class="imgBx">
                        <img src="<?php echo asset('storage/'.$rel->cover)?>" >
                        </div>
                        <div class="details">
                            <h3>Title<br><span>{{$rel->title}}</span></h3>
                            <h3>Auther<br><span>{{$rel->author}}</span></h3>
                        </div>
                    </div>
                    @endforeach
                    
                  
                  
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
@endsection
