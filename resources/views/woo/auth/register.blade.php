<div class="uk-child-width-expand@s uk-text-left uk-padding-large" uk-grid>
    <div></div>
    <div class = "uk-width-1-2@m">
        <div class="uk-container uk-container-expand uk-background-muted uk-text-center">
            {{ __('Register')}}
        </div>
        <form class="uk-form-horizontal uk-margin-large"
              method="POST" action="{{ route('register') }}">
            @csrf
            <div class="uk-margin">
                <label for="name" class="uk-form-label">{{ __('Name') }}</label>

                <div class="uk-form-controls">
                    <input class="uk-input" id="name" type="text" name="name" placeholder="name">
                    @if ($errors->has('name'))
                        <span><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
            </div>
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
                <label for="password" class="uk-form-label">{{ __('Password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="password" type="password" name="password" placeholder="password">
                    @if ($errors->has('password'))
                        <span><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
            </div>
            <div class="uk-margin">
                <label for="password-confirm" class="uk-form-label">{{ __('Confirm Password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="password-confirm" type="password" name="password_confirmation" placeholder="password-confirm">
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-small" type="submit">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div></div>
</div>
