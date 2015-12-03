<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$post->title}}</div>
                <div class="panel-body">
                    @include('partials._avatar')
                    <br/>
                    <div class="col-md-0 posts">
                        {{$post->body}}
                        <br/>
                        <br/>
                        <div class="votes">
                            <a href="{{route('upVote',[$post])}}">
                                <button type="button" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">
                                    {{$post->upVotes()}}
                                </span>
                                </button>
                            </a>
                            <a href="{{route('downVote',[$post])}}">
                                <button type="button" class="btn btn-default btn-lg">
                                    <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true">
                                        {{$post->downVotes()}}
                                    </span>
                                </button>
                            </a>
                        </div>
                        <strong>Related Tags:</strong>
                        <br/>
                        <br/>

                        <div class="list-group tags">
                            @foreach($post->tags()->get() as $tag)
                                <a href="{{route('tags.show',[$tag])}}" class="list-group-item">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>