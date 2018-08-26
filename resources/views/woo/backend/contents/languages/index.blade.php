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
            <td>{{$language->active == 1 ? 'yes' : 'no'}}</td>
            <td>{{$language->created_at}}</td>
            <td>{{$language->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
