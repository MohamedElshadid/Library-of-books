@extends('layouts.userNavbar')
@section('content')

<div class="overlay" style="height:1250px"></div>
<div class="users" style="height:1250px">
    <div class="container" style="z-index:6;position:relative">
        <div class="card" style="background-color:rgba(255, 255, 255, 0.7) !important;width:88% ">
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

                @if ($books)
                {{-- Rating: {{ $rate }} / 5
                <br /> --}}
                {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 --}}


             <b>Rate the Book:</b>
                <br />
                <form action="{{ route('books.rating', [$books->id]) }}" method="post">
                    {{ csrf_field() }}
                    <select name="rating">
                        <option value="1">1 - Awful</option>
                        <option value="2">2 - Not too good</option>
                        <option value="3">3 - Average</option>
                        <option value="4" selected>4 - Quite good</option>
                        <option value="5">5 - Awesome!</option>
                    </select>
                    <input type="submit" value="Rate" />
                </form>
                <hr />
               @endif
                    <h5 style="color:black;font-weight: bold;">Author: <strong class="text-primary" style="font-size:25px">{{$books->author}}</strong></h5>
                    <h5 style="color:black;font-weight: bold;">Category: <strong class="text-primary" style="font-size:25px">{{$books->category->name}}</strong></h5>
                    <h5 style="color:black;font-weight: bold;">Price: <strong class="text-primary" style="font-size:25px">{{$books->price}}$</strong></h5> 
                    @if($books->available_copies !=0)
                    <h6 style="color:black;font-weight: bold;"><strong>{{$books->available_copies}}</strong> Availble</h6>
                    @else
                    <h6 style="color:black;font-weight: bold;">Not Availble</h6>
                    @endif
                </div>
            </div>
            <form action="" method="">
                <textarea style="width: 53%;height: 100px;position: relative;left:2%;resize:none" placeholder="Enter Your Comment"></textarea>
                <input type="submit" class="btn btn-success btn-block" style="width: 53%;position: relative;left: 2%;font-weight: bold;" value="Add Your Comment"/>
            </form>
            <h1 class="h2" style="margin:20px">Comments</h1>
            <div class="card" style="width: 96%;position: relative;left: 2%; margin-bottom:50px">
                <div class="card-header">
                    <h3>shadid</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
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
