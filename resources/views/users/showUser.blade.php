@extends('layouts.app')

@section('content')
<div class="overlay"></div>
    <div class="users">
       

        <div style="z-index: 222;position: relative;">
          

            <table class="table table-bordered table-info" style="width:50%;margin: 10px auto;font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;">
                
                <thead>
                <h2 class="alert alert-primary text-center" style="width:50%;margin:0px auto;background-color:rgba(255, 255, 255, 0.7) !important;"> All Users</h2>
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
                        <td> <a href="{{route('users.makeAdmin', $users)}}" class="btn btn-success">Make Admin</a>
                        
                        @if($users->active == 0)
                        <a href="{{route('users.activate', $users)}}" class="btn btn-success">activate</a>

                        @elseif($users->active == 1)
                        <a href="{{route('users.deactivate', $users)}}" class="btn btn-danger">deactivate</a>

                        @endif
                    </td>
                    </tr>
                    {{-- @empty
                   <tr>
                    <h2 class="h3 alert alert-primary"> There is no users !!!</h2>
                </tr> --}}
                @endforeach
                            
                </tbody>
              </table>

        </div>
    </div>

@endsection