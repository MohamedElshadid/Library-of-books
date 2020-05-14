
@extends('layouts.app')

@section('content')
<div class="overlay"></div>
<div class="users">
    <div class="row justify-content-center" style="width:50%;margin: 0 auto;">
        <div class="col-md-8" style="z-index:718;">
            {{--------- Flash Session -------}}
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            

                    <!-- list & add of categories -->

                <!-- {{-- <div class="card" style="width: 20em;background-color:rgba(255, 255, 255, 0.7) !important"> --}} -->
                    <div class="card-header" style="color:white">
                        <strong>Add Categories </strong>
                        <a  class="btn btn-success" data-toggle="collapse" href="#collapseExample"role="button" aria-expanded="false" aria-controls="collapseExample">add</a>
                        <div class="collapse" id="collapseExample">
                            <div class="form-group card card-body"  >
                                {!! Form::open(['route' => 'categories.store' ]) !!}
                                &emsp;&emsp;
                                    {!! Form::text('categories',"add category",['class'=>'form-check-input ','placeholder'=>'Enter category name']) !!}
                                        <br/><br/>
                                {!! Form::submit('Submit',['class'=>'btn btn-success ']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div> 
                    </div>
                    <!-- {{-- <ul class="list-group list-group-flush"> --}} -->
                    
                    <table class="table table-bordered table-info" style="font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                        <!-- {{-- <li class="list-group-item"> --}} -->
                                    <tr>
                                
                                        <td>
                                            <a href="{{ url('category/'.$category->id.'/')}}" style="color:black;font-weight:bold;font-size:20px;text-decoration:underline">{{$category ->name}}</a> 
                                        </td>
                            <!-- <a href="#" class="btn btn-info">update</a> -->
                                        <td>
                                            <a  class="btn btn-success" data-toggle="collapse" href="#collapseupdateform"role="button" aria-expanded="false" aria-controls="collapseupdateform">Update</a>
                                            <div class="collapse" id="collapseupdateform">
                                                {!! Form::model($category,['route' =>['categories.update',$category],'method'=>'put','class'=>'form']) !!}
                                                    <div class="form-group" >   
                                                        {!! Form::text('name',NULL,['class'=>'form-check-input']) !!}
                                                    </div>
                                                {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                                {!! Form::open(['route' => ['categories.destroy',$category],'method'=>'delete','class'=>'form']) !!}
                                                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                           
                                        </td>
                                    </tr>
                        <!-- {{-- </li> --}} -->
                              
                                @endforeach
                   
                            </tbody>
                        </table>
                    <!-- {{-- </ul> --}} -->
                       
                <!-- {{-- </div> --}} -->
                       
                   
<!-- {{--               
            </div> --}} -->
        </div>
    </div>


@endsection