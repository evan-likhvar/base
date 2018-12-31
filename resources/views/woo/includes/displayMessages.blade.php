
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
                @if(is_array($message))
                    @foreach($message as $messageName => $item)
                        @if(is_array($item))
                            @foreach($item as $i)
                                <p><b>{!! $messageName !!}</b> - {!! $i !!}</p>

                            @endforeach
                            @else
                            <p>{!! $item !!}</p>
                        @endif
                    @endforeach
                @else
                    <p>{!! $message !!}</p>
                @endif
            </div>
        @endforeach
    @endif
@endif
