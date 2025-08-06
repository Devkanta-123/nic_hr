<?php

namespace app\misc;

class File
{
    public static function getMimeType($string) {
        $string = explode(
            ';base64,',
            stristr($string, ';base64,', true)
        );

        if(empty($string[0])){
            return false;
        }

        preg_match('/^data:(.*)\/(.*)/', $string[0], $match);

        return [
            'mime' => $match[0],
            'type' => $match[1],
            'extension' => $match[2],
        ];
    }

}