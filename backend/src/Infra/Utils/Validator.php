<?php

namespace Infra\Utils;

class Validator {
    public static function validateNotEmpty($data, $fields): bool {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return false;
            }
        }
        return true;
    }

    public static function validateNumericPositive($data, $fields): bool {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || !is_numeric($data[$field]) || $data[$field] <= 0) {
                return false;
            }
        }
        return true;
    }
}
