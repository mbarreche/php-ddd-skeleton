<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\CreateUserRequest;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;

class CreateUserRequestMother
{
    public static function create(UserId $id, UserName $name, UserEmail $email, UserPassword $password): CreateUserRequest
    {
        return new CreateUserRequest($id->value(), $name->value(), $email->value(), $password->value());
    }

    public static function random(): CreateUserRequest
    {
        return self::create(
            UserIdMother::random(),
            UserNameMother::random(),
            UserEmailMother::random(),
            UserPasswordMother::random()
        );
    }
}