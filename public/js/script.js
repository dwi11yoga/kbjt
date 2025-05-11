// Muat Dropdown / Select
// memuat halaman ketika item dropdown dipilih
function muatDropdown(dropdown) {
    dropdown.form.submit();
}

// TAMPILKAN GAMBAR YANG DIUPLOAD
function previewImage(input, preview) {
    const pp_preview = document.getElementById(preview);
    const oFReader = new FileReader();

    oFReader.readAsDataURL(input.files[0]);

    oFReader.onload = function (oFREvent) {
        pp_preview.src = oFREvent.target.result;
    };
}

// TAMPILKAN DIREKTORI GAMBAR YANG DIUPLOAD
function previewImageDir(input, preview) {
    document.getElementById(preview).innerText = input.files[0].name;
}

// Toggle menu - untuk halaman kosakata
function dropdown(button, menu) {
    var menu = document.getElementById(menu);

    menu.classList.toggle("hidden");
    // Tutup menu jika klik di luar
    if (!menu.classList.contains("hidden")) {
        document.addEventListener("click", function handleClickOutside(event) {
            if (
                !menu.contains(event.target) &&
                !button.contains(event.target)
            ) {
                menu.classList.add("hidden");
                document.removeEventListener("click", handleClickOutside); // Hapus event listener
            }
        });
    }
}

// Ubah label serupa - untuk buat dan edit kosakata
function ubahSerupa(id) {
    const labelSerupa = document.getElementById("labelSerupa");
    const serupa = document.getElementById("serupa");
    if (id.value == "") {
        labelSerupa.classList.add("hidden");
        serupa.classList.add("hidden");
    } else if (id.value == "Krama") {
        labelSerupa.classList.remove("hidden");
        serupa.classList.remove("hidden");
        labelSerupa.innerText = "Arti dalam bahasa ngoko";
    } else if (id.value == "Ngoko") {
        labelSerupa.classList.remove("hidden");
        serupa.classList.remove("hidden");
        labelSerupa.innerText = "Arti dalam bahasa krama";
    }
}

