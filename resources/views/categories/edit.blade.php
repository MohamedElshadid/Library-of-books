

@extends ('layouts.app')
@section('content')

    {!! Form::model($category,['route' =>['categories.update',$category],'method'=>'put']) !!}
        <div class="form-group" >
            
            {!! Form::text('categories',NULL,['class'=>'form-check-input']) !!}
          <br/><br/><br/>   
       </div>
        <br/>
        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}

        
  {!! Form::close() !!}
@endsection