@extends("masterpage")
@section("content")
    <div class="container">
        @if (session("welcome"))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session("welcome")}}
            </div>
        @endif
    </div>
    @include('partials._avatar')

@endsection