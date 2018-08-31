<div class="uk-section uk-section-muted uk-padding-remove uk-text-small">
    <div class="uk-container uk-padding-small">
        <div class="uk-grid-match" uk-grid>
            <div class="uk-width-1-3@m">
                <h2>{!! $title !!}</h2>
            </div>
            <div class="uk-width-1-3@m">
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">Total user:</div>
                    <div>{{$users->userCount()}}</div>
                </div>
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">Active user:</div>
                    <div>{{$users->activeUserCount()}}</div>
                </div>
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">Blocked user:</div>
                    <div>{{$users->deactivateUserCount()}}</div>
                </div>
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">Admin user:</div>
                    <div>{{$users->dashboardEnableUserCount()}}</div>
                </div>

            </div>
            <div class="uk-width-1-3@m">
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">New user last day:</div>
                    <div>{{$users->newUserForLastDay()}}</div>
                </div>
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">New user last week:</div>
                    <div>{{$users->newUserForLastWeek()}}</div>
                </div>
                <div class="uk-grid-small uk-margin-remove-top" uk-grid>
                    <div class="uk-width-expand" uk-leader="fill: -">New user last month:</div>
                    <div>{{$users->newUserForLastMonth()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
