@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{--------- Flash Session -------}}
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            
            <div class="card">
                <div class="card-header">Dashboard</div>
                @if(Auth::user()->is_admin==1)
                    <h2>Hello Admin </h2>


                    <!-- list & add of categories -->

<div class="card" style="width: 20em;">
            <div class="card-header">
                    categories 
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
                       
<br/><br/><br/>
                        <ul class="list-group list-group-flush">
                       
                            @forelse ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ url('category/'.$category->id.'/')}}">{{$category ->name}}</a>
                                <!-- <a href="#" class="btn btn-info">update</a> -->

                                <a  class="btn btn-success" data-toggle="collapse" href="#collapseupdateform"role="button" aria-expanded="false" aria-controls="collapseupdateform">Update</a>
                                <div class="collapse" id="collapseupdateform">
                                
                                    {!! Form::model($category,['route' =>['categories.update',$category],'method'=>'put']) !!}
                                        <div class="form-group" >
                                            
                                        {!! Form::text('name',NULL,['class'=>'form-check-input']) !!}
                                            <br/><br/><br/>   
                                        </div>
                                    <br/>
                                    {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                                {!! Form::open(['route' => ['categories.destroy',$category],'method'=>'delete']) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                           
                            </li>
                            @empty
                                <p>No categories yet !!!! </p>
                            @endforelse
                        </ul>
                       
                     </div>
                       
                   









                   
                @else
                    <h2>Hello {{Auth::user()->username}}</h2>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                    </div>
            </div>
        </div>
    </div>
</div>


                     @endsection


