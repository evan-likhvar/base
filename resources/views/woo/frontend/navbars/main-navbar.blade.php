<div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent uk-light; top: 200">
    <nav class="uk-navbar-container">
        <div class="uk-container uk-container-expand">
            <div uk-navbar>
                <div class="uk-navbar-right uk-padding uk-padding-remove-bottom uk-padding-remove-top">
                    <ul class="uk-navbar-nav">


                            @auth
                                <li class="uk-active"><a href="{{ route('home') }}">Home</a></li>
                            @else
                                <li class="uk-active"><a href="{{ route('login') }}">Login</a></li>
                                <li class="uk-active"><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>


