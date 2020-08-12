
@extends('layouts.userNavbar')
@section('content')

<div class="users">
<nav style="position:relative;z-index:8">
   
<!-- serach form-->
        <form class="form-inline" action="{{route('search')}}" method="GET" style="display:inline-block;width:20%;position: absolute;left: 77%;">
            <input class="form-control mr-sm-2" type="text" placeholder="search" name="search">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">
        </form>
<!--end  serach form-->        
    </nav>
    <div class="d-flex py-5 " style="position:relative;z-index:8">
    <div class="container">
        
        <div class="row">   
@forelse ($books as $book)
            <div class="col-md-4 col-lg-3 mt-2">
            <div class="card" style="background-color:rgba(255, 255, 255, 0.7)  !important ">
                            <div class="card-header">      
                            <div> 

                            <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:100%;height:130px;border:2px solid black ;" />
                            <h5> {{$book->title}}</h5> 
                           <h5> Author : {{$book->author}}</h5> 
                           <h5>Price : {{$book->price}} </h5>
                           @if($book->available_copies !=0)
                                <h6>{{$book->available_copies}} Availble</h6>
                                @else
                                <h6>Not Availble</h6>
                                @endif
                                <div class="card-body">

                                <a href="{{route('books.view', $book->id)}}" class="btn btn-dark">View</a>
                                @if($book->available_copies !=0)
                                    <form action="lease/{{$book->id}}" method="post">
                                        @csrf
                                        <button data-toggle="collapse" class="btn btn-info" data-target="#demo{{$book->id}}">lease</button>
                                        <div class="collapse" id="demo{{$book->id}}" class="row">
                                            <input name="days" placeholder="Enter number of days"  required/>
                                            <input class="btn btn-info" value="save"  type="submit"/>
                                            <input type="hidden" name="book" value="{{$book->id}}" />

                                            {{-- <a href="{{route('books.lease', $book->id)}}" class="btn btn-info">save</a> --}}
                                        </div>       
                                    </form>
                                @else
                                <a href="" class="btn btn-danger">Lease</a>
                                @endif
                             
                                </div><!-- class card-body-->
                                <div class="card-footer">
                                <form action="" method="get">
                                    {{csrf_field()}}
                                    
                                    @method('delete')
                                    <a href="removeFav/{{$book->id}}" class="btn btn-danger">Delete</a>                              
                                    <input type="hidden" id="bookID" name="bookID" value="{{$book->id}}" >
                             </form>
                            </div>
                          
                            </div>                     
           
            </div><!-- class card-header -->
            </div><!-- class card-->
        </div><!-- div class col-md-3 mt-2 -->
        @empty
                <h1>No Books</h1>
            @endforelse
            </div><!-- row-->
            
            </div><!-- container-->
            </div><!-- class d-flex py-5-->
</div><!-- div class users  -->
@endsection
