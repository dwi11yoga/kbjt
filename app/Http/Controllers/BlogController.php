<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\HapusAkun;
use App\Models\User;
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
        // $query = Blog::with('user:id,username,nama,profile_pic,jenis_kelamin');
        $query = Blog::with([
            'user' => function ($query) {
                $query->withTrashed(); //ambil data softdelete juga
            }
        ]);

        // untuk filter status
        if (isset($status) && $status != '') {
            if ($status == 'dipublikasikan') {
                $query->whereNotNull('status');
            } elseif ($status == 'draf') {
                $query->whereNull('status');
            }
        }

        // untuk filter author
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

        // cek apakah data user (author) ada/terhapus
        foreach ($blog as $d) {
            if ($d->user->trashed()) {
                $d->user->statusUser = 'dihapus';
            }
        }

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
        // cek apakah artikel mau disimpan atau dipublikasikan
        $apakahSimpan = $request->getRequestUri() == "/artikel/baru/simpan"; //true jika artikel disimpan
        $apakahPublish = $request->getRequestUri() == "/artikel/baru/publikasikan"; //true jika artikel dipublikasikan

        // Validasi
        if ($apakahSimpan == true) {
            $rules = [
                'judul' => 'string|min:6',
                'slug' => 'string|regex:/^[a-z0-9-]+$/',
            ];
        } elseif ($apakahPublish == true) {
            $rules = [
                'judul' => 'required|string|min:6',
                'slug' => 'required|string|regex:/^[a-z0-9-]+$/',
                'konten' => 'required|string|min:50'
            ];
        } else {
            return back()->with('failed', 'Gagal menyimpan artikel');
        }

        // thumbnail
        if (isset($request->thumbnail)) {
            $rules['thumbnail'] = 'mimes:png,jpg,jpeg,webp|image|max:1024';
        }

        $validatedData = $request->validate($rules);

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
        if (isset($request->thumbnail)) {
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

            // cek achievement
            $userId = Auth::user()->id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];

            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                $this->achievement($userId, $d);
            }

            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan');
        }
    }

    // Simpan artikel lama sebagai draft/publikasikan - digunakan untuk halaman edit artikel
    public function simpanEdit(Request $request, $id)
    {
        // dapatkan data artikel yang diedit
        $post = Blog::select('id', 'slug', 'thumbnail', 'user_id')->where('id', '=', $id)->first();

        // cek apakah artikel disimpan/dipublish
        $apakahSimpan = $request->getRequestUri() == "/artikel/edit/" . $id . "/simpan"; //true jika artikel disimpan
        $apakahPublish = $request->getRequestUri() == "/artikel/edit/" . $id . "/publikasikan"; //true jika artikel dipublikasikan
        // Validasi
        if ($apakahSimpan == true) {
            $rules = [
                'judul' => 'string|min:6',
                'slug' => 'string|regex:/^[a-z0-9-]+$/|unique:blog,slug,' . $id . ',id',
            ];
        } elseif ($apakahPublish == true) {
            $rules = [
                'judul' => 'required|string|min:6',
                'slug' => 'required|string|regex:/^[a-z0-9-]+$/|unique:blog,slug,' . $id . ',id',
                'konten' => 'required|string|min:50'
            ];
        } else {
            return back()->with('failed', 'Gagal menyimpan perubahan pada artikel');
        }

        // thumbnail
        if (isset($request->thumbnail)) {
            $rules['thumbnail'] = 'mimes:png,jpg,jpeg,webp|image|max:1024';
        }

        $validatedData = $request->validate($rules);

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
        if (isset($request->thumbnail)) {
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

            // cek achievement 
            $userId = $post->user_id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];
            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                $this->achievement($userId, $d);
            }

            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan');
        }
    }

    // view edit artikel / post
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

    // Publikasikan / jadikan artikel draf - untuk menu di halaman utama artikel/blog (dashboard)
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
        
        // cek achievement
        $post->status = $data['status']; // update nilai status dari post, karena nilainya bisa saja berubah
        if (isset($post['status'])) {
            $userId = $post->user_id;

            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];
            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                $this->achievement($userId, $d);
            }
        }

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

    // function cekAchievement()
    // {
    //     $userId = Auth::user()->id;

    //     ['artikel', 'totalViewBlog', 'viewBlog']
    //     // cek achievement view blog
    //     $value = Blog::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
    //     $this->achievement($userId, 'viewKosakata', $value);

    //     // cek achievement total view blog
    //     $value = Blog::where('user_id', '=', $userId)->sum('view') ?? 0;
    //     $this->achievement($userId, 'totalViewBlog', $value);
    // }
}
