@extends('layouts.app')

@section('content')

    <style type="text/css">
        body { font-size: 100%; }
        tr {font-size: 85%}
    </style>

    @can('view.data')
        <p class="display-4">Archive</p><br>
        <h3>Modify Display</h3>
        <div class="form-group">
            {{Form::open(['route' => 'archive'])}}
            {{Form::token()}}

            {{Form::label("datatype","Select Data Type")}}
            <select class="form-control" id="datatype" name="datatype">
                <option value="none" selected>All</option>
                <option value="week">Weekly</option>
                <option value="month">Monthly</option>
            </select>
            <br>
            {{Form::label("farmid","Select Farm")}}
            <select class="form-control" id="farmid" name="farmid">
                <option value="None" selected>All</option>
                @foreach($farms as $farm)
                    <option value="{{$farm->id}}">{{$farm->name}}</option>
                @endforeach
            </select>
            <br><br>
            <button type="button" class="btn btn-secondary btn-block" id="useDate">Use Date</button><br>
            <div id="dateDiv" style="display: none">
                <table width="100%">
                    <tr>
                        <td>{{Form::label("startdate","Start Date")}}</td><td>{{Form::label("enddate","End Date")}}</td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="date" value="{{$date = \Carbon\Carbon::now()->toDateString()}}" id="startdate" name="startDate"> </td>
                        <td><input class="form-control" value="{{$date = \Carbon\Carbon::now()->toDateString()}}" type="date" id="enddate" name="endDate"></td>
                    </tr>
                </table><br><br>
                <button type="submit" class="btn btn-primary btn-block" value="datesubmit" id="datesubmit" name="datesubmit">Submit</button>
            </div>
            <button type="submit" class="btn btn-primary btn-block" value="nodatesubmit" id="nodatesubmit" name="nodatesubmit">Submit</button>
            {{Form::close()}}
        </div>
        <br><br>
        <p class="lead m-2"></p>


        @if($input)
            <h3>Information for: <b> {{UInfo::getfarmname($data[0]->farmid)}}</b></h3>
        @else
            <h3>Information for: <b>All Farms</b></h3>
        @endif

            <p class="lead">Weekly Data | 4/06/2017 - 31/06/2017</p>
            <hr>
            @if($datatype == "week")
                @include('data.archive.tables.weekly-tables')
            @elseif($datatype === "month")
                <!--archive month tables-->
            @else
                @include('data.archive.tables.weekly-tables')
                <!--archive both-->
            @endif


            <!--Script for collapsing card divs-->
            <script>
                $(document).ready(function(){
                    $(".dataChild").hide();

                    $(".dataParent").click(function() {
                        $(this).next(".dataChild").slideToggle('slow', function () {
                            //change show/hide
                        });
                    });
                    $(".no-effect").click(function (e) {
                        e.stopPropagation();
                    });

                    $("#useDate").click(function() {
                        $("#dateDiv").toggle();
                        if($("#dateDiv").is(":visible"))
                        {
                            $("#nodatesubmit").hide();
                        }
                        else
                        {
                            $("#nodatesubmit").show();
                        }
                    });
                });
            </script>

        @endcan
@endsection