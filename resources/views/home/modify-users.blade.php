@extends('layouts.app')
@section('content')
    @can('access.admin')

        <p class="display-4">Site Users</p>
        <h3>Modify User Roles</h3>
        @if($success == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> The user's role has been changed!
            </div>
        @endif
        <table class="table table-hover">
            <thead><tr><th>Name</th><th class="table-hide">Email</th><th class="table-hide">Current Role</th><th>Role</th><th></th></tr></thead>
            @foreach($users as $user)
                <form method="POST" action="modify-users">
                    {{ csrf_field() }}
                    <tr>
                        <td>
                            {{$user->name}}
                            <input type="hidden" value="{{$user->id}}" name="userid">
                        </td>
                        <td class="table-hide">
                            {{$user->email}}
                        </td>
                        <td  class="table-hide">{{UInfo::getrole($user->id)}}</td>
                        <td>
                            <select class="form-control" id="roleid" name="roleid">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}"> {{ucfirst($role->name)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-secondary">
                                Save
                            </button>
                        </td>
                    </tr>
                </form>
            @endforeach
        </table>
        <hr>

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