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

                @if($rate)
                    <div style="width:30%;display:inline;position:relative;left: 1%;font-size:20px">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            {{-- <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span> --}}
                            Your Rate:
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $rate)
                                <span class="fa fa-star checked"></span>
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                                
                            @endfor

                            <style>
                                .checked{
                                color: orange;
                                }

                            </style>
                        </div>
                @endif
                
                @if ($books)
                <form action="{{ route('books.rating', [$books->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="rating">
                        <input type="radio" name="rating" id="rating-5" value="5" >
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4" value="4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3" value="3">
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2" value="2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1" value="1" required>
                        <label for="rating-1"></label>
                    </div>
                        <button type="submit" class="rate btn" >Rate</button>   
                </form>
                
                @endif

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
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'placeholder'=>'Write your comment here...', 'rows'=>'5', 'style'=>'resize:none']) !!}
                        @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{ Form::hidden('book_id', $books->id) }}
                    {!! Form::submit('Add', ['class'=>'btn btn-info btn-block']) !!}
                {{ Form::close() }}
                @endif
                {{----------- List Comments -----------}}
                <h3 class="alert alert-success mt-2">Comments</h3>
                @forelse ($comments as $comment)
                    @if($comment->book_id == $books->id)
                        <div class="card border-info mb-3">
                            <div class="card-header h4 bg-warning">
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