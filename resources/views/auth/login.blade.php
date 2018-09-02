<div class="uk-child-width-expand@s uk-text-left uk-padding-large" uk-grid>

    <div></div>
    <div class = "uk-width-1-2@m">
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

            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label for="remember" class="uk-form-label">{{ __('Remember Me') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-checkbox" id="remember" type="checkbox" name="remember">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>


        </form>

    </div>
    <div></div>
</div>
