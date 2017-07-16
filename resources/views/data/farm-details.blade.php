@extends('layouts.app')

@section('content')
    @can('manage.farms')
        <p class="display-4">Farm Details</p>

        <h3>Farm Name</h3>
        <div class="row p-1">
            <div class="col-sm-9">
                <p>{{$farm->name}}</p>
            </div>
        </div>

        <h3>Farm Area</h3>
        <div class="row p-1">
            <div class="col-sm-9">
                <p>{{$farm->area}} (ha)</p>
            </div>
        </div>

        <h3>Users Assigned</h3>
        <div class="row p-1">
            <div class="col-sm-9">
                <ul class="list-group">
                    @foreach($usernames as $un)
                    <li class="list-group-item">{{$un}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <button onclick="goBack()" class="btn m-1 btn-second">Go Back</button>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    @endcan
@endsection