// Deskripsi jenis kosakata - untuk buat dan edit kosakata
function deskripsiJenis(item) {
    const jenis_deskripsi = document.getElementById("jenis_deskripsi");
    if (item.value == "Tembung aran") {
        jenis_deskripsi.innerText =
            "*Tembung aran: kata yang menjelaskan nama barang, baik kongkrit maupun abstrak (Cnth. meja, roti).";
    } else if (item.value == "Tembung kriya") {
        jenis_deskripsi.innerText =
            "*Tembung kriya: kata yang menjelaskan atau bermakna perbuatan & pekerjaan (Cnth. mangan, mlaku, turu).";
    } else if (item.value == "Tembung katrangan") {
        jenis_deskripsi.innerText =
            "*Tembung katrangan: Kata yang menerangkan predikat atau kata lainnya (Cnth. wingi, durung).";
    } else if (item.value == "Tembung kaanan") {
        jenis_deskripsi.innerText =
            "*Tembungkaanan: Kata yang menerangkan keadaan suatu benda/lainnya (Cnth. ayu, ijo, jero).";
    } else if (item.value == "Tembung sesulih") {
        jenis_deskripsi.innerText =
            "*Tembung sesulih: Kata yang menggantikan kedudukan orang, barang, tempat, waktu, lainnya (Cnth. aku, kowe, panjenengan).";
    } else if (item.value == "Tembung wilangan") {
        jenis_deskripsi.innerText =
            "*Tembung wilangan: Kata yang menjelaskan bilangan (Cnth. siji, pitu, sepuluh).";
    } else if (item.value == "Tembung panggandheng") {
        jenis_deskripsi.innerText =
            "*Tembung panggandheng: Kata yang menghubungkan kata dengan kata (Cnth. lan, nanging, supaya).";
    } else if (item.value == "Tembung ancer-ancer") {
        jenis_deskripsi.innerText =
            "*Tembung ancer-ancer: kata yang mengawali kata lain, bermakna memberikan suatu tanda terhadap asal-usul, tempat, kausalitas (Cnth. ing, saka).";
    } else if (item.value == "Tembung panyilah") {
        jenis_deskripsi.innerText =
            "*Tembung panyilah: Kata yang menerangkan status dan sebutan orang/binatang/lainnya (Cnth. sang, si, Hyang).";
    } else if (item.value == "Tembung panguwuh") {
        jenis_deskripsi.innerText =
            "*Tembung panguwuh: Kata yang bermakna seruan, ungkapan verbal bersifat emotif (Cnth. lho, adhuh, hore).";
    } else if (item.value == "Paribasan") {
        jenis_deskripsi.innerText =
            "*Paribasan: Ungkapan tetap (idiom) yang maknanya tidak bisa diartikan secara harfiah (Cnth. Jer basuki mawa béya: Segala keberhasilan butuh pengorbanan).";
    } else if (item.value == "Bebasan") {
        jenis_deskripsi.innerText =
            "*Bebasan: Ungkapan yang bisa diganti-ganti unsurnya, tapi maknanya masih bisa ditangkap (Cnth. Atine kaya watu: tidak mudah iba).";
    } else if (item.value == "Saloka") {
        jenis_deskripsi.innerText =
            "*Saloka: Ungkapan perbandingan yang sangat halus dan penuh sindiran (Cnth. Wong ngapusi kaya lintah darat: Orang pembohong diibaratkan lintah darat).";
    } else if (item.value == "Pacelathon") {
        jenis_deskripsi.innerText =
            "*Pacelathon: Percakapan atau dialog, digunakan dalam konteks bercakap-cakap, bisa formal atau informal.";
    } else if (item.value == "Candra Sangkala") {
        jenis_deskripsi.innerText =
            "*Candra Sangkala: Sistem penanggalan atau perhitungan tahun dalam bentuk kata atau kalimat simbolik (Cnth. Sirna Ilang Kertaning Bumi: Tahun 1400 Saka (1478 M)).";
    } else if (item.value == "Wangsalan") {
        jenis_deskripsi.innerText =
            "*Wangsalan: Ungkapan berupa teka-teki berima yang mengandung makna tersembunyi, seperti pantun (Cnth. Bantalé abang, isiné putih: telur).";
    } else {
        jenis_deskripsi.innerText = "";
    }

    // backup
    // if (item.value == "Nomina") {
    //     jenis_deskripsi.innerText =
    //         "*Nomina: Kata yang menyatakan nama orang, tempat, benda, atau konsep abstrak (Contoh: wong, bumi, asep).";
    // } else if (item.value == "Verba") {
    //     jenis_deskripsi.innerText =
    //         "*Verba: Kata yang menyatakan tindakan, perbuatan, atau proses (Contoh: mangan, mlaku, turu).";
    // } else if (item.value == "Adjektiva") {
    //     jenis_deskripsi.innerText =
    //         "*Adjektiva: Kata yang menjelaskan sifat atau keadaan suatu benda (Contoh: gedhe, apik, cendhek).";
    // } else if (item.value == "Adverbia") {
    //     jenis_deskripsi.innerText =
    //         "Adverbia: Kata yang memberikan informasi tambahan tentang verba, adjektiva, atau adverbia lainnya (Contoh: saiki, enggal, bagean.).";
    // } else if (item.value == "Pronomina") {
    //     jenis_deskripsi.innerText =
    //         "*Pronomina: Kata yang menggantikan nomina (Contoh: aku, kowe, panjenengan).";
    // } else if (item.value == "Numeralia") {
    //     jenis_deskripsi.innerText =
    //         "*Numeralia: Kata yang menyatakan jumlah atau urutan (Contoh: siji, pitu, sepuluh).";
    // } else if (item.value == "Konjungsi") {
    //     jenis_deskripsi.innerText =
    //         "*Konjungsi: Kata yang menghubungkan klausa, kalimat, atau frasa (Contoh: lan, nanging, supaya).";
    // } else if (item.value == "Interjeksi") {
    //     jenis_deskripsi.innerText =
    //         "*Interjeksi: Kata yang digunakan untuk mengungkapkan perasaan atau emosi (Contoh: aduh, nah, loh).";
    // } else if (item.value == "Preposisi") {
    //     jenis_deskripsi.innerText =
    //         "*Preposisi: Kata yang menunjukkan hubungan antara nomina atau pronomina dengan kata lain (Contoh: ing, kanthi, marang).";
    // } else if (item.value == "Partikel") {
    //     jenis_deskripsi.innerText =
    //         "*Partikel: Kata tugas yang memberikan nuansa tertentu pada kalimat (Contoh: to, kok, lha.";
    // } else if (item.value == "Onomatope") {
    //     jenis_deskripsi.innerText =
    //         "*Onomatope: Kata atau kumpulan kata yang meniru bunyi atau suara dari benda, binatang, atau manusia yang bukan kata (Contoh: bruk, meong, tok tok tok).";
    // } else if (item.value == "Paribasan") {
    //     jenis_deskripsi.innerText =
    //         "*Paribasan: Ungkapan atau peribahasa yang sifatnya tetap, sering digunakan untuk menggambarkan situasi umum dengan cara figuratif atau metaforis (Contoh: Kaya asu digebug gelung).";
    // } else if (item.value == "Saloka") {
    //     jenis_deskripsi.innerText =
    //         "*Saloka: Ungkapan tetap yang lebih simbolis dan kerap digunakan untuk menyindir atau menggambarkan karakter seseorang (Contoh: Mburu uceng kelangan deleg).";
    // } else if (item.value == "Sanepa") {
    //     jenis_deskripsi.innerText =
    //         "*Sanepa: Bahasa kiasan yang digunakan untuk menyampaikan suatu maksud dengan cara tersirat (Contoh:  Kaya wedhus ilang wedhuse).";
    // } else if (item.value == "Sesanti") {
    //     jenis_deskripsi.innerText =
    //         "*Sesanti: Ungkapan berupa semboyan atau motto yang berisi nilai-nilai luhur, petuah, atau filosofi hidup (Contoh: Urip iku urup).";
    // } else if (item.value == "") {
    //     jenis_deskripsi.innerText = "";
    // }
}

