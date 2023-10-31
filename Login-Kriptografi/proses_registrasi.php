<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $vigenereKey = "kriptografi"; // Ganti dengan kunci yang sesungguhnya

    // Fungsi untuk mengenkripsi kata sandi menggunakan Vigenere Cipher

        // Implementasi enkripsi Vigenere di sini
        function vigenereEncrypt($plainText, $key) {
            $result = "";
            $plainText = strtoupper($plainText); // Ubah teks menjadi huruf besar
            $key = strtoupper($key); // Ubah kunci menjadi huruf besar
            $keyLength = strlen($key);
        
            for ($i = 0, $j = 0; $i < strlen($plainText); $i++) {
                if (ctype_alpha($plainText[$i])) {
                    $textChar = ord($plainText[$i]) - ord('A'); // Konversi huruf ke angka (0-25)
                    $keyChar = ord($key[$j % $keyLength]) - ord('A'); // Ambil karakter kunci yang sesuai
                    $encryptedChar = chr(((($textChar + $keyChar) % 26) + ord('A'))); // Enkripsi karakter
                    $j++;
                } else {
                    $encryptedChar = $plainText[$i]; // Jika bukan huruf, biarkan karakter asli
                }
        
                $result .= $encryptedChar;
            }
        
            return $result;
        }
        

    // Enkripsi kata sandi yang dimasukkan
    $encryptedPassword = vigenereEncrypt($password, $vigenereKey);

    // Simpan data pengguna ke database (gantilah dengan koneksi ke database yang sesungguhnya)
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "login";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encryptedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
