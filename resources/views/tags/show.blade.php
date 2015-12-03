@extends('masterpage')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($tag)
                            Posts of {{$tag->name}} Tag
                        @else
                            Posts of your subscribed Tags
                        @endif
                    </div>
                    <div class="panel-body">
                        @include('partials._posts')
                        {!! $posts->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection