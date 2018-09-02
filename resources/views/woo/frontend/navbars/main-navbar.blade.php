<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">

                @auth
                    <li class="uk-active"><a href="{{ route('home') }}">Home</a></li>
                @else
                    <li class="uk-active"><a href="{{ route('login') }}">Login</a></li>
                    <li class="uk-active"><a href="{{ route('register') }}">Register</a></li>
                @endauth

            </ul>
        </div>
    </nav>
</div>
