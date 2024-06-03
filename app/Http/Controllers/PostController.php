<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Follow;


class PostController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya pengguna terautentikasi yang dapat mengakses metode ini
        $this->middleware('auth')->except(['index']);
        // Menambahkan middleware not_liked ke metode like
        $this->middleware('not_liked')->only('like');
    }
    

    public function index(Request $request)
    {
        $viewType = $request->query('view');
        $search = $request->input('search');
        $followerId = Auth::id();

        // Buat kueri dasar untuk postingan, eventPosts, dan newsPosts
        $baseQuery = Post::with('user');

        // Terapkan filter pencarian jika ada
        if ($search) {
            $baseQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('text', 'LIKE', "%$search%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Ambil postingan sesuai jenis tampilan
        if ($viewType === 'following') {
            // Ambil postingan dari pengguna yang diikuti
            $posts = $baseQuery->whereHas('user', function ($query) {
                $query->whereIn('id', auth()->user()->following()->pluck('followee_id'));
            })->orderBy('created_at', 'desc')->get();
        } else {
            // Ambil semua postingan
            $posts = $baseQuery->orderBy('created_at', 'desc')->get();
        }

        // Mengambil postingan yang bertipe event
        $eventPosts = (clone $baseQuery)
            ->where('type', 'event')
            ->orderByRaw('(CASE WHEN NOW() BETWEEN isOn_start AND isOn_end THEN 0 
                    WHEN isOn_start > NOW() THEN 1 
                    ELSE 2 END), isOn_start ASC')
            ->get();

        // Mengambil postingan yang bertipe news
        $newsPosts = (clone $baseQuery)
            ->where('type', 'news')
            ->orderBy('found', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengonversi properti isOn_start dan isOn_end menjadi objek Carbon untuk setiap post
        foreach ($eventPosts as $post) {
            $post->isOn_start = Carbon::parse($post->isOn_start);
            $post->isOn_end = Carbon::parse($post->isOn_end);
        }

        // Tandai apakah user mengikuti penulis dari setiap postingan
        foreach ($posts as $post) {
            $post->isFollowing = Follow::where('follower_id', $followerId)
                                    ->where('followee_id', $post->user->id)
                                    ->exists();
        }

        return view('dashboard', compact('eventPosts', 'newsPosts', 'posts', 'viewType'));
    }



    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'text' => 'required|max:4096',
            'isOn_start' => 'nullable|date',
            'isOn_end' => 'nullable|date|after:isOn_start',
        ]);

        // Menyimpan postingan baru
        Post::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'title' => $request->title,
            'type' => $request->input('type', 'post'),
            'likes' => 0, // Inisialisasi jumlah suka dengan 0
            'isOn_start' => $request->isOn_start,
            'isOn_end' => $request->isOn_end
        ]);
        

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil dibuat.');
    }

    public function dashboard(Request $request)
    {
        $viewType = $request->query('view');
        $search = $request->input('search');
        $followerId = Auth::id();

        // Buat kueri dasar untuk postingan, eventPosts, dan newsPosts
        $baseQuery = Post::with('user');

        // Terapkan filter pencarian jika ada
        if ($search) {
            $baseQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('text', 'LIKE', "%$search%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Ambil postingan sesuai jenis tampilan
        if ($viewType === 'following') {
            // Ambil postingan dari pengguna yang diikuti
            $posts = $baseQuery->whereHas('user', function ($query) {
                $query->whereIn('id', auth()->user()->following()->pluck('followee_id'));
            })->orderBy('created_at', 'desc')->get();
        } else {
            // Ambil semua postingan
            $posts = $baseQuery->orderBy('created_at', 'desc')->get();
        }

        // Mengambil postingan yang bertipe event
        $eventPosts = (clone $baseQuery)
            ->where('type', 'event')
            ->orderByRaw('(CASE WHEN NOW() BETWEEN isOn_start AND isOn_end THEN 0 
                    WHEN isOn_start > NOW() THEN 1 
                    ELSE 2 END), isOn_start ASC')
            ->get();

        // Mengambil postingan yang bertipe news
        $newsPosts = (clone $baseQuery)
            ->where('type', 'news')
            ->orderBy('found', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengonversi properti isOn_start dan isOn_end menjadi objek Carbon untuk setiap post
        foreach ($eventPosts as $post) {
            $post->isOn_start = Carbon::parse($post->isOn_start);
            $post->isOn_end = Carbon::parse($post->isOn_end);
        }

        // Tandai apakah user mengikuti penulis dari setiap postingan
        foreach ($posts as $post) {
            $post->isFollowing = Follow::where('follower_id', $followerId)
                                    ->where('followee_id', $post->user->id)
                                    ->exists();
        }

        return view('dashboard', compact('eventPosts', 'newsPosts', 'posts', 'viewType'));
    }


    public function like($id)
    {
        $post = Post::findOrFail($id);
        
        // Cek apakah pengguna sudah menyukai postingan ini
        if ($post->likes()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('posts.index')->with('error', 'Anda sudah menyukai postingan ini.');
        }

        // Menyukai postingan
        $post->likes()->attach(Auth::id());
        $post->increment('likes');


        return redirect()->route('posts.index')->with('success', 'Anda menyukai postingan ini.');
    }

    public function unlike($id)
    {
        $post = Post::findOrFail($id);
        
        // Cek apakah pengguna sudah menyukai postingan ini
        if (!$post->likes()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('posts.index')->with('error', 'Anda belum menyukai postingan ini.');
        }

        // Menghapus like dari postingan
        $post->likes()->detach(Auth::id());
        if ($post->likes > 0) {
            $post->decrement('likes');
        }

        return redirect()->route('posts.index')->with('success', 'Anda tidak menyukai postingan ini lagi.');
    }

    public function updateStatus($id)
    {
        $newsItem = Post::findOrFail($id);

        if ($newsItem->type === 'news') {
            $newsItem->found = true;
            $newsItem->save();
        }

        return redirect()->route('dashboard')->with('success', 'News status updated successfully.');
    }

    public function singlepost($id){
        $eventPosts = Post::with('user')
            ->where('type', 'event')
            ->orderByRaw('(CASE WHEN NOW() BETWEEN isOn_start AND isOn_end THEN 0 
                    WHEN isOn_start > NOW() THEN 1 
                    ELSE 2 END), isOn_start ASC')
            ->get();

        // Mengambil postingan yang bertipe news
        $newsPosts = Post::with('user')
            ->where('type', 'news')
            ->orderBy('found', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengonversi properti isOn_start dan isOn_end menjadi objek Carbon untuk setiap post
        foreach ($eventPosts as $post) {
            $post->isOn_start = Carbon::parse($post->isOn_start);
            $post->isOn_end = Carbon::parse($post->isOn_end);
        }
        
        $followerId = Auth::id();
        $post = Post::findOrFail($id);
        $post->isOn_start = Carbon::parse($post->isOn_start);
        $post->isOn_end = Carbon::parse($post->isOn_end);
        $post->isFollowing = Follow::where('follower_id', $followerId)
                                       ->where('followee_id', $post->user->id)
                                       ->exists();
        return view('single-post', compact('post', 'eventPosts', 'newsPosts'));
    }
    

}
