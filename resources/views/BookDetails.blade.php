@extends('layouts.userNavbar')
@section('content')

<div class="overlay"></div>
<div class="users">
<div class="container">
        
    <div class="row">

        <div class="col-md-3 mt-2" >
                    <div class="card" style="background-color:rgba(255, 255, 255, 0.7)  !important ">
                        <div class="card-header">                       
                            <div>  <img src="<?php echo asset('storage/'.$books->cover)?>" style="width:100%;height:130px;border:2px solid black ;" />
                            <div class="d-flex justify-content-end align-items-center">
                                {{-- <small class="text-muted"> --}}
                                    @component('components.rating')

                                    @endcomponent
                            </div>
                            <h5> {{$books->title}}</h5>
                            <h5>Author: {{$books->author}}</h5>
                            {{-- <h5>Category: {{$book->category->name}}</h5>  --}}
                            <h5>Price: {{$books->price}} $</h5> 
                            @if($books->available_copies !=0)
                            <h6>{{$books->available_copies}} Availble</h6>
                            @else
                            <h6>Not Availble</h6>
                            @endif
                            
                            
                        </div>
                            
                     
                        <button style="background-color: transparent; border: transparent;outline:none;position: absolute;left: 85%;bottom: 4%;" type="submit"><i class="fa fa-heart" style="font-size: 20px; color: red;" aria-hidden="true"></i>
                        </button>
                        </div>

                        </div>
                </div>
    
    </div>

   
</div>
</div>
</div>
@endsection
