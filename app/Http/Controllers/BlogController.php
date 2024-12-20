<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //blog view di dashboard
    public function index()
    {
        // Dapatkan data blog
        $blog = Blog::with('user:id,username,nama,profile_pic,jenis_kelamin')
            ->orderBy('pinned', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        return view('dashboard.artikel', [
            'title' => 'Artikel',
            'group' => 'artikel',
            'posts' => $blog
        ]);
    }
}
