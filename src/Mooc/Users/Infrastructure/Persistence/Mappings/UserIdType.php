<?php

namespace CodelyTv\Mooc\Users\Infrastructure\Persistence\Mappings;

use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Shared\Infrastructure\Persistence\Mappings\UuidType;

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