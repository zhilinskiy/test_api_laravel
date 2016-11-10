<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>browser_name</th>
        <th>user_key</th>
        <th>count_positiv</th>
        <th>count_negativ</th>
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->browser_name}}</td>
        <td>{{$user->user_key}}</td>
        <td>{{$user->count_positiv}}</td>
        <td>{{$user->count_negativ}}</td>
    </tr>
    @empty
    <tr>
    <td colspan="5">Users list empty, please add one.</td>
    </tr>
    @endforelse
    </tbody>
</table>
