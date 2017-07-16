@extends('layouts.app')

@section('content')
    @can('manage.farms')
        <p class="display-4">Add New Farm</p>

        @if($success == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Farm has been added!
            </div>
        @endif

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

        <div class="form-group">
            {{ Form::open(['route' => ['create-farm', $type]])}}
            {{Form::token()}}
            <h3>New Farm Information</h3>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('NewFarmName', 'Name',['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::text('NewFarmName',"",['class'=>'form-control m-1'])}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('NewFarmArea', 'Area (ha)',['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::text('NewFarmArea',"",['class'=>'form-control m-1'])}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-7">
                    {{Form::submit('Save Changes',['class'=>'btn btn-primary btn-block m-1'])}}
                </div>
            </div>
            {{Form::close()}}
        </div>

    @else
        <div class="alert alert-danger" role="alert">
            <strong>Access Denied!</strong> You do not have permission to access this page.
        </div>
    @endcan
    @if(isset($type))
        @if($type = 'mf')
            <form action="/user-settings">
                <button type="submit" class="btn m-1 btn-second">Go Back</button>
            </form>
        @else
            <form action="/user-settings">
                <button type="submit" class="btn m-1 btn-second">Go Back</button>
            </form>
        @endif
    @endif
@endsection