@extends("masterpage")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a new Post</div>
                    <div class="panel-body">
                        @include('partials._errors')

                        <!--

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts/create') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <h4>
                                    <label for="inputsm" class="col-md-2 control-label">Post Content</label>
                                </h4>
                                <br/>
                                <input class="form-control input-sm posts" id="inputsm" type="text" name="body">

                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-left: 60px">Post
                                    </button>
                                </div>
                                !-->

                        {!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'action' =>
                        ['PostController@store']])!!}
                        @include('partials._newPost')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection