<?php

namespace CodelyTv\Mooc\Users\Infraestructure;

use CodelyTv\Mooc\Users\Domain\User;
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
        file_put_contents($this->fileName($user->id()), $user->toString());
    }

    private function fileName(string $id): string
    {
        return "{$this->directory}.{$id}";
    }
}