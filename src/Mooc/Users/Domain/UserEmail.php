<?php

namespace CodelyTv\Mooc\Users\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

class UserEmail extends StringValueObject
{
    /** @throws InvalidArgumentException */
    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);
        parent::__construct($value);
    }

    /** @throws InvalidArgumentException */
    private function ensureIsValidEmail(string $email): void
    {
        $validate = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($validate === false) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $email));
        }
    }
}