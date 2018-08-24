<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/app.css')}}" />

    <!-- UIkit JS -->
    <script src="{{asset('backend/js/app.js')}}"></script>
    <style>
        html, body {height: 100%;}
    </style>

</head>
<body>

<div class="admin-container uk-background-secondary uk-height-1-1" id="app">
    <div class="uk-flex uk-height-1-1">
        <aside class="admin-sidebar uk-width-auto uk-padding uk-background-muted uk-height-1-1">
            <nav>
                <ul class="uk-nav uk-nav-default ">

                    <li class="uk-margin-small-bottom">
                        <a href="{{route('backend.user.index')}}">
                            <span class="uk-margin-small-right" uk-icon="user"></span>
                            Users
                        </a>
                    </li>
                    <li class="uk-margin-small-bottom">
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="users"></span>
                            Roles
                        </a>
                    </li>
                    <li class="uk-margin-small-bottom">
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="lock"></span>
                            Permissions
                        </a>
                    </li>
                    <li class="uk-margin-small-bottom">
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="world"></span>
                            Languages
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="uk-width-expand">
            @if ($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
            @endif


{{--            @if ($messages->any())
                <div class="uk-alert-primary" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>
                        @foreach ($messages->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
            @endif--}}
            <section class="uk-padding-small uk-padding-remove-top uk-padding-remove-right">
                @yield('section_title')
                @yield('content')
            </section>
        </main>
    </div>
</div>

</body>
</html>
