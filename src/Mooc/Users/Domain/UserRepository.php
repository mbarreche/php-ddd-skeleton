<?php

namespace CodelyTv\Mooc\Users\Domain;

interface UserRepository
{
    public function saveUser(User $user): void;

    public function searchById(UserId $id): User;
}