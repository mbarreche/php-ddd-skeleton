<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\CreateUserRequest;
use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;

class UserMother
{
    public static function create(UserId $id, UserName $name, UserEmail $email, UserPassword $password): User
    {
        return new User($id, $name, $email, $password);
    }

    public static function fromRequest(CreateUserRequest $request): User
    {
        return self::create(
            UserIdMother::create($request->id()),
            UserNameMother::create($request->name()),
            UserEmailMother::create($request->email()),
            UserPasswordMother::create($request->password())
        );
    }

    public static function random(): User
    {
        return self::create(
            UserIdMother::random(),
            UserNameMother::random(),
            UserEmailMother::random(),
            UserPasswordMother::random(),
        );
    }
}