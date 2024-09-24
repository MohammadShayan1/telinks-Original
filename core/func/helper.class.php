<?php
class helper
{
    public function __construct()
    {
    }

    public static function searchMultipleWords($string, $words)
    {
        foreach ($words as $word) {
            if (strpos($string, $word) !== false)
                return true;
        }

        return false;
    }

    public function __destruct()
    {
    }

}