<?php

namespace CodelyTv\Mooc\Users\Infrastructure\Persistence;

use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;
use CodelyTv\Mooc\Users\Domain\UserRepository;

class FileUserRepository implements UserRepository
{
    private $directory;

    public function __construct()
    {
        $this->directory = __DIR__ . '/users';
    }

    public function saveUser(User $user): void
    {
        file_put_contents($this->fileName($user->id()->value()), $user->toString());
    }

    private function fileName(string $id): string
    {
        return "{$this->directory}.{$id}";
    }

    public function searchById(UserId $id): User
    {
        $text = file_get_contents($this->fileName($id->value()));
        return new User(
            new UserId($id->value()),
            new UserName($text['name']),
            new UserEmail($text['email']),
            UserPassword::createPasswordByHash($text['password'])
        );
    }
}