<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selamat datang di Kamus Bahasa Jawa Terbuka!</title>
    <style>
        .box {
            width: 580px;
        }

        .tombol {
            background-color: #0867ec;
        }

        .tombol:hover {
            background-color: #ec0867;
        }

        @media screen and (max-width: 600px) {
            .box {
                width: 95%;
                margin-left: 10px;
            }
        }

        a {
            color: #ffba00;
        }

        /* .header {
            font-weight: 700;
            font-size: xx-large;
            text-decoration: underline;
            text-decoration-color: #ffba00;
            text-underline-offset: 8;
            text-decoration-thickness: 8px;
        } */
    </style>
</head>

<body
    style="background-color: #f4f5f6; font-family: Helvetica, sans-serif; line-height: 1.3; width: 100%; height: 100%; font-size: medium;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
        <tr>
            <td style="text-align: center; vertical-align: middle; width: 100%">
                <div style="display: inline-block; margin: 0 auto; text-align: left; max-width: 600px; width: 100%;">

                    {{-- header --}}
                    <div style="text-align: center; margin-top:30px">
                        <div style="font-weight: 700; font-size: xx-large;">
                            kbjt
                        </div>
                        {{-- <img src="https://diskominfo.bone.go.id/wp-content/uploads/2018/11/Logo_Kementerian_Kominfo.png"
                            alt="" width="30px" height="30px"> --}}
                    </div>

                    {{-- Isi/body email --}}
                    <div class="box"
                        style="background-color: white; border: 1px solid #eaebed; border-radius: 16px; padding: 10px 20px 10px 20px; box-sizing: border-box; margin-top: 20px; margin-bottom: 20px;">

                        <p>Selemat datang, {{ $user['nama'] }}!</p>
                        <p>
                            Terima kasih sudah mendaftar di Kamus Bahasa Jawa Terbuka! Kami menyambutmu sebagai
                            bagian dari komunitas yang peduli akan pelestarian dan pembelajaran
                            bahasa Jawa.
                        </p>
                        <p>
                            Di KBJT, kamu bisa berperan aktif dalam menjaga dan mengembangkan bahasa Jawa melalui
                            berbagai bentuk kontribusi, seperti:
                        </p>
                        <ul>
                            <li>Menambahkan kosakata baru lengkap dengan arti, notasi fonetik, kelas kata, hingga aksara
                                Jawa</li>
                            <li>Memperkaya arti dan makna kosakata lewat definisi, contoh penggunaan, serta catatan
                                dialek</li>
                            <li>Meninjau dan membantu menyempurnakan kontribusi dari pengguna lain</li>
                            <li>Mengumpulkan poin dan membuka berbagai pencapaian serta sertifikat sebagai bentuk
                                apresiasi</li>
                            <li>Ikut membangun kamus terbuka yang modern, terpercaya, dan bermanfaat untuk semua
                                generasi</li>
                        </ul>
                        <p>
                            Sebelum mulai berkontribusi, kami sangat menyarankan untuk membaca dokumentasi resmi KBJT.
                            Di sana, kamu akan menemukan panduan lengkap mulai dari cara menambahkan kosakata hingga
                            memahami sistem poin dan level. Kamu bisa membacanya di sini: <a
                                href="http://127.0.0.1:8000/cari?keyword=dokumentasi%3A&filter=artikel">Dokumentasi</a>.
                        </p>
                        <p>
                            Untuk mulai berkontribusi, kunjungi halaman daftar kosakata atau buka
                            halaman kosakata yang ingin kamu bantu. Setiap langkah kecilmu akan sangat berarti untuk
                            keberlangsungan bahasa Jawa di era digital ini.
                        </p>
                        <p style="margin-top: 25px">Salam budaya!</p>
                        <p>Tim kbjt</p>

                    </div>

                    {{-- footer --}}
                    <div style="color: #9a9ea6; text-align:center; margin-bottom: 30px;">
                        Kamus Bahasa Jawa Terbuka <br>
                        {{ $url }}
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
