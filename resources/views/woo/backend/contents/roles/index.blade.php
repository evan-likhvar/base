<div uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.</p>
</div>

<table class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small">
    <thead>
    <tr>
        <th>
            <a href="
            {{route('backend.role.index')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">id</a>
        </th>
        <th>
            <a href="
{{route('backend.role.index')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">name</a>
        </th>

        <th>active</th>
        <th>
            <a href="
{{route('backend.role.index')}}?sort=created_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">created at</a>
            </th>
        <th>
            <a href="
{{route('backend.role.index')}}?sort=updated_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">updated at</a>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->active == 1 ? 'yes' : 'no'}}</td>
            <td>{{$role->created_at}}</td>
            <td>{{$role->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
