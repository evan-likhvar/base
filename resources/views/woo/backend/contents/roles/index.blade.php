@include(config('settings.themeIncludes').'.displayMessages')
<table id="main-table"
       class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small uk-padding-small uk-margin-small">
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
    <tfoot>
    <tr>
        <td></td>
        <td>
            <a class="uk-button uk-button-secondary uk-button-small" href="{{route('backend.role.create')}}">Create
                new</a>
        </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tfoot>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td><a href="{{route('backend.role.edit',$role->id)}}">{{$role->name}}</a></td>
            <td>
                <a href="" class="uk-icon-button" uk-icon="refresh"
                   onclick="event.preventDefault();toggleActiveRole(event.target)">
                </a>
                <span class="{{$role->active == 1 ? 'uk-text-primary' : 'uk-text-danger'}}">{{$role->active == 1 ? 'yes' : 'no'}}</span>
            </td>
            <td>{{$role->created_at}}</td>
            <td>{{$role->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
