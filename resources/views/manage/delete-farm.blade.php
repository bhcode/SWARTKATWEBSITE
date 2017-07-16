@extends('layouts.app')

@section('content')
    @can('manage.farms')
        <p class="display-4">Modify Farm</p>


        <h3>Record Deleted</h3>

        <div class="row p-1">
            <div class="col-sm-9">
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> The {{$farmname}} farm record has been deleted
                </div>
            </div>
        </div>

        <div class="row p-1">
            <div class="col-sm-9">
                <a href="/manage-farms" class="btn btn-primary btn-block m-1">Return</a>
            </div>
        </div>
    @endcan
@endsection