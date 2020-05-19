
@extends('layouts.userNavbar')
@section('content')

<div class="overlay"></div>
<div class="users">
    <nav style="position:relative;z-index:8">
        <form action="" method="GET" style="display:inline-block;width:30%">
            <a class="text-light" style="font-size:20px"> Order By : </a>
            {{-- <label >order by : </label> --}}
            <input class="btn btn-success btn-lg" type="submit" name="latest" value="latest">
            <input class="btn btn-success btn-lg" type="submit" name="rate" value="rate">
            <input type="hidden" name="sortdata" value="">
            <input type="hidden" name="sortvalue" value="">
        </form>

        <form class="form-inline" action="{{route('search')}}" method="GET" style="display:inline-block;width:20%;position: absolute;left: 77%;">
            <input class="form-control mr-sm-2" type="text" placeholder="search" name="search">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">
        </form>
    </nav>
<div class="d-flex py-5 " style="position:relative;z-index:8">
    <div class="list-group" style="width:18%">
        @isset($catagory)
        <a class="list-group-item list-group-item-action active" style="background-color: #2d995b !important;font-size:20px" href="">All Categories</a>
        @foreach ($catagory as $item)
        <a class="list-group-item list-group-item-action" style="color:black;font-weight:bold;font-size:20px;text-decoration:underline" target="_blank" href="{{ url('cat/'.$item->id.'/' )}}"> {{$item->name}}</a>
        @endforeach
        @endisset

      </div>
    <div class="container">
        
        <div class="row">

            @forelse ($books as $book)
            <div class="col-md-3 mt-2">
                        <div class="card" style="background-color:rgba(255, 255, 255, 0.7)  !important ">
                            <div class="card-header">                       
                                <div>  <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:100%;height:130px;border:2px solid black ;" />
                                <div class="d-flex justify-content-end align-items-center">
                                    {{-- <small class="text-muted"> --}}
                                        @component('components.rating')

                                        @endcomponent
                                </div>
                                <h5> {{$book->title}}</h5>
                                <h5>Author: {{$book->author}}</h5>
                                <h5>Category: {{$book->category->name}}</h5>
                                <h5>Price: {{$book->price}} $</h5> 
                                @if($book->available_copies !=0)
                                <h6>{{$book->available_copies}} Availble</h6>
                                @else
                                <h6>Not Availble</h6>
                                @endif
                                
                                
                            </div>
                                
                            <div class="card-body">

                                <a href="{{route('books.view', $book)}}" class="btn btn-dark">View</a>
                                @if($book->available_copies !=0)
                                    <form action="lease/{{$book->id}}" method="post">
                                        @csrf
                                        <button data-toggle="collapse" class="btn btn-info" data-target="#demo{{$book->id}}">lease</button>
                                        <div class="collapse" id="demo{{$book->id}}" class="row">
                                            <input name="days" placeholder="Enter number of days"  required/>
                                            <input class="btn btn-info" value="save"  type="submit"/>
                                            <input type="hidden" name="book" value="{{$book}}" />

                                            {{-- <a href="{{route('books.lease', $book)}}" class="btn btn-info">save</a> --}}
                                        </div>       
                                    </form>
                                @else
                                <a href="" class="btn btn-danger">Lease</a>
                                @endif
                             
                            </div>
                            <!-- heart shape button  -->
                            <!-- <div class="heart-shape"> -->
                            <form action="{{ action('FavouriteController@store') }}" method="post">
                            {{csrf_field()}}
                                <input type="submit" value="add to favourites" class="btn btn-success"> 
                               
                                <input type="hidden" id="bookID" name="bookID" value="{{$book->id}}">
                             </form>
                             
                             <form action="" method="get">
                            {{csrf_field()}}
                            
                            @method('delete')
                            <a href="removeFav/{{$book->id}}" class="btn btn-danger">Delete</a>                              
                                <input type="hidden" id="bookID" name="bookID" value="{{$book->id}}" >
                             </form>
                                

                            <!-- </div> -->
                         
                            </div>
                           
                            </div>
                    </div>
            @empty
                <h1>No Books</h1>
            @endforelse
        </div>
       
       

        <div class="row" style="margin:30px; margin-left:40%">
            {{ $books->links() }} 
            </div>
            
        </div>
    </div>
</div>
</div>

@endsection
