<table id="main-table"
       class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small">
    <thead>
    <tr>
        <th>
            <a href="
            {{route('backend.language.index')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">id</a>
        </th>
        <th>
            <a href="
{{route('backend.language.index')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">name</a>
        </th>
        <th>
            <a href="
{{route('backend.language.index')}}?sort=full_name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                ">name</a>
        </th>
        <th>active</th>
        <th>
            <a href="
{{route('backend.language.index')}}?sort=created_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">created at</a>
            </th>
        <th>
            <a href="
{{route('backend.language.index')}}?sort=updated_at&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}
                    ">updated at</a>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($languages as $language)
        <tr>
            <td>{{$language->id}}</td>
            <td>{{$language->name}}</td>
            <td>{{$language->full_name}}</td>
            <td>
                <a href="" class="uk-icon-button" uk-icon="refresh"
                   onclick="event.preventDefault();toggleActiveLanguage(event.target)">
                </a>
                <span class="{{$language->active == 1 ? 'uk-text-primary' : 'uk-text-danger'}}">{{$language->active == 1 ? 'yes' : 'no'}}</span>
            </td>
            <td>{{$language->created_at}}</td>
            <td>{{$language->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
