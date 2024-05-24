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

// Ambil data pendaftaran dari session
$data_pendaftaran = isset($_SESSION['pendaftaran']) ? $_SESSION['pendaftaran'] : null;

// Jika pengguna mengonfirmasi pendaftaran
if (isset($_POST['konfirmasi'])) {
    // Ambil nomor antrean dari AntrianKlinik
    $nomor_antrian = $antrianKlinik->ambilNomorAntrian();
    
    // Hapus data pendaftaran dari session
    unset($_SESSION['pendaftaran']);

    // Tampilkan kotak konfirmasi nomor antrean
    echo "<title>KLINIK TONGFENG</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f0f0f0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .confirmation-box {
                    max-width: 400px;
                    padding: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                    animation: fadeIn 1s ease-in-out;
                }
                .confirmation-box h2 {
                    margin-top: 10;
                    color: #007BFF;
                    font-size: 36px;
                    margin-bottom: 0px;
                    border-bottom: 2px solid #007BFF;
                    padding-bottom: 10px;
                }
                .confirmation-box p {
                    font-size: 18px;
                    margin-bottom: 10px;
                    color: #555;
                }
                .confirmation-box .nomor-antrian {
                    font-size: 120px;
                    font-weight: bold;
                    color: #007BFF;
                    margin-bottom:20px;
                    margin-top:0px;
                }
                .confirmation-box .terima-kasih {
                    font-style: italic;
                    color: #777;
                    margin-bottom: 20px;
                }
                .cetak-button {
                    background-color: #007BFF;
                    color: white;
                    padding: 12px 24px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 18px;
                    transition: background-color 0.3s, transform 0.3s;
                    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
                }
                .cetak-button:hover {
                    background-color: #0056b3;
                    transform: translateY(-3px);
                }
                .cetak-button:active {
                    background-color: #004494;
                    transform: translateY(0);
                }
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: scale(0.9);
                    }
                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }
            </style>
            <div class='confirmation-box'>
            <h2>KLINIK TONG FANG</h2>
            <p>NO. ANTREAN</p>
            <p class='nomor-antrian'>$nomor_antrian</p>
            <p>TERIMA KASIH TELAH MENUNGGU</p>
            <button type='button' class='cetak-button' onclick='window.print()'>Cetak</button>
          </div>";
          
    exit(); // Menghentikan eksekusi skrip setelah menampilkan nomor antrian
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .confirmation-box {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
            margin-left: auto;
            margin-right: auto;
        }
        .confirmation-box h2 {
            margin-top: 0;
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 10px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        .confirmation-box p {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
            text-align: left;
            padding-left: 20px;
            margin-left: 20px;
        }
        .confirmation-box .nomor-antrian {
            font-size: 32px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .confirmation-box .terima-kasih {
            font-style: italic;
            color: #777;
            margin-bottom: 20px;
        }
        .cetak-button {
            background-color: #007BFF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        .cetak-button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
        .cetak-button:active {
            background-color: #004494;
            transform: translateY(0);
        }
        
    </style>
</head>
<body>
    <div class="confirmation-box">
        <h2>Konfirmasi Pendaftaran</h2>
        <?php
        if ($data_pendaftaran) {
            foreach ($data_pendaftaran as $key => $value) {
                if ($key != 'nomor_antrian') { // Jangan tampilkan nomor antrian di sini
                    $label = ucfirst(str_replace('_', ' ', $key));
                    echo "<p><strong>$label:</strong> $value</p>";
                }
            }
        } else {
            echo "<p>Tidak ada data pendaftaran yang tersedia.</p>";
        }
        ?>
        <form method="post" action="">
            <button type="submit" name="konfirmasi">Konfirmasi</button>
            <button type="button" onclick="window.history.back();">Kembali</button>
        </form>
    </div>
</body>
</html>
