@extends('layouts.app')

@section('content')
<div class="overlay"></div>
    <div class="users">
    <table class="table table-bordered table-info" style="font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;position:relative;z-index:6">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
            <th scope="col">Available copies</th>
            <th scope="col">Book cover</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($books as $book)
            <tr>
            <td>{{$book->id}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book->author}}</td>
            <td>{{$book->price}}</td>
            <td>{{$book->available_copies}}</td>
            <td>
         

            <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:100px;height:100px;border:2px solid black ;" />
            </td>
         
<td>
            <form action="" method="post">
            @csrf
            @method('delete')
                 <a href="bookDestroy/{{$book->id}}" class="btn btn-danger">Delete</a>
            </form>
      
            </td> 
            
            </tr>
         
            @empty
             <p>No books yet !!!! </p>
         @endforelse
         
        </tbody>
</table> 

<div class="card" style="font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;position:relative;z-index:6;width:30%">
    <div class="card-header">
            add book to category
            <a  class="btn btn-success" data-toggle="collapse" href="#collapseformAddBook"role="button" aria-expanded="false" aria-controls="collapseformAddBook">Add Book</a>
            <div class="collapse" id="collapseformAddBook">
                <!-- <div class="form-group card card-body"  > -->
                    {!! Form::open(['action' => 'BookController@store', 'files' => true]) !!}
                   
                        {!! Form::label('title', 'Book Title') !!}
                     &emsp; &emsp;&emsp;  {!! Form::text('title',"",['required' => 'required','class'=>'form-check-input  ']) !!}
<br/>
                        {!! Form::label('author', 'Book Author') !!}
                        &emsp;&emsp;&emsp; {!! Form::text('author',"",['required' => 'required','class'=>'form-check-input ']) !!}
                        <br/>
                        {!! Form::label('price', 'Book Price') !!}
                        &emsp;&emsp;&emsp;  <?php echo  Form::number('price','',['min' => '0.0','required' => 'required','class'=>'form-check-input ']) ; ?>
                        <br/>
                        {!! Form::label('available_copies', 'Book Available Copies') !!}
                        &emsp;&emsp;&emsp;  <?php echo  Form::number('available_copies','',['min' => '0.0','required' => 'required','class'=>'form-check-input ']); ?>
                        <br/>
                        {!! Form::label('cover', 'Book Cover') !!}
                        &emsp;&emsp;&emsp;  {!! Form::file('cover',['required' => 'required']) !!}
                     <?php  
                       $url_segment = \Request::segment(2); 
                      
                     ?>
                        {{ Form::hidden('category_id',$url_segment)}}
                        
                       
                            <br/><br/>
                    {!! Form::submit('Submit',['class'=>'btn btn-success ']) !!}
                    {!! Form::close() !!}

                  
                <!-- </div> -->
            </div> 
    </div>
</div>   
</div>
    
@endsection