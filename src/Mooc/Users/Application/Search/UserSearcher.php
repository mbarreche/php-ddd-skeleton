<?php

namespace CodelyTv\Mooc\Users\Application\Search;

use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserRepository;

class UserSearcher
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserId $userId)
    {
        return $this->repository->searchById($userId);
    }
}