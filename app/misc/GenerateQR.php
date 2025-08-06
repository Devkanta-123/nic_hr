<?php
namespace app\misc;
class GenerateQR
{
    public static function generate($name, $data, $size, $output, $logo = FALSE)
    {

        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . 'x' . $size . '&chl=' . urlencode($data));
        if ($logo !== FALSE) {
            $logo = imagecreatefromstring(file_get_contents($logo));

            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            // Scale logo to fit in the QR Code
            $logo_qr_width = $QR_width / 3;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;

            imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        // imagepng($QR);
        $save = $output ."/". strtolower($name) . ".png";
        // chmod($save,0755);
        imagepng($QR, $save, 0, NULL);
        imagedestroy($QR);

        return $save;
    }

    public static function get($data, $size, $logo = FALSE)
    {

        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . 'x' . $size . '&chl=' . urlencode($data));
        if ($logo !== FALSE) {
            $logo = imagecreatefromstring(file_get_contents($logo));

            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            // Scale logo to fit in the QR Code
            $logo_qr_width = $QR_width / 3;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;

            imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }

        imagepng($QR);
        // $save = $output ."/". strtolower($name) . ".png";
        // chmod($save,0755);
        // imagepng($QR, $save, 0, NULL);
        imagedestroy($QR);

//        return $save;
    }
}
