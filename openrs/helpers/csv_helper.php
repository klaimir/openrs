<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CSV Helpers
 * Inspiration from Stack Overflow
 * 
 * @author		Ángel Luis Berasuain Ruiz
 * @link		http://stackoverflow.com/questions/20386371/php-how-to-save-text-file-with-ansi-encoding
 */
// ------------------------------------------------------------------------

/**
 * Array to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if (!function_exists('array_to_csv_binary')) {

    function array_to_csv_binary($array, $download = "") {
        if ($download != "") {
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
            // Para evitar que salgan con caracteres extraños
            header('Content-Transfer-Encoding: binary');
            header('Content-Description: File Transfer');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private, no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            ob_clean();
            flush();
        }

        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;
        foreach ($array as $line) {
            $n++;
            if (!fputcsv($f, $line, ';')) {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "") {
            return $str;
        } else {
            echo $str;
        }
    }
}

if (!function_exists('array_to_csv_zip')) {

    function array_to_csv_zip($array) {
        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;
        foreach ($array as $line) {
            $n++;            
            $linea=implode(';',$line)."\r\n";
            fwrite($f, $linea);
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }
}
