<div uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.</p>
</div>

<div class="uk-background-muted">
    <form action="{{ route('backend.permission.update',1) }}" method="POST">
        {{ csrf_field() }}
        <table class="uk-table uk-table-divider uk-table-striped uk-table-small">
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
