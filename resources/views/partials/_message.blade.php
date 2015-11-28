@if (session('message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h3>{{session("message")}}</h3>
</div>
@endif