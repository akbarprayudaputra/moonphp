<?php

namespace Moonphp\Moonphp\Helpers;

class XSS
{
    public static function sanitize(array $input): array
    {
        $clean = [];

        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $clean[$key] = self::sanitize($value);
            } else {
                $clean[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
            }
        }

        return $clean;
    }
}
