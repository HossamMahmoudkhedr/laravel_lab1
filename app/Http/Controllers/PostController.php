<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::with('user')->paginate(10);
        // return view('posts.index', compact('posts'));
        return Post::with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'body' => 'required',
        //     'enabled' => 'required|boolean',
        //     'user_id' => 'required|exists:users,id',
        //     'content' => 'required|string',
        // ]);

        // Post::create([
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'user_id' => auth()->id(),
        // ]);

        // return redirect()->route('post.index')->with('success', 'Post created successfully!');

        $request->validate(['title' => 'required', 'body' => 'required']);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('posts.show', ['id'=> $id]);
        return Post::with('user')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $post = Post::findOrFail($id);

        // if ($post->user_id !== auth()->id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'body' => 'required',
        //     'enabled' => 'required|boolean',
        //     'user_id' => 'required|exists:users,id',
        //     'content' => 'required|string',
        // ]);

        // $post->update([
        //     'title' => $request->title,
        //     'content' => $request->content,
        // ]);

        // return redirect()->route('post.index')->with('success', 'Post updated successfully!');
        $post = Post::findOrFail($id);

        // Ensure only owner can update
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->update($request->only(['title', 'body']));
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $post = Post::findOrFail($id);
        // $post->delete();

        // return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
