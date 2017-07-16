@extends('layouts.app')
@section('content')
    @can('access.admin')
        <p class="display-4">Manage Farms</p>

        @if (count($errors) > 0)
            <div class="row p-1">
                <div class="col-sm-9">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger m-1">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($success == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Farm's have been assigned
            </div>
        @endif

        <h3>Add New Farm</h3>
        <a href="create-farm/mf" class="btn btn-secondary btnlg btn-block p-2">Add New Farm</a>
        <br><hr><br>
        <h3>Modify Farms</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Farm</th>
                <th>Details</th>
                <th>Modify Farm</th>
            </tr>
            </thead>
            @foreach($farms as $f)
            <tr>
                <td>{{$f->name}}</td>
                <td><a href="farm-details/{{$f->id}}">Details</a></td>
                <td><a href="modify-existing-farm/{{$f->id}}" class="btn btn-secondary">
                        Modify
                    </a>
                </td>
            </tr>
                @endforeach
        </table>

        <form action="/home">
            <button type="submit" class="btn m-1 btn-second">Go Back</button>
        </form>

    @else
        <div class="alert alert-danger" role="alert">
            <strong>Access Denied!</strong> You do not have permission to access this page.
        </div>

        <form action="/home">
            <button type="submit" class="btn m-1 btn-second">Go Back</button>
        </form>
    @endcan
@endsection