<?php

namespace CodelyTv\Mooc\Users\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

class UserPassword extends StringValueObject
{
    private const MIN_LENGTH = 8;

    /** @throws InvalidArgumentException */
    public function __construct(string $value)
    {
        $this->ensureIsValidPassword($value);
        parent::__construct($value);
    }

    /** @throws InvalidArgumentException */
    private function ensureIsValidPassword(string $password): void
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new InvalidArgumentException('The password has an invalid length. It must be greater than 8 characters');
        }
        if (false === (bool)preg_match('/[a-z]/', $password)) {
            throw new InvalidArgumentException('The password is invalid. It must contain a lower case character');
        }
        if (false === (bool)preg_match('/[A-Z]/', $password)) {
            throw new InvalidArgumentException('The password is invalid. It must contain an upper case character');
        }
        if (false === (bool)preg_match('/[0-9]/', $password)) {
            throw new InvalidArgumentException('The password is invalid. It must contain a number');
        }
        if (false === (bool)preg_match('/[^a-zA-Z0-9]/', $password)) {
            throw new InvalidArgumentException('The password is invalid. It must contain a symbol (not a letter nor a number)');
        }
    }

    public function hashValue(): string
    {
        return password_hash($this->value(), PASSWORD_DEFAULT);
    }
}