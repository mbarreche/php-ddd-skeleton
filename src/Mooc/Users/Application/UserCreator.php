<?php

namespace CodelyTv\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use CodelyTv\Shared\Domain\Bus\DomainEventPublisher;

class UserCreator
{
    private $repository;
    private $publisher;

    public function __construct(UserRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $user = User::create(
            new UserId($request->id()),
            new UserName($request->name()),
            new UserEmail($request->email()),
            UserPassword::createPasswordByRaw($request->password())
        );
        $this->repository->saveUser($user);
        $this->publisher->publish(...$user->pullDomainEvents());
    }
}