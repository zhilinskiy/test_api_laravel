<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>user_id</th>
        <th>user_key</th>
        <th>count_positiv</th>
        <th>count_negativ</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->user_key}}</td>
        <td>{{$user->count_positiv}}</td>
        <td>{{$user->count_negativ}}</td>
    </tr>
    </tbody>
</table>
