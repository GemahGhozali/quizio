<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'dinas') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["pengaduan_id"])) {
    echo "ID pengaduan tidak ditemukan.";
    exit;
}

$pengaduan_id = intval($_GET["pengaduan_id"]);

// Ambil data pengaduan
$stmt = $conn->prepare("
    SELECT p.*, u.nama as nama_user, k.nama_kategori 
    FROM pengaduan p 
    JOIN users u ON p.user_id = u.id 
    LEFT JOIN kategori_masalah k ON p.kategori_id = k.id 
    WHERE p.id = ?
");
$stmt->bind_param("i", $pengaduan_id);
$stmt->execute();
$result = $stmt->get_result();
$pengaduan = $result->fetch_assoc();

if (!$pengaduan) {
    echo "Pengaduan tidak ditemukan.";
    exit;
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isi = trim($_POST["isi"]);

    if ($isi === "") {
        $error = "Isi tanggapan tidak boleh kosong.";
    } else {
        $stmt = $conn->prepare("INSERT INTO tanggapan (pengaduan_id, isi) VALUES (?, ?)");
        $stmt->bind_param("is", $pengaduan_id, $isi);
        if ($stmt->execute()) {
            $success = "Tanggapan berhasil dikirim.";
        } else {
            $error = "Gagal menyimpan tanggapan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tanggapi Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 font-sans">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-emerald-700 mb-4">Tanggapi Pengaduan</h1>

    <div class="mb-6 p-4 bg-emerald-100 rounded shadow">
        <h2 class="text-xl font-semibold text-emerald-800"><?= htmlspecialchars($pengaduan['judul']) ?></h2>
        <p class="text-gray-700 mt-1"><strong>Kategori:</strong> <?= htmlspecialchars($pengaduan['nama_kategori'] ?? '-') ?></p>
        <p class="text-gray-700 mt-1"><strong>Sekolah:</strong> <?= htmlspecialchars($pengaduan['nama_user']) ?></p>
        <p class="text-gray-700 mt-2"><?= nl2br(htmlspecialchars($pengaduan['deskripsi'])) ?></p>
        <?php if (!empty($pengaduan["foto"])): ?>
            <div class="mt-3">
                <img src="gambar/<?= htmlspecialchars($pengaduan["foto"]) ?>" alt="Foto" class="rounded max-h-64">
            </div>
        <?php endif; ?>
        <p class="text-gray-600 mt-2 text-sm"><strong>Status:</strong> <?= $pengaduan['status'] ?> | 
           <strong>Tanggal:</strong> <?= date("d-m-Y", strtotime($pengaduan["tanggal_lapor"])) ?></p>
    </div>

    <?php if ($error): ?>
        <p class="text-red-600 mb-2"><?= $error ?></p>
    <?php elseif ($success): ?>
        <p class="text-green-600 mb-2"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <label class="block">
            <span class="text-gray-700 font-semibold">Isi Tanggapan:</span>
            <textarea name="isi" rows="5" class="w-full border border-gray-300 rounded p-2 mt-1" required></textarea>
        </label>
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Kirim Tanggapan</button>
        <a href="dashboard.php" class="ml-4 text-sm text-emerald-600 hover:underline">← Kembali</a>
    </form>
</div>
</body>
</html>
