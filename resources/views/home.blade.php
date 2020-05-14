@extends('layouts.app')

@section('content')
<div class="overlay"></div>
<div class="users">
    <div class="row justify-content-center" style="width:50%;">
        <div class="col-md-8" style="z-index:718;">
            {{--------- Flash Session -------}}
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
<table>
    <tr>
    <div class="row">

       
    @foreach ($books as $book)
    <td>
    <div class="card  " style="background-color:rgba(255, 255, 255, 0.7)  !important width:150px;;height:350px; margin-left:10px">
        <div class="card-header">                       
           <div>  <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:150px;height:100px;border:2px solid black ;" />
           </div> 
            <a href="#"><h3> {{$book->title}}</h3> </a>
            <h5>Author: {{$book->author}}</h5>
            <h5>Price: {{$book->price}} $</h5> 
            <h6>{{$book->available_copies}} Availble</h6>
            </div>
              
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    @method('delete')
                        <a href="{{route('homeDestroy', $book->id)}}" class="btn btn-danger">Delete</a>
                    </form>
            
            </div>
        </div>

    </div>
    
</td>
  

    {{-- @empty
    <p>No books yet !!!! </p> --}}
@endforeach
</div>
</tr>
</table>         
</div>
</div>
   

@endsection

