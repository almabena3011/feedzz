<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $user = Auth::user();
        $request->validate([
            'caption' => 'min:10|max:250',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = $user->image;

        if ($request->image) {
            $post_image = $request->image;
            $imageName = $user->username . '-' . time() . '.' . $post_image->extension();
            // $post_image->move(public_path('images/posts'), $imageName);
            $post_image->storeAs('public/images', $imageName);
        }
        Post::create([
            'caption' => $request->caption,
            'image' => $imageName,
            'user_id' =>  $user->id
        ]);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        // Lazy load
        $post->load('comments.user')->loadCount('likes');
        return view('posts.show', compact('post', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id)
            abort(403);

        $request->validate([
            'caption' => 'max:250'
        ]);

        $post->update([
            'caption' => $request->caption
        ]);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
