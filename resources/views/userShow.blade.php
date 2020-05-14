@extends('layouts.app')
@section('content')
    <div class="search">
        <form action="" method="GET">
            <input type="text" placeholder="search" name="search">
            <input type="submit" value="search">
        </form>
    </div>
    <div class="orderby">
        <form action="" method="GET">
            <label>order by : </label>
            <input type="submit" name="latest" value="latest">
            <input type="submit" name="rate" value="rate">
            <input type="hidden" name="sortdata" >
            <input type="hidden" name="sortvalue" >
        </form>
    </div>
        <div class="sidebar">
            <h1 class="sidebartitle">select by category</h1>
            <a href=""><button>all categories</button></a>
            <a href=""><button>shadid</button></a>
        </div>
        <div class="books-list">
                <div class="books-card">
                    <div class="book-header">Title</div>
                    <div class="book-body">Description</div>
                    <div class="book-footer">lease_price</div>
                        <form action="" method="POST">
                        @csrf
                            <input type="submit" value="delete from favorites">
                            <input type="hidden" name="book_id" >
                            <input type="hidden" name="source" value="index">
                        </form>

                        <form action="" method="POST">
                            @csrf
                            <input type="submit" value="add to favorites">
                        </form>
                    
                    
                </div> 
        </div>      
@endsection