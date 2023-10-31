<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $vigenereKey = "kriptografi"; // Ganti dengan kunci yang sesungguhnya

    // Fungsi untuk mengenkripsi kata sandi menggunakan Vigenere Cipher
    function vigenereEncrypt($plainText, $key) {
        $plainText = strtoupper($plainText); // Konversi teks menjadi huruf besar
        $key = strtoupper($key); // Konversi kunci menjadi huruf besar
    
        $encryptedText = "";
        $keyLength = strlen($key);
        $textLength = strlen($plainText);
    
        for ($i = 0; $i < $textLength; $i++) {
            if (ctype_alpha($plainText[$i])) {
                // Konversi huruf teks ke bilangan dari 0 (A) hingga 25 (Z)
                $plainChar = ord($plainText[$i]) - ord('A');
                // Konversi huruf kunci yang sesuai
                $keyChar = ord($key[$i % $keyLength]) - ord('A');
                // Enkripsi karakter dan konversi kembali ke huruf
                $encryptedChar = chr(((($plainChar + $keyChar) % 26) + ord('A')));
                $encryptedText .= $encryptedChar;
            } else {
                // Jika bukan huruf, biarkan karakter tersebut tanpa perubahan
                $encryptedText .= $plainText[$i];
            }
        }
    
        return $encryptedText;
    }    

    // Enkripsi kata sandi yang dimasukkan
    $encryptedPassword = vigenereEncrypt($password, $vigenereKey);

    // Bandingkan data pengguna dengan data yang ada di database (gantilah dengan koneksi ke database yang sesungguhnya)
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "login";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$encryptedPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login berhasil. Redirect atau tindakan selanjutnya di sini.";
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }

    $conn->close();
}
?>
