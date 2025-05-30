<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'sekolah') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT * FROM pengaduan WHERE user_id = ? ORDER BY tanggal_lapor DESC");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaduan Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">
  <div class="w-full max-w-6xl bg-white p-8 rounded-2xl shadow-xl">
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-2xl font-bold text-emerald-600">Daftar Pengaduan Saya</h2>
      <a href="dashboard.php" class="text-sm text-blue-600 hover:underline">← Kembali ke Dashboard</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-200">
          <thead class="bg-emerald-100 text-gray-700 text-sm">
            <tr>
              <th class="px-4 py-3 border">Judul</th>
              <th class="px-4 py-3 border">Deskripsi</th>
              <th class="px-4 py-3 border">Status</th>
              <th class="px-4 py-3 border">Tanggal</th>
              <th class="px-4 py-3 border">Foto</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-700">
            <?php while($row = $result->fetch_assoc()): ?>
              <tr class="hover:bg-gray-50 align-top">
                <td class="px-4 py-3 border font-semibold"><?= htmlspecialchars($row["judul"]) ?></td>
                <td class="px-4 py-3 border whitespace-pre-line"><?= nl2br(htmlspecialchars($row["deskripsi"])) ?></td>
                <td class="px-4 py-3 border capitalize"><?= htmlspecialchars($row["status"]) ?></td>
                <td class="px-4 py-3 border"><?= htmlspecialchars($row["tanggal_lapor"]) ?></td>
                <td class="px-4 py-3 border">
                  <?php
                    $foto = htmlspecialchars($row["foto"]);
                    $path = "./gambar/$foto";
                    if (!empty($foto) && file_exists($path)):
                  ?>
                    <img src="<?= $path ?>" alt="Foto" class="w-24 h-24 object-cover rounded-md border" />
                  <?php else: ?>
                    <span class="text-gray-400 italic">Tidak ada</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-gray-600 mt-4">Belum ada pengaduan yang dikirim.</p>
    <?php endif; ?>
  </div>
</body>
</html>
