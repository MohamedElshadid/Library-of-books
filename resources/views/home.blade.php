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
            
            <div class="card" style="background-color:rgba(255, 255, 255, 0.7) !important">
                <div class="card-header">Dashboard</div>
                @if(Auth::user()->is_admin==1)
                    <h2>Hello Admin </h2>

             
                   
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

