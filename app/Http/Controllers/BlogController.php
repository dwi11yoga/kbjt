<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

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
                $query->whereNotNull('status');
            } elseif ($status == 'draf') {
                $query->whereNull('status');
            }
        }

        if (isset($author) && $author != '') {
            // $query->where('user_id', '=', $author);
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

    // view tambah post/artikel
    public function tambah()
    {
        return view('dashboard.artikel-buat', [
            'title' => 'Buat artikel',
            'group' => 'artikel',
            'url' => $this->getUrl()
        ]);
    }

    // Simpan artikel baru sebagai draft/publikasikan
    public function simpanArtikel(Request $request)
    {
        $apakahSimpan = $request->getRequestUri() == "/artikel/baru/simpan"; //true jika artikel disimpan
        $apakahPublish = $request->getRequestUri() == "/artikel/baru/publikasikan"; //true jika artikel dipublikasikan
        // Validasi
        if ($apakahSimpan == true) {
            $validatedData = $request->validate([
                'judul' => 'string|min:6',
                'slug' => 'string|regex:/^[a-z0-9-]+$/',
                'thumbnail' => [File::types(['jpg', 'jpeg', 'png', 'webp'])->max(1024)],
            ]);
        } elseif ($apakahPublish == true) {
            $validatedData = $request->validate([
                'judul' => 'required|string|min:6',
                'slug' => 'required|string|regex:/^[a-z0-9-]+$/',
                'thumbnail' => [File::types(['jpg', 'jpeg', 'png', 'webp'])->max(1024)],
            ]);
        } else {
            return back()->with('failed', 'Gagal menyimpan artikel');
        }

        // simpan data
        $data = [
            'user_id' => Auth::user()->id,
            'judul' => $validatedData['judul'],
            'slug' => $validatedData['slug'],
            'subjudul' => $request->subjudul,
            'konten' => $request->konten,
        ];
        if ($apakahPublish == true) {
            $data['status'] = now();
        }

        // simpan gambar
        if (isset($validatedData['thumbnail'])) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('post-thumbnail');
            $data['thumbnail'] = $validatedData['thumbnail'];
        }

        // Simpan
        Blog::create($data);

        // redirect ke halaman edit
        if ($apakahSimpan == true) {
            $post = Blog::select('id', 'slug')->where('slug', '=', $validatedData['slug'])->first();
            return redirect('/artikel/edit/' . $post->id)->with('success', 'Artikel berhasil disimpan sebagai draf');
        } elseif ($apakahPublish == true) {
            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan');
        }
    }

    // Simpan artikel lama sebagai draft/publikasikan
    public function simpanEdit(Request $request, $id)
    {
        $post = Blog::select('id', 'slug', 'thumbnail')->where('id', '=', $id)->first();

        $apakahSimpan = $request->getRequestUri() == "/artikel/edit/" . $id . "/simpan"; //true jika artikel disimpan
        $apakahPublish = $request->getRequestUri() == "/artikel/edit/" . $id . "/publikasikan"; //true jika artikel dipublikasikan
        // Validasi
        if ($apakahSimpan == true) {
            $validatedData = $request->validate([
                'judul' => 'string|min:6',
                'slug' => 'string|regex:/^[a-z0-9-]+$/|unique:blog,slug,' . $id . ',id',
                'thumbnail' => [File::types(['jpg', 'jpeg', 'png', 'webp'])->max(1024)],
            ]);
        } elseif ($apakahPublish == true) {
            $validatedData = $request->validate([
                'judul' => 'required|string|min:6',
                'slug' => 'required|string|regex:/^[a-z0-9-]+$/|unique:blog,slug,' . $id . ',id',
                'thumbnail' => [File::types(['jpg', 'jpeg', 'png', 'webp'])->max(1024)],
            ]);
        } else {
            return back()->with('failed', 'Gagal menyimpan perubahan pada artikel');
        }

        // simpan data
        $data = [
            'user_id' => Auth::user()->id,
            'judul' => $validatedData['judul'],
            'slug' => $validatedData['slug'],
            'subjudul' => $request->subjudul,
            'konten' => $request->konten,
            'status' => null
        ];
        if ($apakahPublish == true) {
            $data['status'] = now();
        }

        // simpan gambar
        if (isset($validatedData['thumbnail'])) {
            // hapus gambar jika sudah ada.
            if (isset($post['thumbnail'])) {
                Storage::delete($post->thumbnail);
            }
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('post-thumbnail');
            $data['thumbnail'] = $validatedData['thumbnail'];
        }

        // Simpan
        Blog::find($id)->update($data);

        // redirect ke halaman edit
        if ($apakahSimpan == true) {
            return redirect('/artikel/edit/' . $post->id)->with('success', 'Artikel berhasil disimpan sebagai draf');
        } elseif ($apakahPublish == true) {
            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan');
        }
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
            'post' => $post,
            'url' => $this->getUrl()
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
        if (empty($post['status'])) {
            // Ubah status jadi dipublikasikan
            $data['status'] = now();
            $pesan = 'Artikel berhasil dipublikasikan';
        } elseif (isset($post['status'])) {
            // Ubah status jadi draf
            $data['status'] = null;
            $pesan = 'Artikel berhasil disimpan sebagai draf';
        }

        // Unpin jika post adalah pinned
        if (isset($post['status']) && $post['pinned'] == 1) {
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
