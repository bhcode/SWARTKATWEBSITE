
@extends('layouts.app')

@section('content')

    <p class="display-3">Weekly Data</p>

    <!--Display Success Message-->
    @if($success  == 1)
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> Your data has been saved!
        </div>
    @endif
    @if($success == 2)
        <div class="alert alert-danger">
            <strong>Uh-Oh!</strong> You must be assigned to a farm to save data!
        </div>
    @endif

    <div class="form-group">
        {{Form::open(['route' => 'weekly-data'])}}
        {{Form::token()}}


        <div class="card m-2">
            <div class="card-header dataParent">Basic Information</div>
            <div class="dataChild card-block">
                <!--for loops-->
                @for($i = 1; $i<3; $i++)
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-sm-3" style="border-right:1px solid #cecdd0">
                            {{Form::label($weeklydatas[$i]->label, $weeklydatas[$i]->label, ['class'=>'m-1'])}}
                        </div>

                        <div class="col-sm-6 p-1">
                            {{Form::text($weeklydatas[$i]->label,"",['class'=>'form-control m-1'])}}
                        </div>
                        <div class="col"></div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="card m-2">
            <div class="card-header dataParent">Area Information</div>
            <div class="dataChild card-block">
                <!--for loops-->
                @for($i = 3; $i<10; $i++)
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-sm-3" style="border-right:1px solid #cecdd0">
                            {{Form::label($weeklydatas[$i]->label, $weeklydatas[$i]->label, ['class'=>'m-1'])}}
                        </div>

                        <div class="col-sm-6 p-1">
                            {{Form::text($weeklydatas[$i]->label,"",['class'=>'form-control m-1'])}}
                        </div>
                        <div class="col"></div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="card m-2">
            <div class="card-header dataParent">Milking Information</div>
            <div class="dataChild card-block">
                <!--for loops-->
                @for($i = 10; $i<18; $i++)
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-sm-3" style="border-right:1px solid #cecdd0">
                            {{Form::label($weeklydatas[$i]->label, $weeklydatas[$i]->label, ['class'=>'m-1'])}}
                        </div>

                        <div class="col-sm-6 p-1">
                            {{Form::text($weeklydatas[$i]->label,"",['class'=>'form-control m-1'])}}
                        </div>
                        <div class="col"></div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="card m-2">
            <div class="card-header dataParent">Other Information</div>
            <div class="dataChild card-block">
                <!--for loops-->
                @for($i = 18; $i<26; $i++)
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-sm-3" style="border-right:1px solid #cecdd0">
                            {{Form::label($weeklydatas[$i]->label, $weeklydatas[$i]->label, ['class'=>'m-1'])}}
                        </div>

                        <div class="col-sm-6 p-1">
                            {{Form::text($weeklydatas[$i]->label,"",['class'=>'form-control m-1'])}}
                        </div>
                        <div class="col"></div>
                    </div>
                @endfor
            </div>
        </div>
        <br /><hr /><br />
        {{Form::submit('Save Changes',['class'=>'btn btn-primary btn-block'])}}
        {{Form::close()}}
    </div>


    <br />

    <form action="/home">
        <button type="submit" class="btn btn-second">Go Back</button>
    </form>

    <script>
        $(document).ready(function(){
            $('input[type="text"]').keyup(function(){
                if($(this).val() != "") {
                    $(this).css('background-color', '#ccf6f9');
                }
                else {
                    $(this).css('background-color', '#ffffff');
                }
            });

            //$(".dataChild").hide();

            $(".dataParent").click(function() {
                $(this).next(".dataChild").slideToggle('slow', function () {
                    //change show/hide
                });
            });
            $(".no-effect").click(function (e) {
                e.stopPropagation();
            });

        });
    </script>

    <!--warn before leaving https://stackoverflow.com/questions/7317273/warn-user-before-leaving-web-page-with-unsaved-changes-->
@endsection