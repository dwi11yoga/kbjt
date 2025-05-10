<?php

namespace Database\Seeders;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::insert([
            [
                'judul' => 'Dokumentasi: Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka',
                'subjudul' => 'Panduan singkat untuk mulai berkontribusi di kbjt.',
                'slug' => 'berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka',
                'user_id' => 1,
                'konten' => '<div>
  Selamat datang di kamus bahasa jawa terbuka! Senang melihat semangatmu untuk
  ikut melestarikan kekayaan bahasa Jawa lewat KBJT. Di sini, setiap penambahan
  kata, perbaikan detail, atau melaporkan kesalahan bukan cuma sekadar
  data—melainkan wujud nyata menjaga warisan budaya yang tak ternilai harganya.
  Dengan bergandeng tangan melalui platform crowdsource, kita membangun
  perpustakaan bahasa Jawa yang komprehensif, akurat, dan mudah diakses siapa
  saja. Yuk, simak panduan lengkap agar setiap kontribusimu berdampak besar bagi
  masyarakat dan untuk eksistensi bahasa jawa!
</div>
<h1>Menambah Kosakata</h1>
<div>
  Menambahkan kosakata baru di KBJT berarti kamu menghidupkan kembali kata-kata
  yang mungkin sudah mulai terlupakan. Lewat kontribusi ini, kita bersama-sama
  menyusun kamus yang mencakup ragam ungkapan sehari-hari hingga istilah klasik.
  Setiap entri dilengkapi rincian fonetik, aksara Jawa, dan etimologi sehingga
  memberi konteks mendalam bagi pengguna dalam memahami arti dan cara
  pengucapan.
</div>
<div></div>
<ol>
  <li>Buka halaman <strong>Daftar Kosakata</strong> di menu utama.</li>
  <li>
    Isi form dengan informasi: <br />
    <ul>
      <li><strong>Kosakata</strong></li>
      <li><strong>Notasi fonetik</strong></li>
      <li><strong>Aksara Jawa</strong></li>
      <li><strong>Kelas kata</strong> (ngoko, krama, dsb.)</li>
      <li><strong>Jenis</strong> (kata benda, kerja, sifat…)</li>
      <li>
        <strong>Kosakata serupa</strong> (bentuk kosakata dalam kelas kata lain)
      </li>
      <li>
        <strong>Arti dalam Bahasa Indonesia </strong>(agar kosakata mudah dicari
        menggunkan bahasa jawa maupun bahasa indonesia)
      </li>
      <li><strong>Etimologi</strong> (asal kata)</li>
    </ul>
  </li>
  <li>Klik <strong>Submit</strong>.</li>
</ol>
<div></div>
<div>Poin: +50 (10 Mei 2025)</div>
<h1>Edit Kosakata</h1>
<div>
  Kadang kita menemukan entri yang perlu perbaikan—entah karena typo, kelas kata
  yang kurang tepat, atau karena alasan lain. Dengan fitur edit, kamu
  berkesempatan memperbaiki dan memperbarui data suatu kosakata, sehingga
  kualitas kamus dapat terjaga. Setiap usulan edit akan diperiksa oleh tim
  pengurus untuk memastikan akurasi dan relevansi. Dengan demikian, kesalahan
  bisa diminimalisir dan kamus selalu mutakhir.
</div>
<div></div>
<ol>
  <li>Kunjungi halaman kosakata yang hendak diperbarui.</li>
  <li>
    Mlik menu (<strong>···</strong>) dan pilih opsi <strong>Edit</strong>.
  </li>
  <li>Perbaiki detail di form (mirip form tambah kosakata).</li>
  <li>Klik <strong>Submit</strong> dan tunggu verifikasi tim pengurus.</li>
</ol>
<div></div>
<div>Poin: +30 (10 Mei 2025)</div>
<h1>Menambah Definisi</h1>
<div>
  Definisi yang jelas dengan contoh kalimat dan informasi tentang variasi dialek
  membuat arti kata semakin hidup. Dengan menambahkan definisi lengkap, kamu
  membantu pengguna memahami nuansa makna dan cara penggunaan kata dalam konteks
  yang tepat. Sertakan contoh kalimat sehari-hari, catatan dialek, atau
  referensi buku agar data semakin kuat.
</div>
<div></div>
<ol>
  <li>Buka halaman kosakata yang ingin ditambah definisinya.</li>
  <li>Klik <strong>Tambah Definisi</strong>.</li>
  <li>
    Isi form dengan: <br />
    <ul>
      <li><strong>Definisi</strong></li>
      <li><strong>Contoh Kalimat</strong></li>
      <li><strong>Dialek</strong> (misal: Mataraman, Banyumasan…)</li>
      <li>
        <strong>Referensi</strong> (sumber buku, artikel, dsb.), pisahkankan
        dengan tanda titik koma (;).
      </li>
    </ul>
  </li>
  <li>Klik <strong>Submit</strong>.</li>
</ol>
<div></div>
<div>Poin: +20 (10 Mei 2025)</div>
<h1>Melaporkan Definisi</h1>
<div>
  Karena berbasis <em>crowdsource</em> atau urun daya, terkadang kamu akan
  menemukan definisi yang perlu pembaruan atau koreksi. Fitur laporan
  memungkinkan memberitahu tim pengurus tentang keberadaan definisi yang salah,
  sehingga mereka dapat melakukan pengecekan dan mengambil langkah-langkah yang
  diperlukan. Dengan melaporkan sebuah definisi kurang tepat, kamu ikut menjadi
  penjaga mutu kamus dan membantu pengguna mendapatkan informasi yang layak dan
  dapat dipercaya. Proses ini menjaga integritas data dan memperkuat rasa
  percaya komunitas terhadap KBJT.
</div>
<div></div>
<ol>
  <li>
    Pilih menu (<strong>···</strong>) dan klik <strong>Laporkan</strong> pada
    definisi yang keliru.
  </li>
  <li>
    Isi form laporan: <br />
    <ul>
      <li><strong>Alasan</strong> (dropdown pilihan)</li>
      <li>
        <strong>Catatan</strong> (berikan penjelasan singkat mengapa definisi
        ini salah)
      </li>
    </ul>
  </li>
  <li>Klik <strong>Submit</strong> dan tunggu tindak lanjut pengurus.</li>
</ol>
<div></div>
<div>
  Poin: +30 (10 Mei 2025) jika laporan memang ditemukan adanya kesalahan.
</div>
<h1>Minta Pengurus untuk Menghapus Kosakata</h1>
<div>
  Menemukan kata yang tidak sesuai standar, vulgar, atau tidak relevan dengan
  konteks bahasa Jawa? Lewat permintaan penghapusan, kamu membantu menjaga
  komunitas dari kata yang mungkin bukanlah bahasa Jawa. Pengurus akan meninjau
  alasan dan data pendukung sebelum memutuskan untuk menghapus atau mengarsipkan
  entri tersebut. Fitur ini memastikan kata-kata yang tidak layak tidak
  mengganggu pengguna lain dan menjaga kualitas kamus tetap tinggi.
</div>
<div></div>
<ol>
  <li>
    Klik menu (<strong>···</strong>) dan pilih
    <strong>PMinta hapus</strong> pada halaman kosakata.
  </li>
  <li>
    Isi form:
    <ul>
      <li><strong>Alasan</strong> (dropdown pilihan)</li>
      <li><strong>Catatan</strong> (opsional, penjelasan singkat).</li>
    </ul>
  </li>
  <li>Klik <strong>Submit</strong> untuk mengajukan permintaan.</li>
</ol>
<div></div>
<div>
  Catatan: Jika kosakata masih dapat diperbaiki dengan edit kosakata, maka fitur
  ini tidak perlu digunakan.<br />Poin: +40 (10 Mei 2025)
</div>
<h1>Kesimpulan</h1>
<div>
  Dengan setiap kontribusi—mulai dari menambah kosakata, memperbarui entri,
  hingga melaporkan atau meminta penghapusan—kamu turut andil dalam merawat
  warisan budaya Jawa. KBJT adalah rumah bersama bagi semua penutur dan pegiat
  bahasa; semakin aktif kita berkolaborasi, semakin kaya dan terpercaya kamus
  ini. Mari terus berbagi ilmu, menjaga akurasi, dan membangun komunitas yang
  saling mendukung demi bahasa Jawa yang lestari!
</div>

        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div><strong>Dokumentasi lain</strong></div>
            <div class="mb-2">Butuh panduan lain? Cek artikel-artikel berikut yang mungkin bermanfaat untukmu.</div>
            <ul class="space-y-1">
                <li>Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka</li>
                <li><a href="/blog/post/memahami-sistem-poin-level">Memahami sistem poin & level</a></li>
                <li><a href="/blog/post/manfaat-berkontribusi-secara-aktif-di-kamus-bahasa-jawa-terbuka">Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/tindaklanjut-terhadap-kontribusi-bermasalah">Tindaklanjut terhadap kontribusi bermasalah</a></li>
                <li><a href="/blog/post/mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan">Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</a></li>
            </ul>
        </div>
',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'judul' => 'Dokumentasi: Memahami sistem poin & level',
                'subjudul' => 'Pelajari bagaimana level dan poin bekerja di kbjt.',
                'slug' => 'memahami-sistem-poin-level',
                'user_id' => 1,
                'konten' => '<p>
    Di KBJT, kontribusimu tidak hanya dihargai secara moral, tetapi juga tercermin dalam bentuk poin dan level. Sistem ini dirancang untuk memberikan apresiasi kepada kontributor yang aktif dan bertanggung jawab, sekaligus menjaga kualitas isi kamus secara kolektif. Semakin banyak kontribusi yang kamu lakukan, seperti menambah kosakata, memperbarui definisi, atau memberikan laporan yang berguna, semakin tinggi pula poin yang kamu kumpulkan. Ini adalah cara kami menunjukkan bahwa setiap upaya kecilmu membawa dampak besar dalam pelestarian bahasa Jawa.
  </p>

  <h1>Poin</h1>
  <p>
    Poin akan bertambah setiap kali kamu melakukan kontribusi yang valid dan bermanfaat. Misalnya, ketika kamu menambahkan kosakata baru yang lengkap dan benar, memperbaiki entri yang keliru, atau menyumbangkan definisi yang kaya dan relevan. Setiap kontribusi ini akan melewati proses verifikasi oleh tim pengurus, dan jika disetujui, poinmu akan otomatis bertambah sesuai bobot kontribusinya. Jadi, konsistensi dan kualitas adalah kunci untuk menaikkan poin secara cepat dan berkelanjutan.
  </p>
  <p>
    Tidak semua kontribusi akan langsung menambah poin. Jika ditemukan bahwa seseorang dengan sengaja memberikan data yang keliru atau asal-asalan, maka poin akan dikurangi sebagai bentuk tanggung jawab. Ini dilakukan untuk menjaga integritas platform dan mendorong setiap kontributor agar lebih cermat dan jujur dalam mengisi data. Pengurangan poin tidak dilakukan sembarangan, melainkan berdasarkan evaluasi pengurus dan disertai notifikasi.
  </p>

  <h1>Level</h1>
  <p>
    Poin yang kamu kumpulkan akan menentukan level kontribusimu. Setiap level mencerminkan tingkat pengalaman dan dedikasi dalam membantu KBJT tumbuh.
  </p>
  <p>
    Untuk memberikan penghargaan khusus, kami menampilkan 100 kontributor dengan poin tertinggi dalam halaman <strong>Hall of Fame</strong>. Nama-nama ini juga akan muncul di homepage KBJT sebagai bentuk apresiasi terbuka kepada mereka yang telah memberi kontribusi luar biasa. Ini bukan sekadar papan peringkat, tapi juga tempat inspirasi bagi pengguna lain untuk ikut berkontribusi aktif dan positif.
  </p>

  <h1>Kesimpulan</h1>
  <p>
    Sistem level dan poin di KBJT bukan sekadar angka—ia adalah bentuk apresiasi atas waktu, tenaga, dan perhatian yang kamu curahkan untuk melestarikan bahasa Jawa. Semakin konsisten dan jujur kamu berkontribusi, semakin tinggi pula penghargaan yang akan kamu terima. Mari bersama-sama kita ciptakan komunitas yang aktif, suportif, dan bertanggung jawab, demi bahasa Jawa yang tetap hidup dan berkembang!
  </p>

        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div><strong>Dokumentasi lain</strong></div>
            <div class="mb-2">Butuh panduan lain? Cek artikel-artikel berikut yang mungkin bermanfaat untukmu.</div>
            <ul class="space-y-1">
                <li><a href="/blog/post/berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka">Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka</a></li>
                <li>Memahami sistem poin & level</li>
                <li><a href="/blog/post/manfaat-berkontribusi-secara-aktif-di-kamus-bahasa-jawa-terbuka">Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/tindaklanjut-terhadap-kontribusi-bermasalah">Tindaklanjut terhadap kontribusi bermasalah</a></li>
                <li><a href="/blog/post/mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan">Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</a></li>
            </ul>
        </div>',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'judul' => 'Dokumentasi: Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka',
                'subjudul' => 'Mulai dari achievement, sertifikat, hingga dana donasi.',
                'slug' => 'manfaat-berkontribusi-secara-aktif-di-kamus-bahasa-jawa-terbuka',
                'user_id' => 1,
                'konten' => '<p>
  Menjadi kontributor aktif di KBJT bukan hanya soal menambahkan data ke dalam
  kamus. Ini adalah tentang menjadi bagian dari sebuah gerakan besar untuk
  menjaga agar bahasa Jawa tetap hidup, relevan, dan dapat dipelajari oleh
  generasi selanjutnya. Kontribusimu, sekecil apa pun, membantu membentuk
  ekosistem pengetahuan yang terbuka, kolaboratif, dan bermanfaat bagi banyak
  orang. KBJT menghargai semangat itu dengan memberikan berbagai manfaat bagi
  kontributor yang terus aktif dan bertanggung jawab.
</p>

<h1>Achievement</h1>
<p>
  Setiap langkah kecil yang kamu ambil di KBJT bisa membuka pencapaian
  (achievement) baru. Sistem achievement kami mencatat aktivitas kontribusimu,
  seperti menambahkan kosakata, memberikan definisi yang kaya, melaporkan
  kesalahan, atau membantu mengembangkan detail entri. Saat kamu semakin aktif,
  kamu akan melihat berbagai badge atau pencapaian terbuka, sebagai pengingat
  bahwa kontribusimu itu nyata dan diakui oleh komunitas. Achievement ini juga
  bisa memotivasi pengguna lain untuk ikut terlibat lebih dalam.
</p>

<h1>Sertifikat</h1>
<p>
  Sertifikat merupakan bentuk penghargaan resmi yang diberikan kepada
  kontributor yang telah menunjukkan dedikasi tinggi dan kontribusi berkualitas
  dalam jangka waktu tertentu. Tidak seperti achievement yang bisa terbuka
  secara otomatis, sertifikat memiliki tingkat kesulitan yang lebih tinggi untuk
  diperoleh. Pengguna harus memenuhi syarat tertentu yang ditentukan oleh tim
  pengurus untuk mengklaim sertifikat. Setelah semua syarat terpenuhi, pengguna
  dapat mengklaim sertifikat secara digital melalui halaman
  <a href="/sertifikat">sertifikat</a>.
</p>

<h1>Donasi dari Pengguna Lain</h1>
<p>
  Salah satu bentuk apresiasi yang paling bermakna adalah ketika pengguna lain
  merasa terbantu oleh kontribusimu, dan memilih untuk memberikan donasi sebagai
  ucapan terima kasih. KBJT menyediakan fitur opsional yang memungkinkan kamu
  menerima donasi dari pengguna lain. Pengaturan ini bisa kamu aktifkan di
  pengaturan, lebih tepatnya di halaman
  <a href="/pengaturan/donasi">terima donasi</a>. Donasi ini bersifat sukarela
  dan dapat menjadi motivasi tambahan untuk terus berbagi pengetahuan dan
  menjaga semangat kolaborasi di platform ini.
</p>

<h1>Kesimpulan</h1>
<p>
  Menjadi kontributor aktif di KBJT berarti kamu telah mengambil peran penting
  dalam pelestarian bahasa Jawa dan pembangunan komunitas digital yang sehat.
  Selain mendapatkan berbagai manfaat seperti achievement, sertifikat, dan
  donasi, kamu juga menjadi inspirasi bagi pengguna lain. Kebaikan dan kerja
  kerasmu punya tempat yang dihargai di sini. Teruslah berkontribusi dan jadilah
  bagian dari perubahan positif untuk budaya dan bahasa kita.
</p>

        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div><strong>Dokumentasi lain</strong></div>
            <div class="mb-2">Butuh panduan lain? Cek artikel-artikel berikut yang mungkin bermanfaat untukmu.</div>
            <ul class="space-y-1">
                <li><a href="/blog/post/berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka">Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/memahami-sistem-poin-level">Memahami sistem poin & level</a></li>
                <li>Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka</li>
                <li><a href="/blog/post/tindaklanjut-terhadap-kontribusi-bermasalah">Tindaklanjut terhadap kontribusi bermasalah</a></li>
                <li><a href="/blog/post/mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan">Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</a></li>
            </ul>
        </div>',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'judul' => 'Dokumentasi: Tindaklanjut terhadap kontribusi bermasalah',
                'subjudul' => 'Hukuman terhadap kontributor yang melanggar syarat dan ketentuan.',
                'slug' => 'tindaklanjut-terhadap-kontribusi-bermasalah',
                'user_id' => 1,
                'konten' => '<p>
  Kontribusi di KBJT bersifat terbuka dan kolaboratif, namun tetap membutuhkan
  tanggung jawab dari setiap pengguna. Setiap kosakata dan definisi yang kamu
  tambahkan atau ubah akan dibaca dan digunakan oleh banyak orang untuk memahami
  bahasa Jawa. Karena itu, kami memiliki sistem pengawasan dan tindak lanjut
  terhadap kontribusi yang dianggap menyesatkan, tidak akurat, atau dibuat
  secara sembarangan. Langkah-langkah ini tidak dibuat untuk membatasi
  kreativitas, tetapi untuk menjaga agar KBJT tetap menjadi sumber yang
  terpercaya dan berkualitas.
</p>

<h1>Tindakan terhadap Kontribusi yang Bermasalah</h1>

<h1>Definisi Disembunyikan Sementara atau dihapus</h1>
<p>
  Jika ada definisi yang terbukti salah, tidak sesuai konteks, atau
  membingungkan, maka definisi tersebut akan dapat disembunyikan sementara dari
  tampilan publik atau dihapus secara permanen. Jika definisi disembunyikan,
  status ini akan berlangsung sampai definisi diperbaiki oleh kontributor. Ini
  adalah bentuk perlindungan awal agar informasi keliru tidak menyebar lebih
  luas.
</p>
<p>
  Jika definisi kamu disembunyikan. kamu bisa membaca artikel ini agar definisi
  kamu dapat kembali tampil ke publik:
  <a href="#">Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</a>.
</p>

<h1>Kosakata Dihapus Secara Permanen</h1>
<p>
  Untuk kasus yang lebih serius, seperti penambahan kosakata yang tidak valid,
  mengada-ada, atau tidak memiliki dasar penggunaan yang jelas, maka entri
  tersebut bisa langsung dihapus dari database KBJT. Ini dilakukan untuk
  memastikan kualitas kamus tetap terjaga dan tidak dipenuhi oleh informasi
  palsu.
</p>

<h1>Hukuman terhadap Pengguna</h1>

<h1>Peringatan</h1>
<p>
  Tidak semua kesalahan akan langsung dihukum. Dalam banyak kasus, terutama jika
  kesalahan bersifat ringan atau tidak disengaja, pengguna hanya akan diberi
  peringatan tanpa dikenakan sanksi apa pun. Tujuannya adalah memberikan ruang untuk
  belajar dan memperbaiki kontribusi.
</p>

<h1>Pengurangan Poin</h1>
<p>
  Kontributor yang sengaja menyebarkan informasi keliru atau mengulang kesalahan
  meski sudah diperingatkan, bisa dikenai pengurangan poin. Pengurangan ini
  bersifat persentase, mulai dari 2% hingga 20% tergantung pada tingkat
  pelanggaran. Ini berdampak langsung pada level pengguna dan posisinya di
  leaderboard.
</p>

<h1>Suspend Sementara</h1>
<p>
  Untuk pelanggaran berat atau berulang, akun pengguna bisa disuspend sementara.
  Lama suspend bisa bervariasi antara 3 hari, 7 hari, 14 hari, hingga 30 hari.
  Selama masa ini, pengguna tidak dapat melakukan kontribusi atau mengakses
  fitur tertentu di KBJT.
</p>

<h1>Pemblokiran Permanen</h1>
<p>
  Dalam kasus terparah, seperti pelanggaran yang disengaja, berulang, atau
  berniat merusak komunitas, akun bisa diblokir secara permanen. Semua
  kontribusi yang pernah dibuat juga akan ditinjau ulang, dan jika perlu,
  dihapus. Kami berharap hal ini tidak terjadi, namun kebijakan ini perlu
  diterapkan untuk menjaga integritas komunitas.
</p>

<h1>Kesimpulan</h1>
<p>
  Berkontribusi di KBJT bukan hanya tentang berbagi, tetapi juga tentang
  tanggung jawab terhadap apa yang dibagikan. Sistem konsekuensi ini dirancang
  bukan untuk menghukum, tetapi untuk menjaga kepercayaan publik terhadap
  kualitas isi kamus. Dengan berkontribusi secara jujur dan bertanggung jawab,
  kamu ikut menjaga nilai dan keberlangsungan proyek ini.
</p>

        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div><strong>Dokumentasi lain</strong></div>
            <div class="mb-2">Butuh panduan lain? Cek artikel-artikel berikut yang mungkin bermanfaat untukmu.</div>
            <ul class="space-y-1">
                <li><a href="/blog/post/berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka">Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/memahami-sistem-poin-level">Memahami sistem poin & level</a></li>
                <li><a href="/blog/post/manfaat-berkontribusi-secara-aktif-di-kamus-bahasa-jawa-terbuka">Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka</a></li>
                <li>Tindaklanjut terhadap kontribusi bermasalah</li>
                <li><a href="/blog/post/mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan">Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</a></li>
            </ul>
        </div>',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'judul' => 'Dokumentasi: Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan',
                'subjudul' => 'Langkah mudah untuk memperbaiki laporan yang disembunyikan.',
                'slug' => 'mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan',
                'user_id' => 1,
                'konten' => '<p>
  Dalam semangat menjaga kualitas konten di KBJT, setiap kontribusi yang dirasa
  kurang tepat atau membingungkan bisa dilaporkan oleh pengguna lain. Jika
  definisi yang kamu buat dilaporkan dan dinilai perlu perbaikan, sistem akan
  menyembunyikannya sementara agar tidak menyesatkan pengguna lain. Tapi jangan
  khawatir, kamu masih bisa memperbaikinya dan mengembalikan kontribusimu agar
  bisa dilihat kembali oleh publik. Berikut ini adalah langkah-langkah yang bisa
  kamu ikuti untuk mengembalikan definisi yang telah disembunyikan.
</p>

<h1>1. Buka Halaman Detail Laporan</h1>
<p>
  Langkah pertama adalah membuka halaman yang memuat detail laporan terhadap
  definisi yang kamu buat. Di sana kamu bisa melihat alasan kenapa definisimu
  disembunyikan serta catatan tambahan dari pelapor atau pengurus. Hal ini
  penting agar kamu tahu bagian mana yang perlu diperbaiki.
</p>

<h1>2. Klik Tombol "Perbaiki"</h1>
<p>
  Setelah memahami laporan, klik tombol <strong>Perbaiki</strong> yang tersedia
  di halaman detail laporan tersebut. Tombol ini akan membawamu langsung ke
  tempat di mana kamu bisa mengedit definisi.
</p>

<h1>3. Edit Definisi dari Halaman Profil</h1>
<p>
  Kamu akan diarahkan ke halaman profilmu, tepatnya di bagian kontribusi
  definisi. Di sana, definisi yang disembunyikan akan diberi tanda khusus,
  misalnya label <strong>disembunyikan</strong>. Klik tombol edit pada definisi
  tersebut, lalu sesuaikan isinya agar lebih jelas, akurat, dan sesuai dengan
  konteks pelaporan.
</p>

<h1>4. Definisi Kembali Ditampilkan</h1>
<p>
  Setelah kamu menyimpan perbaikan yang sudah dilakukan, sistem akan kembali
  menampilkan definisi yang kamu submit agar bisa diakses oleh publik seperti
  biasa.
</p>

<h1>Kesimpulan</h1>
<p>
  Menjaga kualitas konten adalah tanggung jawab bersama. Jika definisimu sempat
  disembunyikan, anggap itu sebagai kesempatan untuk memperbaiki dan
  menyempurnakan kontribusimu. Dengan mengikuti langkah-langkah di atas, kamu
  bisa memastikan bahwa apa yang kamu bagikan tetap bermanfaat dan dapat
  dipercaya oleh komunitas.
</p>

        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div><strong>Dokumentasi lain</strong></div>
            <div class="mb-2">Butuh panduan lain? Cek artikel-artikel berikut yang mungkin bermanfaat untukmu.</div>
            <ul class="space-y-1">
                <li><a href="/blog/post/berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka">Berkontribusi sebagai kontributor di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/memahami-sistem-poin-level">Memahami sistem poin & level</a></li>
                <li><a href="/blog/post/manfaat-berkontribusi-secara-aktif-di-kamus-bahasa-jawa-terbuka">Manfaat berkontribusi secara aktif di Kamus Bahasa Jawa Terbuka</a></li>
                <li><a href="/blog/post/tindaklanjut-terhadap-kontribusi-bermasalah">Tindaklanjut terhadap kontribusi bermasalah</a></li>
                <li>Mengembalikan Definisi yang Disembunyikan Setelah Dilaporkan</li>
            </ul>
        </div>',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
        //factory
        Blog::factory(100)->create();
    }
}
