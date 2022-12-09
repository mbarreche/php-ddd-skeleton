<?php

namespace CodelyTv\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserRepository;

class UserCreator
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id, string $name, string $email, string $password)
    {
        $user = new User($id, $name, $email, $password);

        $this->repository->saveUser($user);
    }
}