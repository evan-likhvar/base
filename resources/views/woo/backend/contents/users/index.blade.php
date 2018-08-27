{{--<div id="front-message" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.</p>
</div>--}}

<table id="main-table"
       class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small">
    <thead>
    <tr>
        <th>
            <a href="
            {{route('backend.user.index')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">id</a>
        </th>
        <th>
            <a href="
{{route('backend.user.index')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">name</a>
        </th>
        <th>
            <a href="
{{route('backend.user.index')}}?sort=email&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">e-mail</a>
        </th>
        <th>language</th>
        <th>dashboard</th>
        <th>active</th>
        <th>
            <a href="
{{route('backend.user.index')}}?sort=created_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">created at</a>
        </th>
        <th>
            <a href="
{{route('backend.user.index')}}?sort=updated_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">updated at</a>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->language->name}}</td>
            <td>
                <a href="" class="uk-icon-button" uk-icon="refresh"
                   onclick="event.preventDefault();toggleDashboard(event.target)">

                </a>
                <span class="{{$user->dashboard_enable == 1 ? 'uk-text-primary' : 'uk-text-danger'}}">{{$user->dashboard_enable == 1 ? 'enabled' : 'disabled'}}</span>
            </td>
            <td>{{$user->active == 1 ? 'yes' : 'no'}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function toggleDashboard(eventTarget) {
        axios.get('/dashboard/toggle-dashboard-access/' + eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML)
            .then(response => {
                if (document.contains(document.getElementById("front-message"))) {
                    document.getElementById("front-message").remove();
                }
                eventTarget.parentNode.nextElementSibling.innerHTML = response.data.result;
                if (response.data.result == 'enabled') {
                    eventTarget.parentNode.nextElementSibling.className = 'uk-text-primary';
                } else {
                    eventTarget.parentNode.nextElementSibling.className = 'uk-text-danger';
                }
                document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.front_message);
            })
            .catch(function (err) {
                console.log(err.message);
                if (document.contains(document.getElementById("front-message"))) {
                    document.getElementById("front-message").remove();
                }
                document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                    '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                    err.message
                    + '</p></div>'
                );
            });
    }
</script>