
<div uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.</p>
</div>

<table class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small">
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>e-mail</th>
        <th>language</th>
        <th>dashboard</th>
        <th>active</th>
        <th>created at</th>
        <th>updated at</th>

    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->language->name}}</td>
            <td>{{$user->dashboard_enable == 1 ? 'enabled' : 'disabled'}}</td>
            <td>{{$user->active == 1 ? 'yes' : 'no'}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>