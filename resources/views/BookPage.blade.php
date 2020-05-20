@extends('layouts.userNavbar')
@section('content')

<div class="overlay" style="height:1250px"></div>
<div class="users" style="height:1250px">
    <div class="container" style="z-index:6;position:relative">
        {{--------- Flash Sessions -------}}
        @if(Session::has('addSuccess'))
            <div class="alert alert-success col-10 offset-1">
                {{ Session::get('addSuccess') }}
            </div>
        @endif
        @if(Session::has('deleteSuccess'))
            <div class="alert alert-success col-10 offset-1">
                {{ Session::get('deleteSuccess') }}
            </div>
        @endif
        {{-------- End Flash Sessions -------}}
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
                {{----------- List Comments -----------}}
                <h3 class="alert alert-primary mt-2">Comments</h3>
                @forelse ($comments as $comment)
                    @if($comment->book_id == $books->id)
                        <div class="card border-info mb-3">
                            <div class="card-header h4 bg-info">
                                <span>{{ $comment->user->username }}</span>
                                <span class="float-right">{{ $comment->created_at->format('d M , H:i:s') }}</span>
                            </div>
                            <div class="card-body h5">
                                <p class="card-text">{{ $comment->body }}</p>
                                @if($comment->user_id == Auth::id())
                                    {!! Form::open(['route'=>['comments.destroy',$comment] , 'method'=>'delete' ]) !!}
                                    {!! Form::submit("Delete", ["class"=>"btn btn-danger" , "onclick"=>"return confirm('Are you sure you want to delete this comment?')"]) !!}
                                @endif
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="alert alert-danger">This Book has no comments yet !!</p>
                @endforelse
                {{------------- End of Comments --------------}}
                <a href="{{route('home')}}" class="btn btn-success">Back To All Books..</a>
<br>
            </div>       
    
        </div>
       
    </div>
</div>
@endsection