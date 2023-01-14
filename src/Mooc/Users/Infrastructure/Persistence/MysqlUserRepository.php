<?php

namespace CodelyTv\Mooc\Users\Infrastructure\Persistence;

use CodelyTv\Mooc\Users\Domain\exceptions\UserNotFoundException;
use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use Doctrine\ORM\EntityManager;

class MysqlUserRepository implements UserRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveUser(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);
    }

    public function searchById(UserId $id): User
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        if (null === $user) {
            throw new UserNotFoundException();
        }
        return $user;
    }
}