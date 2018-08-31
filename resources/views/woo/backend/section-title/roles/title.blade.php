<div class="uk-section uk-section-muted uk-padding-small uk-text-small">
    <div class="uk-container uk-padding-remove">
        <div class="uk-grid-match" uk-grid>
            <div class="uk-width-1-4@m">
                <h2>{!! $title !!}</h2>
            </div>

            @foreach($roles->chunk(ceil($roles->count()/3)) as $chunks)

                <div class="uk-width-1-4@m">
                    @foreach($chunks as $role)
                        <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                            <div class="uk-width-expand" uk-leader="fill: -">{{$role->name}} user:</div>
                            <div>{{$role->users->Count()}}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach




        </div>
    </div>
</div>
