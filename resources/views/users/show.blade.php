@extends("masterpage")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (session('message'))
                        <div class="alert alert-success"">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h3>{{session("message")}}</h3>
                        </div>
                    @endif
                    <div class="panel-heading">My Info</div>
                    <div class="panel-body">

                        <div class="info-group">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <label class="col-md-4 control-label">{{ucfirst(Auth::user()->first_name)}}</label>
                            </div>
                        </div>

                        <div class="info-group">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <label class="col-md-4 control-label">{{ucfirst(Auth::user()->last_name)}}</label>
                            </div>
                        </div>

                        <div class="info-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <label class="col-md-4 control-label">{{Auth::user()->email}}</label>
                            </div>
                        </div>

                        <div class="info-group">
                            <label class="col-md-4 control-label">Age</label>

                            <div class="col-md-6">
                                <label class="col-md-4 control-label">
                                    {{Carbon\Carbon::now()->diffInYears(Auth::user()->date_of_birth)}}
                                </label>
                            </div>
                        </div>

                        <div class="info-group">
                            <label class="col-md-4 control-label">Sex</label>

                            <div class="col-md-6">
                                <label class="col-md-4 control-label">
                                    @if(Auth::user()->sex==0)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{url('/users/' . Auth::user()->id . '/edit')}}" class="btn btn-primary linkbutton"
                               role="button">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection