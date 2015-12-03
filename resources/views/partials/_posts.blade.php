@foreach($posts as $post)
    <div class="list-group" style="width: 80%">
        <a href="{{route('posts.show',[$post])}}">{{$post->title}}
        </a>
    </div>
@endforeach
<br/>
<br/>
<br/>