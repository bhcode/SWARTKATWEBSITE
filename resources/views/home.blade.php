@extends('layouts.app')

@section('content')
<div class="container">
    <p class="display-4 welcome">Dashboard</p>
    <h3>Hello {{Auth::user()->name}}!</h3>
    <p class="lead">Use the links below to modify site and user settings.</p>
    </p>
    <br>

    <!--<div class="row">
        <div class="col"><a href="weekly-data" class="btn btn-primary btnlg btn-block m-2" style="height: 200px; line-height: 200px;">Weekly Data</a></div>
        <div class="col"><a href="weekly-data" class="btn btn-primary btnlg btn-block m-2 disabled" style="height: 200px; line-height: 200px;">Monthly Data</a></div>
        <div class="col"><a href="archive" class="btn btn-primary btnlg btn-block m-2" style="height: 200px; line-height: 200px;">Archive</a></div>
    </div>-->

    <a href="archive" class="btn btn-primary btnlg btn-block m-2">Data Archive</a>

    <a href="user-profile" class="btn btn-secondary btnlg btn-block m-2">View Profile</a>
    <a href="user-settings" class="btn btn-secondary btnlg btn-block m-2">Account Settings</a>
    @can('access.admin')
        <a href="manage-farms" class="btn btn-secondary btnlg btn-block m-2">Manage Farms</a>
        <a href="modify-users" class="btn btn-secondary btnlg btn-block m-2">Modify Users</a>
    @endcan
 </div>
</div>
@endsection
