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

                        <p>{{ $user['nama'] }},</p>
                        <p>
                            Kami ingin menginformasikan bahwa kata sandi akun Kamus Bahasa Jawa Terbuka milikmu telah
                            berhasil diperbarui pada {{ $tanggal }} pukul {{ $waktu }}.
                        </p>
                        <p>
                            Jika kamu memang melakukan penggantian ini, maka tidak ada tindakan lebih lanjut yang perlu
                            dilakukan.
                        </p>
                        <p>
                            Namun, jika kamu tidak merasa telah mereset kata sandi akunmu, kemungkinan akunmu telah
                            diakses oleh pihak lain. Kami sarankan segera mengamankan akunmu dengan:
                        </p>
                        <ul>
                            <li>Mengubah kata sandi secepat mungkin,</li>
                            <li>Menghubungi tim kami melalui email atau media sosial untuk bantuan lebih lanjut.</li>
                        </ul>
                        <p style="margin-top: 25px">
                            Keamanan data pribadi pengguna adalah prioritas utama KBJT, dan kami berkomitmen untuk
                            menjaga akunmu
                            tetap aman.
                        </p>
                        <p>
                            Salam hangat,<br>
                            Tim kbjt
                        </p>

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
