<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\UserPassword;
use CodelyTv\Tests\Shared\Domain\WordMother;

class UserPasswordMother
{
    public static function create(string $value): UserPassword
    {
        return new UserPassword ($value);
    }

    public static function random(): UserPassword
    {
        return self::create(WordMother::randomUserPassword());
    }
}