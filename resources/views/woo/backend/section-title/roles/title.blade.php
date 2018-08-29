<div class="uk-section uk-section-muted uk-padding-small">
    <div class="uk-container uk-padding-remove">
        <div class="uk-grid-match" uk-grid>
            <div>
                <h2>{!! $title !!}</h2>
            </div>
            <div class="uk-width-1-3@m">
                @foreach($roles as $role)
                    <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                        <div class="uk-width-expand" uk-leader="fill: -">{{$role->name}} user:</div>
                        <div>{{$role->users->Count()}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
