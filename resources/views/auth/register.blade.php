@extends('masterpage')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        @include('partials._errors')

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                            @include('partials._newUser')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection