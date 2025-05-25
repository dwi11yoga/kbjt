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
    public function __construct()
    {
        // increment kunjungan di statistik jika user hari ini baru mengunjungi halaman web (berdasarkan cookie)
        $this->statKunjungan();
    }

    //blog view di dashboard
    public function index(Request $request)
    {
        // Definisikan filter yang dikirim
        $status = $request->status ?? null;
        $author = $request->author ?? null;
        $id_artikel = $request->id ?? null;

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

        // tampilkan terlebih dahulu artikel yang ada pada id
        if (!empty($id_artikel)) {
            $query->orderByRaw('id=? DESC', [$id_artikel]);
        }

        $blog = $query->orderBy('pinned', 'desc')
            ->orderBy('created_at', 'desc')
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

        // tambah poin pengurus yang mempublikasikan artikel
        if ($apakahPublish == true) {
            $data['poin'] = $this->poinKontribusi($data['user_id'], 'Publikasikan artikel');
        }

        // Simpan
        Blog::create($data);

        // redirect ke halaman edit
        if ($apakahSimpan == true) {
            $post = Blog::select('id', 'slug')->where('slug', '=', $validatedData['slug'])->first();
            return redirect('/artikel/edit/' . $post->id)->with('success', 'Artikel berhasil disimpan sebagai draf');
        } elseif ($apakahPublish == true) {

            // increment artikel dipublikasikan di statistik
            $this->stat('artikel_dipublikasikan');

            // cek achievement
            $userId = Auth::user()->id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];

            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                $this->achievement($userId, $d);
            }

            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan (+' . $data['poin'] . ' poin)');
        }
    }

    // Simpan artikel lama sebagai draft/publikasikan - digunakan untuk halaman edit artikel
    // hanya bisa digunakan oleh author yang membuat artikel
    public function simpanEdit(Request $request, $id)
    {
        // dapatkan data artikel yang diedit
        $post = Blog::find($id);

        // alihkan jika user bukan yang membuat artikel
        if ($post->user_id != Auth::user()->id) {
            return back()->with('failed', 'Akses tidak diizinkan');

        }

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
            // 'user_id' => Auth::user()->id,
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

        // tambah poin pengurus yang mempublikasikan artikel (jika dipublikasikan dan sebelumnya belum dipublikasikan)
        if ($apakahPublish == true && empty($post->status)) {
            $data['poin'] = $this->poinKontribusi($post->user_id, 'Publikasikan artikel');
            $poin_toast = $data['poin'] > 0 ? '(+' . $data['poin'] . ' poin)' : '';
        } elseif ($apakahSimpan == true && !empty($post->status)) { // kurangi poin pengurus yang meng-unpublish artikel (jika artikel disimpan dan sebelumnya sudah dipublikasikan)
            User::find($post->user_id)->decrement('poin', $post->poin); // kurangi poin user dengan poin yang sebelumnya didapatkan
            $data['poin'] = 0;
            $poin_toast = $post->poin > 0 ? '(-' . $post->poin . ' poin)' : '';
        } else {
            $poin_toast = ' (+0 poin)';
        }

        // Simpan
        Blog::find($id)->update($data);

        // redirect ke halaman edit
        if ($apakahSimpan == true) {
            // cek apakah blog sebelumnya sudah dipublikasikan sebelumnya
            if (!empty($post->status)) { // jika sebelumnya sudah dipublikasikan
                // decrement artikel dipublikasikan di statistik
                $this->statDecrement('artikel_dipublikasikan', $post->status);
            }

            return redirect('/artikel/edit/' . $post->id)->with('success', 'Artikel berhasil disimpan sebagai draf' . $poin_toast);
        } elseif ($apakahPublish == true) {

            // cek apakah blog sebelumnya sudah dipublikasikan sebelumnya
            if (empty($post->status)) { // jika sebelumnya belum dipublikasikan
                // increment artikel dipublikasikan di statistik
                $this->stat('artikel_dipublikasikan');
            }

            // cek achievement 
            $userId = $post->user_id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];
            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                $this->achievement($userId, $d);
            }

            return redirect('/artikel')->with('success', 'Artikel berhasil dipublikasikan' . $poin_toast);
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

    // Publikasikan / jadikan artikel draf - untuk menu di halaman list artikel/blog (dashboard)
    // hanya mengubah status artikel
    public function draft($id)
    {
        // dapatkan data artikel
        $post = Blog::find($id);

        // Jika post tidak ditemukan atau author bukanlah user
        if (empty($post)) {
            return back()->with('failed', 'Artikel tidak ditemukan');
        }

        // alihkan jika user bukan kepala dan bukan yang membuat artikel
        if ($post->user_id != Auth::user()->id && Auth::user()->role != 'kepala') {
            return $this->error403();
        }


        $data = [];
        $pesan = 'Tidak ada pesan';
        if (empty($post['status'])) {
            // Ubah status jadi dipublikasikan
            $data['status'] = now();
            $pesan = 'Artikel berhasil dipublikasikan';
        } else {
            // Ubah status jadi draf
            $data['status'] = null;
            $pesan = 'Artikel berhasil disimpan sebagai draf';
        }


        // Unpin jika post adalah pinned (publikasikan menjadi draft)
        if (isset($post['status']) && $post['pinned'] == 1) {
            $data['pinned'] = 0;
        }

        // tambah poin pengurus yang mempublikasikan artikel (jika dipublikasikan dan sebelumnya belum dipublikasikan)
        if (empty($post->status)) { // jika belum dipublikasikan - tambah poin user
            $data['poin'] = $this->poinKontribusi($post->user_id, 'Publikasikan artikel');
            $poin_toast = $data['poin'] > 0 ? '(+' . $data['poin'] . ' poin)' : '';
        } else { // kurangi poin pengurus yang meng-unpublish artikel (jika artikel disimpan dan sebelumnya sudah dipublikasikan)
            User::find($post->user_id)->decrement('poin', $post->poin); // kurangi poin user dengan poin yang sebelumnya didapatkan
            $data['poin'] = 0;
            $poin_toast = $post->poin > 0 ? '(-' . $post->poin . ' poin)' : '';
        }

        // Simpan
        Blog::where('id', '=', $id)->update($data);

        // cek apakah blog sebelumnya sudah dipublikasikan sebelumnya
        if (empty($post->status)) { // jika sebelumnya belum dipublikasikan
            // increment artikel dipublikasikan di statistik
            $this->stat('artikel_dipublikasikan');
        } else { // jika belum maka decrement
            // decrement artikel dipublikasikan di statistik
            $this->statDecrement('artikel_dipublikasikan', $post->status);
        }

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

        // dd($post->status);

        // kirim notifikasi ke penulis jika bukan penulis yang mengubah status artikel (kepala yang mengubah)
        if ($post->user_id != Auth::user()->id) {
            $notif = 'Artikel yang kamu tulis telah di' . (empty($post->status) ? 'jadikan sebagai draft' : 'publikasikan') . ' oleh kepala ' . $poin_toast;
            $url = '/artikel?id=' . $post->id;
            $this->kirimNotifikasi($post->user_id, 'blog', $notif, $url);
        } else { // tambahkan poin + atau - jika yang mengubah status adalah penulis sendiri
            $pesan = $pesan . ' ' . $poin_toast;
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

        // hapus artikel
        Blog::destroy($id);

        // kurangi poin yang diterima oleh user dari definisi yang dihapus
        $poin_dikurang = $post->poin;
        User::find($post->user_id)->decrement('poin', $poin_dikurang);

        // kembali ke view
        return back()->with('success', 'Artikel berhasil dihapus (-' . $poin_dikurang . ' poin)');
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
