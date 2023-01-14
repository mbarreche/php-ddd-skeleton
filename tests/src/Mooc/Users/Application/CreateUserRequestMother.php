<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\CreateUserRequest;

class CreateUserRequestMother
{
    public static function create(string $id, string $name, string $email, string $password): CreateUserRequest
    {
        return new CreateUserRequest($id, $name, $email, $password);
    }

    public static function random(): CreateUserRequest
    {
        return self::create(
            UserIdMother::random()->value(),
            UserNameMother::random()->value(),
            UserEmailMother::random()->value(),
            UserPasswordMother::random()->value()
        );
    }
}