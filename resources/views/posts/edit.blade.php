@extends("masterpage")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a new Post</div>
                    <div class="panel-body">
                        {!! Form::model($post, ['class' => 'form-horizontal', 'method' => 'Put', 'action' =>
                        ['PostController@update',$post]])!!}
                        @include('partials._editPost')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection