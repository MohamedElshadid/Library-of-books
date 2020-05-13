@extends('layouts.app')

@section('content')
    <div class="container col-4 offset-4 mt-3">
       
        <div>
            <h2 class="h3 alert alert-primary"> All Users</h2>
        </div>

        <div>
          

            <table class="table table-bordered table-info">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @forelse($users as $users)
                    <tr>
                        <td> {{$users->username}} </td>
                        <td> {{$users->email}} </td>
                        <td> <img src="upload/{{$users->image}}" style="width:60px; height:60px" /> </td>
                        <td> <a href="{{route('users.makeAdmin', $users)}}" class="btn btn-danger">Make Admin</a></td>
                        
                    </tr>
                    @empty
                   <tr>
                    <h2 class="h3 alert alert-primary"> There is no users !!!</h2>
                </tr>
                    @endforelse
                            
                </tbody>
              </table>

        </div>
    </div>

@endsection