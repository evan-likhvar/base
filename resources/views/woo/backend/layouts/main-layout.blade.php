<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.10/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.10/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.10/js/uikit-icons.min.js"></script>
</head>
<body>

<div class="admin-container" id="app">
    <div class="uk-flex">
        <aside class="admin-sidebar uk-width-auto uk-padding">
            <nav>
                <ul class="uk-nav uk-nav-default ">

                    <li class="uk-margin-small-bottom">
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="users"></span>
                            Users
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
            <section class="uk-padding">
                @yield('content')
            </section>
        </main>
    </div>
</div>

</body>
</html>
