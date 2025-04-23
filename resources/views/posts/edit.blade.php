@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Post</h2>
    <form action="{{ route('post.update', $post->id) }}" method="POST">
        @method('PUT')
        @include('posts.form')
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
