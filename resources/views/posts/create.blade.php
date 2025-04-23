@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Post</h2>
    <form action="{{ route('post.store') }}" method="POST">
        @include('posts.form')
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
