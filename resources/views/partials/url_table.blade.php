<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>user_id</th>
        <th>user_key</th>
        <th>url</th>
        <th>safe</th>
    </tr>
    </thead>
    <tbody>
    @forelse($urls as $url)
    <tr>
        <td>{{$url->id}}</td>
        <td>{{$url->user_id}}</td>
        <td>{{$url->user->user_key}}</td>
        <td>{{$url->url}}</td>
        <td>{{$url->safe}}</td>
    </tr>
    @empty
    <tr>
    <td colspan="5">Url list empty, please add one.</td>
    </tr>
    @endforelse
    </tbody>
</table>
