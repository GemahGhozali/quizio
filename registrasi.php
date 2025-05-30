<?php
include 'db.php';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $sql = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama, $email, $password, $role);

    if ($stmt->execute()) {
        $success = "Registrasi berhasil! Silakan login.";
    } else {
        $error = "Email sudah terdaftar atau terjadi kesalahan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-center text-emerald-700 mb-6">Registrasi Pengguna</h2>

        <?php if ($error): ?>
            <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded text-sm"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded text-sm"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium">Nama Sekolah</label>
                <input type="text" name="nama" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Role</label>
                <select name="role" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    <option value="">-- Pilih Role --</option>
                    <option value="sekolah">Sekolah</option>
                    <option value="dinas">Dinas Pendidikan</option>
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-emerald-600 text-white py-2 rounded font-semibold hover:bg-emerald-700 transition">
                Daftar
            </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            Sudah punya akun? <a href="login.php" class="text-emerald-600 hover:underline">Login di sini</a>
        </p>
    </div>
</body>
</html>
