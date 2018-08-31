@include(config('settings.themeIncludes').'.displayMessages')

{!! Form::open(['route'=>['backend.role.update',$role->id],
'method' => 'put','class'=>'uk-form-horizontal uk-background-muted uk-padding-small uk-margin-small']) !!}

<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Name</label>
    <div class="uk-form-controls">
        {!! Form::text('name',$role->name,["class"=>'uk-input' ]) !!}
    </div>
</div>

<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Role status</label>
    <div class="uk-form-controls">
        {!! Form::select('active',[0=>'Activated',1=>'Disabled'],$role->active,["class"=>'uk-select' ]) !!}
    </div>
</div>
<button class="uk-button uk-button-secondary uk-button-small">Submit</button>
</form>