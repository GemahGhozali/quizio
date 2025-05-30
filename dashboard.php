<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION["nama"];
$role = $_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Peduli Pendidikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 font-sans">
    <div class="w-full max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-2xl font-bold text-emerald-700 mb-2">SEKOLAH <?= htmlspecialchars($nama) ?></h1>
        <br>
       

        <?php if ($role === 'sekolah'): ?>
            <div class="flex gap-4 mb-6 max-sm:flex-col">
                <a href="buat_pengaduan.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded shadow">📝 Buat Pengaduan Baru</a>
                <a href="pengaduan_saya.php" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2 rounded shadow">📄 Lihat Pengaduan Saya</a>
            </div>
        <?php elseif ($role === 'dinas'): ?>
            <div class="mb-6">
                <a href="statistik.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded shadow">📊 Lihat Statistik</a>
            </div>

            <h2 class="text-xl font-semibold text-emerald-700 mb-4">Daftar Sekolah</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                $sql = "SELECT id, nama FROM users WHERE role = 'sekolah'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()):
                ?>
                    <a href="pengaduan_user.php?user_id=<?= $row['id'] ?>" class="block p-4 bg-emerald-100 hover:bg-emerald-200 rounded-lg shadow text-center transition">
                        <p class="text-lg font-semibold text-emerald-800"><?= htmlspecialchars($row['nama']) ?></p>
                    </a>
                <?php endwhile;
                } else {
                    echo '<p class="text-gray-500">Belum ada sekolah terdaftar.</p>';
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="mt-10">
            <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">Logout</a>
        </div>
    </div>
</body>
</html>
