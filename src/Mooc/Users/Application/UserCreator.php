<?php

namespace CodelyTv\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;
use CodelyTv\Mooc\Users\Domain\UserRepository;

class UserCreator
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $user = new User(
            new UserId($request->id()),
            new UserName($request->name()),
            new UserEmail($request->email()),
            UserPassword::createPasswordByRaw($request->password())
        );
        $this->repository->saveUser($user);
    }
}