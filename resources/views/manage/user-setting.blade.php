@extends('layouts.app')

@section('content')
    <!--Build using Laravel Collective's Forms & HTML | Doc: https://laravelcollective.com/docs/master/html#text-->

    <p class="display-4">Settings</p>

    <!--Display Errors-->
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

    <!--Display Custom Errors-->
    @if($success  == 1)
        @if(isset($warning))
            <div class="row p-1">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-7">
                    <div class="alert alert-danger" role="alert">
                        <strong>Warning!</strong> {{$warning}}
                    </div>
                </div>
            </div>
        @else
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
    @endif

    <!--Modify Email-->

    <div class="form-group">
        {{ Form::open(['route' => 'user-settings'])}}
        {{Form::token()}}
        <h3>Edit Email</h3>
        <div class="row p-1">
            <div class="col-sm-2">
                {{Form::label('NewEmail', 'New Email', ['class'=>'m-1'])}}
            </div>
            <div class="col-sm-7">
                {{Form::email('NewEmail',"",['class'=>'form-control m-1'])}}
            </div>
        </div>

        <!--Modify Farm-->
        @can('manage.farms')
            <h3>Change Farm</h3>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('NewFarm', 'Change Farm', ['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">

                    <select name="NewFarm" class="form-control m-1">
                        <option disabled selected>Select a Farm</option>
                        @foreach($farms as $f)
                            <option value="{{$f->id}}">{{$f->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1">
                    <a href="create-farm/us" class="btn btn-secondary m-1">+</a>
                </div>
            </div>
            @endrole

        <!--Change password-->

            <h3>Change Password</h3>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('NewPassword', 'New Password', ['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::password('NewPassword',['class'=>'form-control m-1'])}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-sm-2">
                    <i>{{Form::label('NewPassword_confirmation', 'Confirm Password', ['class'=>'m-1'])}}</i>
                </div>
                <div class="col-sm-7">
                    {{Form::password('NewPassword_confirmation',['class'=>'form-control m-1'])}}
                </div>
            </div>

            <!--Password is needed to confirm changes-->

            <h3>Confirm Changes</h3>
            <div class="row p-1">
                <div class="col-sm-2">
                    {{Form::label('CurrentPassword', 'Current Password', ['class'=>'m-1'])}}
                </div>
                <div class="col-sm-7">
                    {{Form::password('CurrentPassword',['class'=>'form-control m-1'])}}
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

    <form action="/home">
        <button type="submit" class="btn m-1 btn-second">Go Back</button>
    </form>
@endsection