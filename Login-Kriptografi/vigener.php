<?php
// Fungsi untuk mengenkripsi teks menggunakan Vigenere Cipher
function vigenereEncrypt($text, $key) {
    $result = "";
    $text = strtoupper($text);
    $key = strtoupper($key);
    $keyLength = strlen($key);

    for ($i = 0, $j = 0; $i < strlen($text); $i++) {
        if (ctype_alpha($text[$i])) {
            $textChar = ord($text[$i]) - ord('A');
            $keyChar = ord($key[$j % $keyLength]) - ord('A');
            $encryptedChar = chr(((($textChar + $keyChar) % 26) + ord('A')));
            $j++;
        } else {
            $encryptedChar = $text[$i];
        }

        $result .= $encryptedChar;
    }

    return $result;
}

// Fungsi untuk mendekripsi teks yang telah dienkripsi dengan Vigenere Cipher
function vigenereDecrypt($encryptedText, $key) {
    $result = "";
    $encryptedText = strtoupper($encryptedText);
    $key = strtoupper($key);
    $keyLength = strlen($key);

    for ($i = 0, $j = 0; $i < strlen($encryptedText); $i++) {
        if (ctype_alpha($encryptedText[$i])) {
            $encryptedChar = ord($encryptedText[$i]) - ord('A');
            $keyChar = ord($key[$j % $keyLength]) - ord('A');
            $decryptedChar = chr(((($encryptedChar - $keyChar + 26) % 26) + ord('A')));
            $j++;
        } else {
            $decryptedChar = $encryptedText[$i];
        }

        $result .= $decryptedChar;
    }

    return $result;
}
?>
