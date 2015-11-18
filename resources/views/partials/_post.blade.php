<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Post</div>
                <div class="panel-body">
                    <div class="col-md-1 posts">
                        {{$post->body}}
                        <br/>
                        <br/>
                        <strong>Related Tags:</strong>
                        <br/>
                        <br/>

                        <div class="list-group tags">
                            @foreach($post->tags()->lists('name') as $tag)
                                <a href="#" class="list-group-item">{{$tag}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>