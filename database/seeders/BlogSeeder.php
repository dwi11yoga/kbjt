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
</div>',
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
  </p>',
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
</p>',
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
</p>',
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
</p>',
        'status' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],


      [
        'judul' => 'Dokumentasi: Membaca dan Menulis Aksara Jawa',
        'subjudul' => 'Belajar Carakan, Pasangan, dan Sandangan.',
        'slug' => 'membaca-dan-menulis-aksara-jawa',
        'user_id' => 1,
        'konten' => '<p>
            Aksara Jawa adalah sistem tulisan tradisional yang digunakan untuk menulis bahasa Jawa. Aksara ini memiliki
            bentuk
            unik yang tidak menggunakan huruf Latin seperti alfabet dalam bahasa Indonesia. Sebagai warisan budaya yang
            kaya,
            aksara Jawa—juga dikenal sebagai Carakan—memiliki aturan baca dan tulis tersendiri yang berbeda dari sistem
            ejaan
            modern. Karena itu, banyak orang yang baru pertama kali mengenal aksara Jawa merasa bingung bagaimana cara
            membaca
            atau menuliskannya.
        </p>
        <p>
            Panduan ini ditujukan khusus bagi kamu yang ingin mulai memahami dasar-dasar membaca aksara
            Jawa, termasuk aksara pokok (carakan), bentuk tambahan untuk menghilangkan vokal (pasangan), dan tanda baca
            vokal
            atau konsonan tambahan (sandangan). Mari kita mulai dari dasar.
        </p>

        <h1>Aksara Carakan: Huruf-Huruf Dasar</h1>
        <p>
            Aksara Carakan terdiri dari 20 huruf dasar yang masing-masing melambangkan satu suku kata yang terdiri dari
            konsonan dan vokal "a". Misalnya, aksara <span class="jawa">"ꦏ"</span> dibaca ka, <span
                class="jawa">"ꦠ"</span> dibaca ta, dan <span class="jawa">"ꦱ"</span> dibaca sa. Dalam penulisan,
            aksara carakan selalu menyertakan vokal secara default, yaitu vokal a. Jadi ketika kamu membaca huruf <span
                class="jawa">"ꦒ"</span>, kamu
            harus tahu bahwa ini dibaca ga, bukan hanya g. Inilah yang membedakan aksara Jawa dari huruf Latin; vokalnya
            sudah melekat pada bentuk hurufnya.
        </p>
        <p>
            Selain bentuk dasar, beberapa aksara carakan memiliki pasangan konsonan yang mirip, tapi berbeda bentuk bila
            digunakan dalam posisi tertentu. Misalnya, <span class="jawa">"ꦚ"</span> (nya) berbeda dari pasangan bentuk
            ny-annya. Karena itulah,
            penting untuk mengenali tiap huruf dasar beserta bunyi yang melekat padanya.
        </p>
        <p>
            Berikut ini adalah tabel lengkap dari aksara carakan.
        </p>

        <div class="grid md:grid-cols-10 grid-cols-5 gap-1 md:w-fit border-4 border-amber-400 rounded-lg">
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦲ</div>
                <div class="text-center px-3 pb-3">Ha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦤ</div>
                <div class="text-center px-3 pb-3">Na</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦕ</div>
                <div class="text-center px-3 pb-3">Ca</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦫ</div>
                <div class="text-center px-3 pb-3">Ra</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦏ</div>
                <div class="text-center px-3 pb-3">Ka</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦢ</div>
                <div class="text-center px-3 pb-3">Da</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦠ</div>
                <div class="text-center px-3 pb-3">Ta</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦱ</div>
                <div class="text-center px-3 pb-3">Sa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦮ</div>
                <div class="text-center px-3 pb-3">Wa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦭ</div>
                <div class="text-center px-3 pb-3">La</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦥ</div>
                <div class="text-center px-3 pb-3">Pa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦝ</div>
                <div class="text-center px-3 pb-3">Dha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦗ</div>
                <div class="text-center px-3 pb-3">Ja</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦪ</div>
                <div class="text-center px-3 pb-3">Ya</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦚ</div>
                <div class="text-center px-3 pb-3">Nya</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦩ</div>
                <div class="text-center px-3 pb-3">Ma</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦒ</div>
                <div class="text-center px-3 pb-3">Ga</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦧ</div>
                <div class="text-center px-3 pb-3">Ba</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦛ</div>
                <div class="text-center px-3 pb-3">Tha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦔ</div>
                <div class="text-center px-3 pb-3">Nga</div>
            </div>

        </div>

        <h1>Pasangan: Menggabungkan Konsonan Tanpa Vokal</h1>
        <p>
            Dalam aksara Jawa, jika sebuah konsonan ingin diikuti oleh konsonan lain tanpa menyisipkan vokal "a" di
            antaranya, kita harus menggunakan bentuk pasangan. Pasangan adalah versi khusus dari huruf carakan yang biasanya
            ditulis di bawah huruf sebelumnya. Fungsi utama pasangan adalah menghilangkan vokal "a" dari huruf sebelumnya
            agar suku kata bisa bersambung tanpa vokal.
        </p>
        <p>
            Contoh sederhana: kata montor. Jika ditulis dengan aksara carakan biasa tanpa pasangan, maka akan
            terbaca ma-na-ta-r <span class="jawa">(ꦩꦺꦴꦤꦠꦂ)</span>, bukan montor <span class="jawa">(ꦩꦺꦴꦤ꧀ꦠꦺꦴꦂ)</span>.
            Untuk menulisnya dengan benar, huruf "ta" harus ditulis sebagai pasangan di
            bawah huruf "na", sehingga pembacaan menjadi montor sesuai pelafalan. Karena itu, mengenali bentuk pasangan tiap
            huruf menjadi sangat penting agar tidak salah baca.
        </p>
        <p>
            Setiap huruf carakan punya bentuk pasangan sendiri yang tidak selalu mirip dengan bentuk huruf dasarnya.
            Penempatan pasangan umumnya berada di bawah huruf sebelumnya, kecuali pada beberapa kondisi khusus seperti pada
            akhir baris.
        </p>
        <p>
            Berikut ini adalah tabel lengkap dari aksara carakan.
        </p>

        <div class="grid md:grid-cols-10 grid-cols-5 gap-1 md:w-fit border-4 border-amber-400 rounded-lg">
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦲ</div>
                <div class="text-center px-3 pb-3">Ha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦤ</div>
                <div class="text-center px-3 pb-3">Na</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦕ</div>
                <div class="text-center px-3 pb-3">Ca</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦫ</div>
                <div class="text-center px-3 pb-3">Ra</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦏ</div>
                <div class="text-center px-3 pb-3">Ka</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦢ</div>
                <div class="text-center px-3 pb-3">Da</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦠ</div>
                <div class="text-center px-3 pb-3">Ta</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦱ</div>
                <div class="text-center px-3 pb-3">Sa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦮ</div>
                <div class="text-center px-3 pb-3">Wa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦭ</div>
                <div class="text-center px-3 pb-3">La</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦥ</div>
                <div class="text-center px-3 pb-3">Pa</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦝ</div>
                <div class="text-center px-3 pb-3">Dha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦗ</div>
                <div class="text-center px-3 pb-3">Ja</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦪ</div>
                <div class="text-center px-3 pb-3">Ya</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦚ</div>
                <div class="text-center px-3 pb-3">Nya</div>
            </div>

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦩ</div>
                <div class="text-center px-3 pb-3">Ma</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦒ</div>
                <div class="text-center px-3 pb-3">Ga</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦧ</div>
                <div class="text-center px-3 pb-3">Ba</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦛ</div>
                <div class="text-center px-3 pb-3">Tha</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀ꦔ</div>
                <div class="text-center px-3 pb-3">Nga</div>
            </div>

        </div>


        <h1>Sandangan: Menambah atau Mengubah Bunyi</h1>
        <p>
            Selain carakan dan pasangan, aksara Jawa juga mengenal yang disebut sandangan, yaitu tanda tambahan untuk
            mengubah atau menambahkan vokal atau konsonan. Sandangan sangat penting karena suara vokal dalam aksara Jawa
            tidak selalu “a”—bisa menjadi i, u, e, é, o, dan bahkan diftong seperti ai atau au.
        </p>
        <p>
            Contohnya, sandangan <span class="jawa">ꦶ</span> disebut wulu, berfungsi untuk mengubah vokal "a" menjadi
            "i". Jadi huruf <span class="jawa">"ꦏ"</span> (ka)
            ditambah sandangan <span class="jawa">ꦶ</span> menjadi "ki" <span class="jawa">(ꦏꦶ)</span>. Ada juga
            sandangan <span class="jawa">ꦼ</span> (pepet) untuk vokal "e", atau <span class="jawa">ꦺ</span> untuk
            vokal
            “é”. Selain vokal, ada pula sandangan untuk konsonan akhir seperti <span class="jawa">ꦁ</span> (cecak) untuk
            bunyi ng, atau <span class="jawa">“ꦃ”</span>
            (wignyan) untuk bunyi h.
        </p>
        <p>
            Penggunaan sandangan ini harus hati-hati karena letaknya tidak selalu di samping atau bawah huruf. Beberapa
            berada di atas, dan bahkan beberapa di tengah huruf. Penempatan yang salah bisa menyebabkan makna berubah atau
            tulisan menjadi tidak terbaca.
        </p>
        <p>
            Berikut ini adalah tabel dari sandangan yang sering digunakan.
        </p>
        <div class="grid md:grid-cols-9 grid-cols-5 gap-1 md:w-fit border-4 border-amber-400 rounded-lg">

            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦶ</div>
                <div class="text-center px-3 pb-3">wulu (-i)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦸ</div>
                <div class="text-center px-3 pb-3">suku (-u)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦺ</div>
                <div class="text-center px-3 pb-3">taling (-é)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦺꦴ</div>
                <div class="text-center px-3 pb-3">taling tarung (-o)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦼ</div>
                <div class="text-center px-3 pb-3">pepet (-e/-eu)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦁ</div>
                <div class="text-center px-3 pb-3">cecak (-ng)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦂ</div>
                <div class="text-center px-3 pb-3">layar (-r)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">ꦃ</div>
                <div class="text-center px-3 pb-3">wignyan (-h)</div>
            </div>
            <div class="">
                <div class="text-center px-3 pt-3 jawa font-bold text-2xl">꧀</div>
                <div class="text-center px-3 pb-3">pangkon</div>
            </div>
        </div>

        <h1>Kesimpulan</h1>
        <p>
            Membaca aksara Jawa memang membutuhkan kesabaran dan latihan, terutama jika kamu belum terbiasa dengan
            bentuk-bentuk hurufnya. Dengan mengenali tiga unsur penting yaitu carakan (huruf dasar), pasangan (penggabung
            konsonan), dan sandangan (tanda vokal atau tambahan), kamu sudah memegang kunci utama dalam membaca teks aksara
            Jawa. Semakin sering kamu membaca dan mencoba menulis, maka akan semakin mudah kamu mengenali pola dan
            bentuknya.
        </p>
        <p>
            Jika kamu ingin mempelajari lebih dalam tentang bentuk lengkap aksara Jawa—termasuk angka Jawa (angka Jawa),
            tanda baca (pada), aksara rekan (untuk bunyi asing), dan contoh kalimat, silakan buka panduan lengkapnya melalui
            link berikut:
            <a href="https://bukubiruku.com/aksara-jawa-lengkap-dan-pasangan/">
                <span>Aksara Jawa Lengkap dan Pasangan dari Bukubiruku.com</span>
                <i data-feather="arrow-up-right" class="w-5 inline"></i>
            </a>
        </p>',
        'status' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],

      [
        'judul' => 'Dokumentasi: Menulis Aksara Jawa di Kamus Besar Bahasa Jawa',
        'subjudul' => 'Panduan singkat dalam menginput aksara jawa di kbjt.',
        'slug' => 'menulis-aksara-jawa-di-kbjt',
        'user_id' => 1,
        'konten' => '<p>
  Kini, menambahkan kosakata atau deskripsi di Kamus Bahasa Jawa Terbuka (KBJT)
  jadi jauh lebih praktis berkat aplikasi dan alat daring. Kalau kamu masih
  bingung cara mengetik aksara Jawa di ponsel maupun komputer, panduan ini siap
  membantumu. Simak langkah‑langkah mudah berikut untuk memasukkan aksara Jawa
  langsung ke form KBJT, baik melalui Android maupun PC/laptop.
</p>

<h1>Cara Menulis Aksara Jawa di HP Android dengan Gboard</h1>
<p>
  Jika kamu pengguna Android, kamu bisa menulis aksara Jawa secara langsung
  menggunakan Google Keyboard (Gboard). Gboard adalah aplikasi keyboard bawaan
  yang banyak digunakan di Android, dan kini telah mendukung bahasa Jawa
  termasuk aksara Jawanya.
</p>
<p>Langkah-langkahnya:</p>

<ol>
  <li>
    Buka pengaturan HP kamu dan masuk ke menu Bahasa & Input atau Bahasa &
    Keyboard.
  </li>
  <li>Pilih Gboard → Bahasa → Tambahkan Keyboard.</li>
  <li>
    Cari dan pilih Jawa. Pastikan kamu mengaktifkan mode Aksara Jawa, bukan
    hanya Latin.
  </li>
  <li>
    Setelah aktif, saat mengetik di aplikasi apa pun, kamu bisa mengganti ke
    keyboard Jawa dengan menahan ikon globe 🌐 di keyboard.
  </li>
</ol>

<h1>Cara lainnya?</h1>
<p>
  Apabila ponselmu belum mendukung pengetikan aksara Jawa, atau kamu lebih
  sering bekerja di komputer/laptop, kamu dapat memanfaatkan situs online yang
  menyediakan keyboard aksara Jawa virtual. Dua pilihan yang sangat mudah
  digunakan adalah menggunakan lexilagos atau keymanweb. Berikut merupakan
  langkah-langkahnya
</p>

<ol>
  <li>
    Kunjungi
    <a href="https://www.lexilogos.com/keyboard/jawa.htm" target="_blank">
      Lexilogos <i data-feather="arrow-up-right" class="w-4 inline"></i>
    </a>
     atau
    <a href="https://keymanweb.com/#jv-java,Keyboard_jawa" target="_blank">
      KeymanWeb <i data-feather="arrow-up-right" class="w-4 inline"></i>
    </a>
  </li>
  <li>
    Kamu dapat mengetik huruf Latin seperti biasa, lalu secara otomatis hasilnya
    akan berubah menjadi aksara Jawa di kotak samping, atau langsung menggunakan
    tombol/keyboard virtual aksara Jawa yang disediakan.
  </li>
  <li>
    Setelah selesai, kamu bisa menyalin hasilnya dan menempelkannya ke form Kamus Bahasa Jawa Terbuka.
  </li>
</ol>

<h1>Kesimpulan</h1>
<p>
  Menulis dalam aksara Jawa kini bukan hal yang sulit lagi. Dengan dukungan
  teknologi seperti Gboard di Android dan situs seperti Lexilogos atau
  KeymanWeb, siapa pun bisa mencoba dan belajar menulis dalam aksara tradisional
  ini. Mari kita lestarikan bahasa dan aksara Jawa dengan cara yang menyenangkan
  dan mudah diakses oleh semua orang!
</p>
',
        'status' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
    ]);
    //factory
    Blog::factory(100)->create();
  }
}
