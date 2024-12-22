<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //blog view di dashboard
    public function index(Request $request)
    {
        // Definisikan filter yang dikirim
        $status = $_GET['status'] ?? null;
        $author = $_GET['author'] ?? null;

        // Dapatkan data blog
        $query = Blog::with('user:id,username,nama,profile_pic,jenis_kelamin');

        // dd(isset($status));

        if (isset($status) && $status != '') {
            if ($status == 'dipublikasikan') {
                $query->where('status', '=', 1);
            } elseif ($status == 'draf') {
                $query->where('status', '=', 0);
            }
        }

        if (isset($author) && $author != '') {
            $query->whereHas('user', function ($q) use ($author) {
                $q->where('username', '=', $author);
            });
        }

        $blog = $query->orderBy('pinned', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(40)
            ->appends(request()->query());
        return view('dashboard.artikel', [
            'title' => 'Artikel',
            'group' => 'artikel',
            'posts' => $blog
        ]);
    }

    // edit artikel / post
    public function editPost($id)
    {
        // dapatkan data artikel
        $post = Blog::find($id);

        // Jika post tidak ditemukan
        if (empty($post)) {
            return $this->error404();
        }

        // Cek apakah user adalah author artikel
        if ($post['user_id'] != Auth::user()->id) {
            return $this->error403();
        }

        return view('dashboard.artikel-edit', [
            'title' => 'Edit Post',
            'group' => 'artikel',
            'post' => $post
        ]);
    }

    // Publikasikan / jadikan artikel draf
    public function draft($id)
    {
        $post = Blog::find($id);

        // Jika post tidak ditemukan atau author bukanlah user
        if (empty($post) || (Auth::user()->role != 'kepala' && $post['user_id'] != Auth::user()->id)) {
            return back()->with('failed', 'Gagal menyimpan artikel sebagai draf');
        }

        $data = [];
        $pesan = 'Tidak ada pesan';
        if ($post['status'] == 0) {
            // Ubah status jadi dipublikasikan
            $data['status'] = 1;
            $pesan = 'Artikel berhasil dipublikasikan';
        } elseif ($post['status'] == 1) {
            // Ubah status jadi draf
            $data['status'] = 0;
            $pesan = 'Artikel berhasil disimpan sebagai draf';
        }

        // Unpin jika post adalah pinned
        if ($post['status'] == 1 && $post['pinned'] == 1) {
            $data['pinned'] = 0;
        }

        // Simpan
        Blog::where('id', '=', $id)->update($data);
        return back()->with('success', $pesan);
    }

    // Pin/Unpin artikel
    public function sematkan($id)
    {
        $post = Blog::find($id);

        $data = [];
        $pesan = 'tidak ada pesan';
        if (empty($post) || Auth::user()->role != 'kepala') {
            // jika artikel tidak ditemukan / user role bukan kepala
            return back()->with('failed', 'Gagal menyematkan artikel');
        } elseif ($post['pinned'] == 0) {
            // jika tidak di pin
            $data['pinned'] = 1;
            $pesan = 'Artikel berhasil disematkan';
        } elseif ($post['pinned'] == 1) {
            // jika tidak di pin
            $data['pinned'] = 0;
            $pesan = 'Artikel batal disematkan';
        }

        Blog::where('id', '=', $id)->update($data);
        return back()->with('success', $pesan);

    }

    // Hapus artikel
    public function delete($id)
    {
        $post = Blog::find($id);

        // cek apakah post ada atau user adalah author atau user adalah kepala
        if (empty($post) || ($post->user_id != Auth::user()->id && Auth::user()->role != 'kepala')) {
            return back()->with('failed', 'Gagal menghapus artikel');
        }

        Blog::destroy($id);
        return back()->with('success', 'Artikel berhasil dihapus');
    }
}
