@include(config('settings.themeIncludes').'.displayMessages')

{!! Form::open(['route'=>['backend.language.store'],
'class'=>'uk-form-horizontal uk-background-muted uk-padding-small uk-margin-small']) !!}

<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Name</label>
    <div class="uk-form-controls">
        {!! Form::text('name',null,["class"=>'uk-input' ]) !!}
    </div>
</div>
<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Full name</label>
    <div class="uk-form-controls">
        {!! Form::text('full_name',null,["class"=>'uk-input' ]) !!}
    </div>
</div>

<button class="uk-button uk-button-secondary uk-button-small">Submit</button>
</form>