// salin text
function copyUrl(target, iconBefore, iconAfter) {
    navigator.clipboard.writeText(
        target.innerText || target.textContent || target.value,
    );
    iconBefore.classList.remove("inline-block");
    iconBefore.classList.add("hidden");
    iconAfter.classList.remove("hidden");
    iconAfter.classList.add("inline-block");
}

// Modal toggle
function modal(modal) {
    modal.classList.toggle("hidden");
}

// Accordion
function accordion(jmlAccordion, header, title, content, showBtn, hideBtn) {
    // cek apakah didalam konten yang diklik adalah accordion yang ditampilkan/tidak
    const containHidden = content.classList.contains("hidden") ? true : false;

    // sembunyikan semua accordion
    for (let i = 1; i <= jmlAccordion; i++) {
        document
            .getElementById(`accordion-title-${i}`)
            .classList.remove("bg-amber-100");
        document
            .getElementById(`accordion-title-${i}`)
            .classList.add("bg-white", "text-neutral-600");
        document
            .getElementById(`accordion-show-${i}`)
            .classList.remove("hidden");
        document.getElementById(`accordion-hide-${i}`).classList.add("hidden");
        document
            .getElementById(`accordion-header-${i}`)
            .classList.remove("text-amber-700");
        document
            .getElementById(`accordion-header-${i}`)
            .classList.add("text-neutral-600");
        document
            .getElementById(`accordion-content-${i}`)
            .classList.add("hidden");
    }

    // tampilkan accordion yang diklik
    if (containHidden == true) {
        content.classList.remove("hidden");
        title.classList.remove("bg-white", "text-neutral-600");
        title.classList.add("bg-amber-100");
        showBtn.classList.add("hidden");
        hideBtn.classList.remove("hidden");
        header.classList.remove("text-neutral-600");
        header.classList.add("text-amber-700");
    }
}

// buat panjang textarea otomatis
function textareaHeight(id) {
    id.style.height = "auto";
    id.style.height = `${id.scrollHeight}px`;
}

// Buka popup
function openWindow(component) {
    var component = document.getElementById(component);
    component.classList.remove("invisible");
}

// tutup popup
function closeWindow(component) {
    var component = document.getElementById(component);
    component.classList.add("invisible");
}

// Buat slug
function buatSlug(inputFrom, inputTarget) {
    var target = document.getElementById(inputTarget);
    var slug = inputFrom.value
        .toLowerCase() //convert ke huruf kecil
        .trim() //hialngkan spasi di awal dan akhir
        .replace(/[\s\W-]+/g, "-") //ganti karakter khusus dan spasi dengan '-'
        .replace(/^-+|-+$/g, ""); // Hilangkan '-' di awal/akhir
    target.value = slug;
}

// INPUT

// ubah tampilan validasi input
// saat input error kan akan berwarna merah. kode ini kanggo ngubah warna dadi normal nik misal user input data
// itemIds=array, dadi butuh array
function removeErrorIndicators(itemIds) {
    itemIds.forEach((element) => {
        var item = document.getElementById(element);
        item.addEventListener("input", () => {
            item.classList.remove("border-red-600", "text-red-600");
            item.classList.add("focus:border-amber-400");
        });
    });
}
