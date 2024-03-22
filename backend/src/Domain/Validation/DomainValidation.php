<?php

namespace Domain\Validation;

use Exception;

class DomainValidation
{
    public static function notNull(string $value, string $exceptMessage = null)
    {
        if (empty($value)) {
            throw new Exception($exceptMessage ?? 'Should not be empty or null');
        }
    }

    public static function strMaxLength(string $value, int $length = 255, string $exceptMessage = null)
    {
        if (strlen($value) >= $length) {
            throw new Exception($exceptMessage ?? "The value must not be greater than {$length} characters");
        }
    }

    public static function strMinLength(string $value, int $length = 3, string $exceptMessage = null)
    {
        if (strlen($value) < $length) {
            throw new Exception($exceptMessage ?? "The value must be at least {$length} characters");
        }
    }

    public static function strCanNullAndMaxLength(string $value = '', int $length = 255, string $exceptMessage = null)
    {
        if (! empty($value) && strlen($value) > $length) {
            throw new Exception($exceptMessage ?? "The value must not be greater than {$length} characters");
        }
    }
}
