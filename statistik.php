<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'dinas') {
    header("Location: login.php");
    exit;
}

// Total pengaduan
$total = $conn->query("SELECT COUNT(*) AS total FROM pengaduan")->fetch_assoc()['total'];

// Statistik status
$status = [
    'baru' => 0,
    'diproses' => 0,
    'selesai' => 0
];

$result = $conn->query("SELECT status, COUNT(*) AS jumlah FROM pengaduan GROUP BY status");
while ($row = $result->fetch_assoc()) {
    $status[$row['status']] = $row['jumlah'];
}

// Jumlah sekolah yang melapor
$sekolah_lapor = $conn->query("SELECT COUNT(DISTINCT user_id) AS total FROM pengaduan")->fetch_assoc()['total'];

// Statistik kategori
$kategori_data = [];
$res_kat = $conn->query("
    SELECT k.nama_kategori, COUNT(p.id) AS jumlah 
    FROM kategori_masalah k
    LEFT JOIN pengaduan p ON p.kategori_id = k.id
    GROUP BY k.id
");
while ($row = $res_kat->fetch_assoc()) {
    $kategori_data[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 font-sans min-h-screen py-10">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-emerald-700 mb-4">📊 Statistik Pengaduan</h1>
        <a href="dashboard.php" class="text-sm text-emerald-600 hover:underline mb-6 inline-block">← Kembali ke Dashboard</a>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-4 mb-8">
            <div class="bg-emerald-100 p-5 rounded shadow">
                <h2 class="text-lg font-semibold text-emerald-800">Total Pengaduan</h2>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?= $total ?></p>
            </div>
            <div class="bg-yellow-100 p-5 rounded shadow">
                <h2 class="text-lg font-semibold text-yellow-800">Status: Baru</h2>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?= $status['baru'] ?></p>
            </div>
            <div class="bg-blue-100 p-5 rounded shadow">
                <h2 class="text-lg font-semibold text-blue-800">Diproses</h2>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?= $status['diproses'] ?></p>
            </div>
            <div class="bg-green-100 p-5 rounded shadow">
                <h2 class="text-lg font-semibold text-green-800">Selesai</h2>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?= $status['selesai'] ?></p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-emerald-700 mb-4">Jumlah Sekolah yang Melapor</h2>
            <div class="bg-emerald-100 p-4 rounded shadow text-lg text-gray-800">
                <?= $sekolah_lapor ?> sekolah
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold text-emerald-700 mb-4">Pengaduan per Kategori</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php foreach ($kategori_data as $kat): ?>
                    <div class="bg-white border border-emerald-200 p-4 rounded shadow">
                        <h3 class="font-semibold text-emerald-800"><?= htmlspecialchars($kat['nama_kategori']) ?></h3>
                        <p class="text-xl font-bold text-gray-700"><?= $kat['jumlah'] ?> laporan</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
