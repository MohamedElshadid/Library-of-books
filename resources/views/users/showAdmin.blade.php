@extends('layouts.app')

@section('content')
<div class="overlay"></div>
    <div class="users">

        <div style="z-index: 222;position: relative;">
        @if($users->count()>0)
        <table class="table table-bordered table-success" style="width:50%;margin: 10px auto;font-weight:bold;background-color:rgba(255, 255, 255, 0.7) !important;">
                <thead>
                <h2 class="alert alert-primary text-center" style="width:50%;margin:0px auto;background-color:rgba(255, 255, 255, 0.7) !important;"> All Admins</h2>
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
              @else
              <h2 class="alert alert-primary text-center" style="width:50%;margin:0px auto;background-color:rgba(255, 255, 255, 0.7) !important;"> There is no admins !!</h2>

              @endif

        </div>
    </div>

@endsection