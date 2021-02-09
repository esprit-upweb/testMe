<?php


namespace App\Services;



class TextFormat
{
    public static function removeSpecialChar(string $text) : string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $text); // Removes special chars.
    }
}
