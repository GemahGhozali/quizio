<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nama"] = $user["nama"];
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Aplikasi Pendidikan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-screen h-screen bg-gray-100">
  <div class="flex flex-col-reverse md:flex-row w-full h-full">
    
    <!-- Kolom Kiri (di bawah saat mobile): Logo dan Info -->
    <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center p-10">
      <img src="gambar/SIAP_LOGO.png" alt="Logo" class="mb-4 w-[300px] object-contain" />
      <p class="text-gray-600 text-center text-sm md:text-base">Selamat datang! Silakan login untuk mengakses platform pendidikan.</p>
      <p class="text-gray-600 text-sm mt-6">
        Belum punya akun?
        <a href="registrasi.php" class="text-emerald-600 hover:underline font-medium">Daftar di sini</a>
      </p>
    </div>

    <!-- Kolom Kanan (di atas saat mobile): Form Login -->
    <div class="w-full md:w-1/2 bg-emerald-500 flex flex-col justify-center items-center p-10 text-white">
      <div class="w-full max-w-sm">
        <h3 class="text-2xl font-semibold mb-6 text-center">Login ke Akun Anda</h3>

        <?php if ($error): ?>
          <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input type="email" id="email" name="email" required
              class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-300"
              placeholder="Masukkan email" />
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm mb-1">Password</label>
            <input type="password" id="password" name="password" required
              class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-300"
              placeholder="Masukkan password" />
          </div>

          <!-- Tombol Login -->
          <div>
            <button type="submit"
              class="w-full bg-white text-emerald-600 font-semibold py-2 px-4 rounded-lg hover:bg-emerald-100 transition">
              
              Login
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</body>
</html>
