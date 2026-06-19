<?php
// 1. AMBIL BAHASA UTAMA BROWSER PENGGUNA
$browser_lang = 'en'; // Default jika tidak terdeteksi

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    // Mengambil 2 huruf pertama dari bahasa browser (misal: 'id', 'en', 'ms')
    $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $browser_lang = strtolower($browser_lang);
}

// 2. JIKA BUKAN BAHASA INDONESIA (id) -> TAMPILKAN WHITE PAGE (LINK A)
// Bot atau moderator luar negeri otomatis masuk ke sini
if ($browser_lang !== 'id') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Situs Informasi Edukasi</title>
    </head>
    <body>
        <h1>Selamat Datang di Portal Artikel Kami</h1>
        <p>Ini adalah halaman informasi umum yang aman dan mematuhi seluruh kebijakan layanan.</p>
    </body>
    </html>
    <?php
    exit();
} 

// 3. JIKA BAHASA INDONESIA (id) -> AMBIL KONTEN LINK B (MONEY PAGE) DI LATAR BELAKANG
else {
    $link_b = "https://link-b-anda.com"; // Ganti dengan URL penawaran Anda

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link_b);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // Teruskan user-agent asli pengguna
    
    // Ambil konten HTML dari Link B
    $output = curl_exec($ch);
    curl_close($ch);

    // Tampilkan konten Link B di URL Link A tanpa mengubah URL browser
    echo $output;
    exit();
}
?>
