<?php

$string = "Nomor Tselpon:0821
Nama: Ferisa Winarta
Nama minuman: Bir bar
Jumlah: 10";


function extractValuesFromString(string $string )
{
    $delimiter = ',';

    $patterns = array(
        '/Nomor Telpon:\s*([^\\r\\n]+)/i',
        '/Nama:\s*([^\\r\\n]+)/i',
        '/Nama minuman:\s*([^\\r\\n]+)/i',
        '/Jumlah:\s*([^\\r\\n]+)/i'
    );

    $values = array();

    // Periksa keberadaan pemisah koma
    if (strpos($string, $delimiter) !== false) {
        // Jika ada pemisah koma, gunakan pola regex
        foreach ($patterns as $pattern) {
            preg_match($pattern, $string, $matches);
            $value = trim($matches[1]);
            $values[] = $value;
        }
        
    } else {
        // Jika tidak ada pemisah koma, ambil nilai langsung dari string
        foreach ($patterns as $pattern) {
            preg_match($pattern, $string, $matches);
            if (isset($matches[1])) {
                $value = trim($matches[1]);
                $values[] = $value;
            }
        }
        
        
    }

    return $values;
}

extractValuesFromString($string);
