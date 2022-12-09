<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Tests\Shared\Domain\WordMother;

class UserEmailMother
{
    public static function create(string $value): UserEmail
    {
        return new UserEmail ($value);
    }

    public static function random(): UserEmail
    {
        return self::create(WordMother::random());
    }
}