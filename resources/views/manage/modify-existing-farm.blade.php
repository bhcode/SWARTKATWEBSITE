@extends('layouts.app')

@section('content')
    @can('manage.farms')
        <p class="display-4">Modify Farm</p>


        <h3>Modify {{$farm->name}}'s Information</h3>

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

        @if($success  == 1)
                <div class="row p-1">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-7">
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> Changes have been applied to your account
                        </div>
                    </div>
                </div>
        @endif


        <div class="form-group">
            {{ Form::open(['route' => ['modify-existing-farm', $farm->id]])}}
            {{Form::token()}}
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('ModFarmName', 'Name',['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::text('ModFarmName',"",['class'=>'form-control m-1'])}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('ModFarmArea', 'Area',['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::text('ModFarmArea',"",['class'=>'form-control m-1'])}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('Delete Farm', 'Delete Farm',['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    <a href="/delete-farm/{{$farm->id}}" class="btn btn-secondary btn-block m-1" id="remove">Delete Farm</a>
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

        <form action="/manage-farms">
            <button type="submit" class="btn m-1 btn-second">Go Back</button>
        </form>

    @endcan
@endsection