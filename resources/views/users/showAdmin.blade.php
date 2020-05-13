@extends('layouts.app')

@section('content')
    <div class="container col-4 offset-4 mt-3">
        <div>
            <h2 class="h3 alert alert-success"> All Admins</h2>
        </div>

        <div>
           
            <table class="table table-bordered table-success">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $users)
                    <tr>
                        <td> {{$users->username}} </td>
                        <td> {{$users->email}} </td>
                        <td> <img src="upload/{{$users->image}}" style="width:60px; height:60px" /> </td>

                        <td> <a href="{{route('users.removeAdmin', $users)}}" class="btn btn-success">Remove Admin</a></td>
                    </tr>
                  
                    @endforeach
                            
                </tbody>
              </table>

        </div>
    </div>

@endsection