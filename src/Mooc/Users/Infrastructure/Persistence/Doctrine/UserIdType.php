<?php

namespace CodelyTv\Mooc\Users\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

class UserIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'user_id';
    }

    protected function typeClassName(): string
    {
        return UserId::class;
    }
}