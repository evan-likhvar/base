
{!! Form::open(['route'=>['backend.role.store'],
'class'=>'uk-form-horizontal uk-background-muted uk-padding-small uk-margin-small']) !!}

<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Name</label>
    <div class="uk-form-controls">
        {!! Form::text('name',null,["class"=>'uk-input' ]) !!}
    </div>
</div>


<button class="uk-button uk-button-secondary uk-button-small">Submit</button>
</form>
