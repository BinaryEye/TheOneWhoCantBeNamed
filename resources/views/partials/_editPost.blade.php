<div class="form-group">
    <h4>
        <label for="inputsm" class="col-md-2 control-label">Post Content</label>
        <br/>
        {!! Form::textarea('body', null , ['class' => 'form-control input-sm posts']) !!}
    </h4>
</div>

<div class="form-group">
    <h4>
        <label for="inputsm" class="col-md-1 control-label"
               style="margin-left: 10px;">Tags</label>
        <br/>
        <br/>

        <div class="tags">
            {!! Form::select('tags[]',$tags, $selected_tags, ['id' => 'tag_list', 'class' =>
            'form-control input-sm', 'multiple']) !!}
        </div>

    </h4>
</div>
<div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary" style="margin: 190px 0 0 60px;">Post
    </button>
</div>