<?php

namespace Moonphp\Moonphp\Helpers;

/**
 * Class Json untuk mengelola encoding dan decoding data JSON
 */
class Json
{
    /**
     * Mengubah data menjadi format JSON dan mengatur header Content-Type
     * 
     * @param mixed $data Data yang akan diubah menjadi JSON
     * @param int $options Opsi JSON encoding
     * @return string Data dalam format JSON
     */
    public static function encode($data, $options = 0): bool|string
    {
        header('Content-Type: application/json');
        return json_encode($data, $options);
    }

    /**
     * Mengubah string JSON menjadi array PHP
     * 
     * @param string $data String JSON yang akan didecode
     * @param int $options Opsi JSON decoding
     * @return mixed Hasil decode data JSON
     */
    public static function decode($data, $options = 0): mixed
    {
        return json_decode($data, true, 512, $options);
    }
}