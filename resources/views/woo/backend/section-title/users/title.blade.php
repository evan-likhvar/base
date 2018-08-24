<div class="uk-section uk-section-muted uk-padding-small">
    <div class="uk-container">
        <div class="uk-grid-match uk-child-width-1-4@m" uk-grid>
            <div>
                <h1>{{$title}}</h1>
            </div>
            <div>
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
            <div>
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