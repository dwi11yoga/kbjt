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
                    </div>

                    {{-- Isi/body email --}}
                    <div class="box"
                        style="background-color: white; border: 1px solid #eaebed; border-radius: 16px; padding: 10px 20px 10px 20px; box-sizing: border-box; margin-top: 20px; margin-bottom: 20px;">

                        <p>{{ $user->nama }},</p>
                        <p>
                            Kami ingin memberitahu bahwa alamat email yang terdaftar pada akun Kamus Bahasa Jawa Terbuka
                            kamu telah diperbarui menjadi {{ $emailBaru }} pada {{ $tanggal }} pukul
                            {{ $waktu }}.
                        </p>
                        <p>
                            Jika memang kamu yang melakukan perubahan ini, maka tidak perlu melakukan tindakan apa pun
                            dan abaikan pesan ini. Namun, jika kamu merasa tidak melakukan perubahan apapun, segera
                            hubungi tim pengelola kami melalui email atau media sosial.
                        </p>
                        <p>
                            Demi keamanan akun kamu, kami juga menyarankan untuk segera memverifikasi atau mengubah kata
                            sandimu jika merasa akun telah diakses oleh orang lain.
                        </p>
                        <p>
                            Terima kasih telah menjadi bagian dari Kamus Bahasa Jawa Terbuka!
                        </p>
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
