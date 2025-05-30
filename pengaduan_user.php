<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'dinas') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["user_id"])) {
    echo "User ID tidak ditemukan.";
    exit;
}

$user_id = intval($_GET["user_id"]);

// Ambil nama sekolah
$stmt = $conn->prepare("SELECT nama FROM users WHERE id = ? AND role = 'sekolah'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user = $stmt->get_result();
$sekolah = $result_user->fetch_assoc();

if (!$sekolah) {
    echo "Sekolah tidak ditemukan.";
    exit;
}

// Ambil pengaduan sekolah
$stmt_pengaduan = $conn->prepare("
    SELECT p.*, k.nama_kategori 
    FROM pengaduan p
    LEFT JOIN kategori_masalah k ON p.kategori_id = k.id
    WHERE p.user_id = ?
    ORDER BY p.tanggal_lapor DESC
");
$stmt_pengaduan->bind_param("i", $user_id);
$stmt_pengaduan->execute();
$result_pengaduan = $stmt_pengaduan->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 font-sans">
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-2xl font-bold text-emerald-700 mb-4">Pengaduan dari: <?= htmlspecialchars($sekolah['nama']) ?></h1>
        <a href="dashboard.php" class="text-sm text-emerald-600 hover:underline mb-6 inline-block">← Kembali ke dashboard</a>

        <?php if ($result_pengaduan->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $result_pengaduan->fetch_assoc()): ?>
                    <div class="bg-emerald-100 rounded-lg p-5 shadow hover:shadow-md transition">
                        <h2 class="text-xl font-semibold text-emerald-800 mb-2"><?= htmlspecialchars($row["judul"]) ?></h2>
                        <p class="text-sm text-gray-600 mb-2"><strong>Kategori:</strong> <?= htmlspecialchars($row["nama_kategori"] ?? 'Tidak ada') ?></p>
                        <p class="text-sm text-gray-700 mb-2"><?= nl2br(htmlspecialchars($row["deskripsi"])) ?></p>

                        <?php if (!empty($row["foto"])): ?>
                            <div class="mt-2">
                                <img src="gambar/<?= htmlspecialchars($row["foto"]) ?>" alt="Foto Pengaduan" class="rounded w-full max-h-60 object-cover mt-2">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 text-sm text-gray-600 flex justify-between">
                            <span><strong>Status:</strong> <span class="uppercase"><?= $row["status"] ?></span></span>
                            <span><strong>Tanggal:</strong> <?= date("d-m-Y", strtotime($row["tanggal_lapor"])) ?></span>

                            <a href="tanggapan.php?pengaduan_id=<?= $row['id'] ?>"
                     class="inline-block mt-4 text-sm text-white bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded shadow">
                     💬 Tanggapi Pengaduan
                           </a>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600">Belum ada pengaduan dari sekolah ini.</p>
        <?php endif; ?>
    </div>
</body>
</html>
