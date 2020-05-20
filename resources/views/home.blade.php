@extends('layouts.app')

@section('content')
<div class="overlay"></div>
<div class="users">
    <div class="justify-content-center" style="width:100%;">
        <div style="z-index:718;position:relative">
            {{--------- Flash Session -------}}
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if($books->count()>0)
            <div class="row" style="margin:0px">
                @foreach ($books as $book)
                    <div class="col-md-3 mt-2">
                        <div class="card" style="background-color:rgba(255, 255, 255, 0.7)  !important ">
                            <div class="card-header">                       
                            <div>  <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:100%;height:130px;border:2px solid black ;" />
                                <a href="#"><h3> {{$book->title}}</h3> </a>
                                <h5>Author: {{$book->author}}</h5>
                                <h5>Price: {{$book->price}} $</h5> 
                                <h6>{{$book->available_copies}} Availble</h6>
                            </div>
                                
                            <div class="card-body">
                                <div class="row">
                                <a href="{{route('showBook', $book->id)}}" class="btn btn-info">View</a>
                                <form  method="post">
                                    @csrf

                                    @method('delete')

                                        <a href="{{route('homeDestroy', $book->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                </form>
                                </div>
                            </div>
                            </div>

                            </div>
                    </div>
               
                @endforeach
                @else
                <h2 class="alert alert-primary text-center" style="width:50%;margin:0px auto;background-color:rgba(255, 255, 255, 0.7) !important;"> There is no Books!!</h2>
  
                @endif
            </div>

            <div class="row" style="margin:60px; margin-left:45%">
            {{ $books->fragment('foo')->links() }} 
            </div>
        </div>
    </div>
</div>
@endsection

