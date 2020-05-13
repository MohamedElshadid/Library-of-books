

@extends ('layouts.app')
@section('content')
    {!! Form::open(['route' => 'categories.store']) !!}
        <div class="form-group" >
            <label for="exampleInputEmail1" width="100px">phone number</label>&emsp;&emsp;&emsp;
            {!! Form::text('categories',"add your number",['class'=>'form-check-input','placeholder'=>'Please enter your phone number']) !!}
          <br/><br/><br/>  <small  class="form-text text-muted">We'll never share your phone with anyone else.</small>
        </div>
        <br/>
        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}

        
  {!! Form::close() !!}
@endsection