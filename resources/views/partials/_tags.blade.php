<table>
    @foreach($tags as $tag)
        <tr>
            <td class="tags">
                <div class="list-group tags">
                    <a href="#" class="list-group-item">{{$tag->name}}</a>
                    </a>
                </div>
            </td>
            @if ($subscribed_tags && $subscribed_tags->contains($tag))
                <td>
                    <button type="button" class="btn btn-success disabled">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true">
                                    Subscribed
                                </span>
                    </button>
                </td>

                <td>
                    <a href="{{route('unsubscribe',[$tag])}}">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true">
                                    UnSubscribe
                                </span>
                        </button>
                    </a>

                </td>
            @else
                <td>
                    <a href="{{route('subscribe',[$tag])}}">
                        <button type="button" class="btn btn-primary" style="width: 120px">
                            <span>
                                Subscribe
                            </span>
                        </button>
                    </a>

                </td>
            @endif
        </tr>
    @endforeach
</table>