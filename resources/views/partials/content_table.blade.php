<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>content</th>
        <th>js_files</th>
        <th>analysed</th>
        <th>safe</th>
    </tr>
    </thead>
    <tbody>
    @forelse($contents as $content)
    <tr>
        <td>{{$content->id}}</td>
        <td>{{$content->content}}</td>
        <td>{{$content->js_files}}</td>
        <td>{{$content->analysed}}</td>
        <td>{{$content->safe}}</td>
    </tr>
    @empty
    <tr>
    <td colspan="5">Content list empty, please add one.</td>
    </tr>
    @endforelse
    </tbody>
</table>
