<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="date_of_birth" value="">
<input type="hidden" name="sex" value="">

<div class="form-group">
    <label class="col-md-4 control-label">First Name</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="first_name" value="{{ old('last_name') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Last Name</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Password</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Confirm Password</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password_confirmation">
    </div>
</div>

<div class="form-group " id="dropMenu1">
    <label class="col-md-4 control-label">Sex</label>

    <div id="Sex" class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="SexButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            <span class="caret"></span>
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
            Year
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
            Month
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
            Day
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach(range(1,31) as $day)
                <li><a href="#">{{$day}}</a></li>
            @endforeach
        </ul>
    </div>


</div>


<div class="form-group" style="padding-top: 100px;">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary user">
            Register
        </button>
    </div>
</div>