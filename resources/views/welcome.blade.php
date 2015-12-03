@extends("masterpage")
@section("content")
    @if(!$tags->isEmpty())
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Posts of your subscribed Tags
                        </div>
                        <div class="panel-body">
                            @include('partials._posts')
                            {!! $posts->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="subscribeNow">
            <b>You 're not subscribed to tags yet.
                <a href="{{route('tags.index')}}">Subscribe now</a></b>
        </div>
    @endif
@endsection