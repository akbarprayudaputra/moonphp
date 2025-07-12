<?php

namespace Moonphp\Moonphp\Helpers;

class Validator
{
    protected function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && empty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' wajib diisi';
            }
        }

        return $errors;
    }

}