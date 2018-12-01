@if(!empty($messages))
    @if (!empty($messages['frontMessages']))
        @foreach ($messages['frontMessages'] as $message)
            <div id='front-message' class="uk-alert-primary uk-padding-small uk-margin-small" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{!! $message !!} </p>
            </div>
        @endforeach
    @endif
    @if (!empty($messages['errorMessages']))
        @foreach ($messages['errorMessages'] as $message)
            <div id='front-message' class="uk-alert-danger uk-padding-small uk-margin-small" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{!! $message !!}</p>
            </div>
        @endforeach
    @endif
@endif
