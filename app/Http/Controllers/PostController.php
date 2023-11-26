<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts', compact('posts'));
    }

    /**
     * store
     *
     * @param mixed $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validation->fails())
            return response()->json($validation->errors(), 422);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil ditambahkan!',
            'data' => $post,
        ]);
    }

    /**
     * show
     *
     * @param mixed $post
     *
     * @return void
     */
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Post',
            'data' => $post,
        ]);
    }

    /**
     * update
     *
     * @param mixed $post
     * @param mixed $request
     *
     * @return void
     */
    public function update(Post $post, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validation->fails())
            return response()->json($validation->errors(), 422);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diubah!',
            'data' => $post,
        ]);
    }

    /**
     * delete
     *
     * @param mixed $post
     *
     * @return void
     */
    public function delete(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus!',
            'data' => null,
        ]);
    }
}
