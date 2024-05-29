<?php
// Memulai sesi
session_start();

// Definisi kelas AntrianKlinik
class AntrianKlinik {
    private $nomor_antrian;

    public function __construct() {
        if (!isset($_SESSION['nomor_antrian'])) {
            $_SESSION['nomor_antrian'] = 0; // Inisialisasi nomor antrian
        }
        $this->nomor_antrian = $_SESSION['nomor_antrian'];
    }

    public function ambilNomorAntrian() {
        $this->nomor_antrian++;
        $_SESSION['nomor_antrian'] = $this->nomor_antrian;
        return $this->nomor_antrian;
    }

    public function resetNomorAntrian() {
        $this->nomor_antrian = 0;
        $_SESSION['nomor_antrian'] = $this->nomor_antrian;
    }
}

// Membuat objek AntrianKlinik jika belum ada
if (!isset($_SESSION['antrian_klinik'])) {
    $_SESSION['antrian_klinik'] = new AntrianKlinik();
}

$antrianKlinik = $_SESSION['antrian_klinik'];

// Reset nomor antrian setiap hari sekali
if (!isset($_SESSION['last_reset']) || date('Y-m-d') != $_SESSION['last_reset']) {
    $antrianKlinik->resetNomorAntrian();
    $_SESSION['last_reset'] = date('Y-m-d'); // Simpan tanggal hari ini sebagai waktu terakhir reset
}

// Proses pendaftaran pasien atau operasi lainnya yang melibatkan objek AntrianKlinik
if (isset($_POST['daftar'])) {
    // Simpan data pendaftaran ke dalam session
    $_SESSION['pendaftaran'] = $_POST;

    // Ambil nomor antrian dan tambahkan ke data pendaftaran
    $_SESSION['pendaftaran']['nomor_antrian'] = $antrianKlinik->ambilNomorAntrian();

    // Alihkan ke confirm.php
    header("Location: confirm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien Klinik</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Pendaftaran Pasien Klinik</h2>
        <form method="post" action="">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Cerai">Cerai</option>
            </select>

            <label for="golongan_darah">Golongan Darah:</label>
            <select id="golongan_darah" name="golongan_darah" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>

            <label for="pendidikan_terakhir">Pendidikan Terakhir:</label>
            <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" required>

            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" id="pekerjaan" name="pekerjaan" required>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" required>

            <label for="nomor_identitas">Nomor Identitas:</label>
            <input type="text" id="nomor_identitas" name="nomor_identitas" required>

            <label for="jenis_identitas">Jenis Identitas:</label>
            <select id="jenis_identitas" name="jenis_identitas" required>
                <option value="KK">KK</option>
                <option value="KTP">KTP</option>
                <option value="SIM">SIM</option>
            </select>

            <label for="alamat">Alamat Lengkap:</label>
            <textarea id="alamat" name="alamat" required></textarea>

            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="Umum">Umum</option>
                <option value="Asuransi">Asuransi</option>
                <option value="BPJS">BPJS</option>
            </select>

            <button type="submit" name="daftar">Daftar</button>
        </form>
    </div>
</body>
</html>
