@include(config('settings.themeIncludes').'.displayMessages')

{!! Form::open(['route'=>['backend.user.store'],
'method' => 'post','class'=>'uk-form-horizontal uk-background-muted uk-padding-small uk-margin-small']) !!}


<div class=" uk-text-left uk-text-small uk-grid-match" uk-grid>
    <div class="uk-width-2-5@m">
        <div class="uk-card uk-card-default uk-card-body uk-padding-small">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Name</label>
                <div class="uk-form-controls">
                    {!! Form::text('name',null,["class"=>'uk-input uk-form-small' ]) !!}
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Email</label>
                <div class="uk-form-controls">
                    {!! Form::text('email',null,["class"=>'uk-input uk-form-small']) !!}
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">language_id</label>
                <div class="uk-form-controls">
                    {!! Form::select('language_id',[$languages],config('settings.defaultCountryLanguage'),["class"=>'uk-select uk-form-small' ]) !!}
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">active</label>
                <div class="uk-form-controls">
                    {!! Form::select('active',[0=>'No',1=>'Yes'],0,["class"=>'uk-select uk-form-small' ]) !!}
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">dashboard_enable</label>
                <div class="uk-form-controls">
                    {!! Form::select('dashboard_enable',[0=>'Disabled',1=>'Enabled'],0,["class"=>'uk-select uk-form-small' ]) !!}
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">password</label>
                <div class="uk-form-controls">
                    {!! Form::text('password',null,["class"=>'uk-input uk-form-small']) !!}
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">confirm</label>
                <div class="uk-form-controls">
                    {!! Form::text('password_confirmation',null,["class"=>'uk-input uk-form-small']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-5@m">
        <div class="uk-card uk-card-default uk-card-body uk-padding-small">
            <h4>User roles</h4>
            @foreach($roles as $id => $name)
                <div class="uk-margin">
                    <label>
                        {!! Form::checkbox("roles[$id]",$name,false, ["class"=>'uk-checkbox' ]) !!}
                        {{$name}}
                    </label>
                </div>
            @endforeach
        </div>

    </div>

{{--    <div class="uk-width-2-5@m">
        <div class="uk-card uk-card-default uk-card-body uk-padding-small">
        </div>

    </div>--}}

</div>


<button class="uk-button uk-button-secondary uk-button-small uk-margin-top	">Submit</button>
</form>
