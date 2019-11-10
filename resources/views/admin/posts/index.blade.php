@extends('layouts.admin')

@section('content')
    @component('admin.includes.title')
        Post list
    @endcomponent

    <table class="table table-striped admin_users_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Owner</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($posts))
                @foreach($posts as $post)
                    <tr>
                        <td>
                            {{ $post->id }}
                        </td>
                        <td>
                            <img src=" {{ asset('img/posts/'.$post->photo['filename']) }}" width="50px">
                        </td>
                        <td>
                            <a href="{{ url('admin/posts/'.$post->id.'/edit') }}">
                                {{ $post->name }}
                            </a>
                        </td>
                        <td>
                            {{ $post->category->name }}
                        </td>
                        <td>
                            {{ $post->user->name }}
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection