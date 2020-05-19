@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Users Graphs</h1>
    <div class="row">
        <div class="col-8" style="margin:0 auto">
            <div class="card rounded">
                <div class="card-body py-3 px-3">
                {!! $Chart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

{!! $Chart->script() !!}
@endsection