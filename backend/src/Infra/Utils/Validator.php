<?php

namespace Infra\Utils;

use ErrorException;

class Validator
{
    public static function validateNotEmpty(array $data, array $fields): void
    {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new ErrorException("{$field} is required");
                http_response_code(400);
                $response = ['error' => "{$field} is required"];
                echo json_encode($response);
            }
        }
    }

    public static function validateNumericPositive(array $data, array $fields): void
    {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || !is_numeric($data[$field]) || $data[$field] <= 0) {
                throw new ErrorException("{$field} must be a positive number");
                http_response_code(400);
                $response = ['error' => "{$field} must be a positive number"];
                echo json_encode($response);
            }
        }
    }

    public static function validateMaxLength(array $data, array $fields, int $maxLength): void
    {
        foreach ($fields as $field) {
            if (isset($data[$field]) && strlen($data[$field]) > $maxLength) {
                throw new ErrorException("{$field} must be at most {$maxLength} characters long");
                http_response_code(400);
                $response = ['error' => "{$field} must be at most {$maxLength} characters long"];
                echo json_encode($response);
            }
        }
    }

    public static function validateMinLength(array $data, array $fields, int $minLength): void
    {
        foreach ($fields as $field) {
            if (isset($data[$field]) && strlen($data[$field]) < $minLength) {
                throw new ErrorException("{$field} must be at least {$minLength} characters");
                http_response_code(400);
                $response = ['error' => "{$field} must be at least {$minLength} characters"];
                echo json_encode($response);
            }
        }
    }
}
