@include(config('settings.themeIncludes').'.displayMessages')
<table id="main-table"
       class="uk-table uk-table-hover uk-table-divider uk-background-muted uk-table-small uk-text-small uk-padding-small uk-margin-small">
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
    <tfoot>
    <tr>
        <td></td>
        <td>
            <a class="uk-button uk-button-secondary uk-button-small" href="{{route('backend.language.create')}}">Create
                new</a>
        </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tfoot>
    <tbody>
    @foreach($languages as $language)
        <tr>
            <td>{{$language->id}}</td>
            <td><a href="{{route('backend.language.edit',$language->id)}}">{{$language->name}}</a></td>
            <td><a href="{{route('backend.language.edit',$language->id)}}">{{$language->full_name}}</a></td>
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
