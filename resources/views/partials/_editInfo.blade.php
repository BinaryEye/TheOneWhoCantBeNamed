<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="date_of_birth" value="">
<input type="hidden" name="sex" value="">

<div class="form-group">
    <label class="col-md-4 control-label">First Name</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="first_name" value="{{ ucfirst(Auth::user()->first_name) }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Last Name</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="last_name" value="{{ ucfirst(Auth::user()->last_name) }}">
    </div>
</div>


<div class="form-group " id="dropMenu1">
    <label class="col-md-4 control-label">Sex</label>

    <div id="Sex" class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="SexButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            @if (Auth::user()->sex == 0)
                Male
            @else
                Female
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">Male</a></li>
            <li><a href="#">Female</a></li>
        </ul>
    </div>
</div>

<br/>
<br/>
<br/>

<div class="form-group " id="dropMenu">
    <label class="col-md-4 control-label">Date Of Birth</label>

    <div id="Years" class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="YearButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            {{Auth::user()->date_of_birth->year}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach(range(1950,\Carbon\Carbon::now()->year) as $years)
                <li><a href="#">{{$years}}</a></li>
            @endforeach
        </ul>
    </div>


    <div id="Months" class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="MonthButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            {{Auth::user()->date_of_birth->month}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach(range(1,12) as $month)
                @if($month <=9)
                    <li><a href="#">{{"0".+$month}}</a></li>
                @else
                    <li><a href="#">{{$month}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>

    <div id="Days" class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="DayButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            {{Auth::user()->date_of_birth->day}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach(range(1,31) as $day)
                <li><a href="#">{{$day}}</a></li>
            @endforeach
        </ul>
    </div>


</div>


<div class="form-group" style="padding: 100px 120px 0 0;">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary user">
            Update Info
        </button>
    </div>
</div>