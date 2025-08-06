<?php


namespace app\core;


interface Controller
{
    public function Route($data);
    public static function Views($page);
}
