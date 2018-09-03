<div class="uk-child-width-expand@s uk-text-left uk-padding-large" uk-grid>
    <div></div>
    <div class="uk-width-1-2@m">
        <div class="uk-container uk-container-expand uk-background-muted uk-text-center">
            {{ __('Reset Password') }}
        </div>
        <div class="uk-container uk-container-expand uk-background-default uk-text-center uk-margin">
            <form class="uk-form-horizontal uk-margin-large"
                  method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="uk-margin">
                    <label for="email" class="uk-form-label">{{ __('E-Mail Address') }}</label>

                    <div class="uk-form-controls">
                        <input class="uk-input" id="email" type="email" name="email" placeholder="e-mail">
                        @if ($errors->has('email'))
                            <span><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary uk-button-small"
                                type="submit">{{ __('Send Password Reset Link') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div></div>
</div>
