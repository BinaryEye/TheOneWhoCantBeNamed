@if (isset($message))
    <div class="container" style="text-align: center">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{$message}}
        </div>
    </div>
@endif
@if (session('message'))
    <div class="container">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{(session('message'))}}
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="container">
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('warning')}}
        </div>
    </div>
@endif

@if (count($errors) > 0)
    <div class="container">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div/>

