@include(config('settings.themeIncludes').'.displayMessages')
<div class="uk-background-muted">
    <form action="{{ route('backend.permission.update') }}" method="POST">
        {{ csrf_field() }}
        <table class="uk-table uk-table-divider uk-table-striped uk-table-small uk-padding-small uk-margin-small">
            <thead>
            <tr>
                <th>Privileges</th>
                @if(!$roles->isEmpty())
                    @foreach($roles as $item)
                        <th>{{ $item->name}}</th>
                    @endforeach
                @endif
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td>
                    <button class="uk-button uk-button-secondary uk-button-small">Submit</button>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tfoot>
            <tbody>
            @if(!$permissions->isEmpty())
                @foreach($permissions as $val)
                    <tr>
                        <td>{{ $val->name }}</td>
                        @foreach($roles as $role)
                            <td>
                                @if($role->hasPermission($val->name))
                                    <input checked name="{{ $role->id }}[]" type="checkbox" value="{{ $val->id }}">
                                @else
                                    <input name=" {{ $role->id }}[]" type="checkbox" value="{{ $val->id }}">
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </form>
</div>
