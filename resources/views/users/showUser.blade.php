@extends('layouts.app')

@section('content')
<div class="overlay"></div>
    <div class="users">
       

        <div style="z-index: 222;position: relative;">
          

            <table class="table table-bordered table-info" style="width:50%;margin: 0 auto;font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;">
                
                <thead>
                <h2 class="alert alert-primary text-center" style="width:50%;margin:20px auto"> All Users</h2>
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