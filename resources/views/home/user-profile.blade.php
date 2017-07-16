@extends('layouts.app')

@section('content')
    <p class="display-4">Profile</p>

    <div class="row p-1">
        <div class="col-sm-5">
            <h3>Username <i class="material-icons">&#xE88F;</i></h3>
            <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
            <br>
            <h3>Email <i class="material-icons">&#xE0BE;</i></h3>
            <p>{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
            <br>
            <h3>Farm <i class="material-icons">&#xE0C8;</i></h3>
            <p>@if($farm === "None")<span class='text-muted'>@endif{{$farm}} @if($farm === "None")</span>@endif</p>
            <br>
        </div>
        <div class="col-sm-5">
            <h3>Role Assigned <i class="material-icons">&#xE7FF;</i></h3>
            <p>{{UInfo::getrole(Auth::id())}}</p>
        </div>
    </div>

    <button onclick="goBack()" class="btn m-1 btn-second">Go Back</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
