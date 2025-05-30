<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'sekolah') {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';

// Ambil kategori
$kategori = [];
$result = $conn->query("SELECT id, nama_kategori FROM kategori_masalah");
while ($row = $result->fetch_assoc()) {
    $kategori[] = $row;
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST["judul"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $kategori_id = $_POST["kategori_id"];
    $foto_name = null;

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = $_FILES["foto"]["type"];
        $file_tmp = $_FILES["foto"]["tmp_name"];

        if (in_array($file_type, $allowed_types)) {
            $foto_name = 'foto_' . time() . '_' . basename($_FILES["foto"]["name"]);
            move_uploaded_file($file_tmp, "gambar/" . $foto_name);
        } else {
            $error = "Tipe file tidak diperbolehkan. Hanya JPG dan PNG.";
        }
    }

    if (empty($judul) || empty($deskripsi) || empty($kategori_id)) {
        $error = "Semua field wajib diisi.";
    }

    if (!$error) {
        $stmt = $conn->prepare("INSERT INTO pengaduan (user_id, kategori_id, judul, deskripsi, foto, status, tanggal_lapor) VALUES (?, ?, ?, ?, ?, 'baru', NOW())");
        $stmt->bind_param("iisss", $user_id, $kategori_id, $judul, $deskripsi, $foto_name);

        if ($stmt->execute()) {
            $success = "Pengaduan berhasil dikirim.";
        } else {
            $error = "Gagal menyimpan pengaduan: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-emerald-600 mb-6 text-center">Form Pengaduan Sekolah</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm text-center"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-5">
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Judul</label>
                <input type="text" name="judul" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Kategori Masalah</label>
                <select name="kategori_id" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Deskripsi Masalah</label>
                <textarea name="deskripsi" rows="5" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-300"></textarea>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Upload Foto (Opsional, JPG/PNG)</label>
                <input type="file" name="foto" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0
                    file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-emerald-700 transition">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
