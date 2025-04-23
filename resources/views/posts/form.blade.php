@csrf

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea name="body" class="form-control" rows="5" required>{{ old('body', $post->body ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="enabled" class="form-label">Enabled</label>
    <select name="enabled" class="form-select">
        <option value="1" {{ (old('enabled', $post->enabled ?? '') == 1) ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ (old('enabled', $post->enabled ?? '') == 0) ? 'selected' : '' }}>No</option>
    </select>
</div>

<div class="mb-3">
    <label for="user_id" class="form-label">Writer</label>
    <select name="user_id" class="form-select" required>
        <option value="">Select Writer</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $post->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>
