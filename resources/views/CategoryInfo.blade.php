@extends('layouts.app')

@section('content')
<div class="overlay"></div>
    <div class="users">
    @if(count($books)>0)
    <table class="table table-bordered table-info" style="font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;position:relative;z-index:6">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
            <th scope="col">Available copies</th>
            <th scope="col">Book cover</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
            <td>{{$book->title}}</td>
            <td>{{$book->author}}</td>
            <td>{{$book->price}}</td>
            <td>{{$book->available_copies}}</td>
            <td>
            <img src="<?php echo asset('storage/'.$book->cover)?>" style="width:100px;height:100px;border:2px solid black ;" />
            </td>
         <td>
         <a class="btn btn-info"data-toggle="collapse" href="#collapseupdateform{{$book->id}}" role="button" aria-expanded="false" aria-controls="collapseupdateform">Update</a>
                
         <div class="collapse" id="collapseupdateform{{$book->id}}">
                                             
                                             {!! Form::model($book,['route' =>['updateBook',$book->id],'method'=>'put','class'=>'form','files'=> true ])  !!}
                                                 <div class="form-group" >   
                                                     {!! Form::text('title',NULL,['class'=>'form-control']) !!}
                                                      {!! Form::text('author',NULL,['class'=>'form-control']) !!}
                                                      {!! Form::number('price',NULL,['class'=>'form-control']) !!}
                                                      {!! Form::number('available_copies',NULL,['class'=>'form-control']) !!}
                                                     
                                                     <br/>   {!! Form::file('cover',['required' => 'required']) !!}

                                                 </div>
                                                 {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
                                             {!! Form::close() !!}
                                         </div>
         </td>

            <td>
            <form action="" method="post">
            @csrf
            @method('delete')
                 <a href="bookDestroy/{{$book->id}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </form>
            </td> 
            </tr> 
      

         @endforeach
         
        </tbody>
</table> 
@else
<h2 class="alert alert-primary text-center" style="width:50%;margin:10px auto;background-color:rgba(255, 255, 255, 0.7) !important;"> There is no Books!!</h2>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 

<div class="card" style="font-weight:bold;margin:10px auto;background-color:rgba(255, 255, 255, 0.7) !important;position:relative;z-index:6;width:30%">
    <div class="card-header">
            add book to category
            <a  class="btn btn-success" data-toggle="collapse" href="#collapseformAddBook"role="button" aria-expanded="false" aria-controls="collapseformAddBook">Add Book</a>
            <div class="collapse" id="collapseformAddBook">
                <!-- <div class="form-group card card-body"  > -->
                    {!! Form::open(['action' => 'BookController@store', 'files' => true]) !!}
                   
                        {!! Form::label('title', ' Title') !!}
                     &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {!! Form::text('title',"",['required' => 'required','class'=>'form-check-input  ']) !!}
<br/><br/>
                        {!! Form::label('author', ' Author') !!}
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {!! Form::text('author',"",['required' => 'required','class'=>'form-check-input ']) !!}
                        <br/><br/>
                        {!! Form::label('price', ' Price') !!}
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo  Form::number('price','',['min' => '0.0','required' => 'required','class'=>'form-check-input ']) ; ?>
                        <br/><br/>
                        {!! Form::label('available_copies', ' Available Copies') !!}
                        &emsp;&emsp;&emsp;  <?php echo  Form::number('available_copies','',['min' => '0.0','required' => 'required','class'=>'form-check-input ']); ?>
                        <br/><br/>
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