@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Posts</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Writer</th>
                <th>Enabled</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name ?? 'Unknown' }}</td>
                    <td>{{ $post->enabled ? 'Yes' : 'No' }}</td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }} <!-- Laravel pagination -->
</div>
@endsection
