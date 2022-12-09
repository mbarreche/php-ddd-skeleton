<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Tests\Shared\Domain\WordMother;

class UserNameMother
{
    public static function create(string $value): UserName
    {
        return new UserName($value);
    }

    public static function random(): UserName
    {
        return self::create(WordMother::random());
    }
}