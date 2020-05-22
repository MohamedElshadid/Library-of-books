
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
@forelse ($favourites as $fav)
            <div class="col-md-3 mt-2">
            <div class="card" style="background-color:rgba(255, 255, 255, 0.7)  !important ">
                            <div class="card-header">      
                            <div> 

                            <img src="<?php echo asset('storage/'.$fav->cover)?>" style="width:100%;height:130px;border:2px solid black ;" />
                                <h5> {{$fav->title}}</h5> 
                            <h5> Author : {{$fav->author}}</h5> 
                            <h5>Price : {{$fav->price}} </h5>
                            @if($fav->available_copies !=0)
                                <h6>{{$fav->available_copies}} Available</h6>
                                @else
                                <h6>Not Available</h6>
                                @endif
                                <div class="card-body">

                                <a href="{{route('books.view', $fav->book_id)}}" class="btn btn-dark">View</a>
                                @if($fav->available_copies !=0)
                                    <form action="lease/{{$fav->book_id}}" method="post">
                                        @csrf
                                        <button data-toggle="collapse" class="btn btn-info" data-target="#demo{{$fav->book_id}}">Lease</button>
                                        <div class="collapse" id="demo{{$fav->book_id}}" class="row">
                                            <input name="days" placeholder="Enter number of days"  required/>
                                            <input class="btn btn-info" value="save"  type="submit"/>
                                            <input type="hidden" name="book" value="{{$fav->book_id}}" />

                                            {{-- <a href="{{route('books.lease', $fav->book_id)}}" class="btn btn-info">save</a> --}}
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
                                    <a href="removeFav/{{$fav->book_id}}" class="btn btn-danger">Delete</a>                              
                                    <input type="hidden" id="bookID" name="bookID" value="{{$fav->book_id}}" >
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
