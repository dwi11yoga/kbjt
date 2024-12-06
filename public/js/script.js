// Toggle menu - untuk halaman kosakata
function dropdown(button, menu) {
    menu.classList.toggle("hidden");
    button.classList.toggle("outline");
    button.classList.toggle("outline-2");
    button.classList.toggle("outline-neutral-200");
    // Tutup menu jika klik di luar
    if (!menu.classList.contains("hidden")) {
        document.addEventListener("click", function handleClickOutside(event) {
            if (
                !menu.contains(event.target) &&
                !button.contains(event.target)
            ) {
                menu.classList.add("hidden");
                button.classList.remove(
                    "outline",
                    "outline-2",
                    "outline-neutral-200",
                );
                document.removeEventListener("click", handleClickOutside); // Hapus event listener
            }
        });
    }
}

// Ubah label serupa - untuk buat dan edit kosakata
function ubahSerupa(id) {
    const labelSerupa = document.getElementById("labelSerupa");
    if (id.value == "Krama") {
        labelSerupa.innerText = "Arti dalam bahasa ngoko";
    } else if (id.value == "Ngoko") {
        labelSerupa.innerText = "Arti dalam bahasa krama";
    }
}

// Deskripsi jenis kosakata - untuk buat dan edit kosakata
function deskripsiJenis(item) {
    const jenis_deskripsi = document.getElementById("jenis_deskripsi");
    if (item.value == "Nomina") {
        jenis_deskripsi.innerText =
            "*Nomina: Kata yang menyatakan nama orang, tempat, benda, atau konsep abstrak (Contoh: wong, bumi, asep).";
    } else if (item.value == "Verba") {
        jenis_deskripsi.innerText =
            "*Verba: Kata yang menyatakan tindakan, perbuatan, atau proses (Contoh: mangan, mlaku, turu).";
    } else if (item.value == "Adjektiva") {
        jenis_deskripsi.innerText =
            "*Adjektiva: Kata yang menjelaskan sifat atau keadaan suatu benda (Contoh: gedhe, apik, cendhek).";
    } else if (item.value == "Adverbia") {
        jenis_deskripsi.innerText =
            "Adverbia: Kata yang memberikan informasi tambahan tentang verba, adjektiva, atau adverbia lainnya (Contoh: saiki, enggal, bagean.).";
    } else if (item.value == "Pronomina") {
        jenis_deskripsi.innerText =
            "*Pronomina: Kata yang menggantikan nomina (Contoh: aku, kowe, panjenengan).";
    } else if (item.value == "Numeralia") {
        jenis_deskripsi.innerText =
            "*Numeralia: Kata yang menyatakan jumlah atau urutan (Contoh: siji, pitu, sepuluh).";
    } else if (item.value == "Konjungsi") {
        jenis_deskripsi.innerText =
            "*Konjungsi: Kata yang menghubungkan klausa, kalimat, atau frasa (Contoh: lan, nanging, supaya).";
    } else if (item.value == "Interjeksi") {
        jenis_deskripsi.innerText =
            "*Interjeksi: Kata yang digunakan untuk mengungkapkan perasaan atau emosi (Contoh: aduh, nah, loh).";
    } else if (item.value == "Preposisi") {
        jenis_deskripsi.innerText =
            "*Preposisi: Kata yang menunjukkan hubungan antara nomina atau pronomina dengan kata lain (Contoh: ing, kanthi, marang).";
    } else if (item.value == "Partikel") {
        jenis_deskripsi.innerText =
            "*Partikel: Kata tugas yang memberikan nuansa tertentu pada kalimat (Contoh: to, kok, lha.";
    } else if (item.value == "Onomatope") {
        jenis_deskripsi.innerText =
            "*Onomatope: Kata atau kumpulan kata yang meniru bunyi atau suara dari benda, binatang, atau manusia yang bukan kata (Contoh: bruk, meong, tok tok tok).";
    } else if (item.value == "Paribasan") {
        jenis_deskripsi.innerText =
            "*Paribasan: Ungkapan atau peribahasa yang sifatnya tetap, sering digunakan untuk menggambarkan situasi umum dengan cara figuratif atau metaforis (Contoh: Kaya asu digebug gelung).";
    } else if (item.value == "Saloka") {
        jenis_deskripsi.innerText =
            "*Saloka: Ungkapan tetap yang lebih simbolis dan kerap digunakan untuk menyindir atau menggambarkan karakter seseorang (Contoh: Mburu uceng kelangan deleg).";
    } else if (item.value == "Sanepa") {
        jenis_deskripsi.innerText =
            "*Sanepa: Bahasa kiasan yang digunakan untuk menyampaikan suatu maksud dengan cara tersirat (Contoh:  Kaya wedhus ilang wedhuse).";
    } else if (item.value == "Sesanti") {
        jenis_deskripsi.innerText =
            "*Sesanti: Ungkapan berupa semboyan atau motto yang berisi nilai-nilai luhur, petuah, atau filosofi hidup (Contoh: Urip iku urup).";
    } else if (item.value == "") {
        jenis_deskripsi.innerText = "";
    }
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
