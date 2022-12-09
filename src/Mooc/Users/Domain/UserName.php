<?php

namespace CodelyTv\Mooc\Users\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

class UserName extends StringValueObject
{
    private const LIMIT_MIN = 2;

    /** @throws InvalidArgumentException */
    public function __construct(string $value)
    {
        $this->ensureIsValidName($value);
        parent::__construct($value);
    }

    /** @throws InvalidArgumentException */
    private function ensureIsValidName(string $name): void
    {
        $validate = strlen($name) > self::LIMIT_MIN;
        if ($validate === false) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $name));
        }
    }
}