<div class="uk-child-width-expand@s uk-text-left uk-padding-large" uk-grid>
    <div></div>
    <div class="uk-width-1-2@m">
        <div class="uk-container uk-container-expand uk-background-muted uk-text-center">
            {{ __('Login')}}
        </div>
        <form class="uk-form-horizontal uk-margin-large"
              method="POST" action="{{ route('login') }}">
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
                <label for="password" class="uk-form-label">{{ __('Password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="password" type="text" name="password" placeholder="password">
                    @if ($errors->has('password'))
                        <span><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <label><input class="uk-checkbox uk-margin-right" id="remember" type="checkbox"
                                  name="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-small" type="submit">{{ __('Login') }}</button>
                    <a class="uk-button uk-button-primary uk-button-small"
                       href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                </div>
            </div>
        </form>
    </div>
    <div></div>
</div>
