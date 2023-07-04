<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function loadmore($time)
    {
        $user = Auth::user();

        //timeline orang yang difollow 
        //+ timeline sendiri
        // mengambil id dari tabel follows dimana orang2 yang kita follow saja
        //pluck mengambil kolom yang spesifik
        $id_list = $user->following()->pluck('follows.following_id')->toArray();
        $id_list[] = $user->id;

        $alluser = User::whereNot('id', $user->id)->orderBy('id', 'desc')->paginate(5);
        $posts =  Post::with('user', 'likes')->withCount('likes')
            ->whereIn('user_id', $id_list)->orderBy('id', 'desc')
            ->whereTime('created_at', '<', Carbon::parse((int)$time))
            ->take(3)->get();
        return ['post' => $posts];
    }

    public function index()
    {
        $user = Auth::user();

        //timeline orang yang difollow 
        //+ timeline sendiri
        // mengambil id dari tabel follows dimana orang2 yang kita follow saja
        //pluck mengambil kolom yang spesifik
        $id_list = $user->following()->pluck('follows.following_id')->toArray();
        $id_list[] = $user->id;

        $alluser = User::whereNot('id', $user->id)->orderBy('id', 'desc')->paginate(5);
        $posts =  Post::with('user', 'likes')->withCount('likes')
            ->whereIn('user_id', $id_list)->orderBy('id', 'desc')->get();
        return view('home', compact('posts', 'alluser'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $alluser = User::whereNot('id', $user->id)->orderBy('id', 'desc')->paginate(5);

        $querySearch = $request->input('query');
        $posts = Post::with('user', 'likes')->withCount('likes')->where('caption', 'like', '%' . $querySearch . '%')->orderBy('id', 'desc')->take(3)->get();
        return view('home', compact('posts', 'querySearch', 'alluser'));
    }

    public function findfriends()
    {

        $user = Auth::user();
        $users = User::whereNot('id', $user->id)->get();
        return view('findfriends', compact('users'));
    }

    public function displayImage($filename)

    {



        $path = storage_public('images/' . $filename);



        if (!File::exists($path)) {

            abort(404);
        }



        $file = File::get($path);

        $type = File::mimeType($path);



        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);



        return $response;
    }
}
