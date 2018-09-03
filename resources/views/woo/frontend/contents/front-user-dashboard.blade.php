<div class="uk-child-width-expand@s uk-text-left uk-padding-large" uk-grid>
    <div></div>
    <div class="uk-width-1-2@m">
        <div class="uk-container uk-container-expand uk-background-muted uk-text-center">
            {{Auth::user()->name}} personal dashboard. Last login at {{Auth::user()->last_login}}
        </div>
        <div class="uk-container uk-container-expand uk-background-default uk-text-center uk-margin">
            <a class="uk-button uk-button-primary uk-button-small" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div></div>
</div>
