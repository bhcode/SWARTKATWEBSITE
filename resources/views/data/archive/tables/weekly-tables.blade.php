<!--Table archive for weekly-archive-->
@if(count($weeklydata)>0)
    <div class="card m-2">
        <div class="card-header dataParent">Weekly Data (Test)
        </div>
        <div class="dataChild card-block" style="height:300px; overflow: auto">
            <table class="table">
                <thead class="thead-inverse">
                <tr>
                    <th>Entry ID</th>
                    <th>Farm ID</th>
                    <th>Date Added</th>
                    <th>Label</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < count($weeklydata); $i++)
                <tr>
                    <td>{{$weeklydata[$i]->entryid}}</td>
                    <td>{{$weeklydata[$i]->farmid}}</td>
                    <td>{{$weeklydata[$i]->created_at}}</td>
                    <td>{{$weeklydata[$i]->label}}</td>
                    <td>{{$weeklydata[$i]->data}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endif
