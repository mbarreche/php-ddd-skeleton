<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\UserId;

class UserIdMother
{
    public static function create(string $value): UserId
    {
        return new UserId($value);
    }

    public static function random(): UserId
    {
        return self::create(UserId::random());
    }
}