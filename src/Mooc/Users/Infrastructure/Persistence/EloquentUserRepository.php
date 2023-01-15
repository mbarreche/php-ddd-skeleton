<?php

namespace CodelyTv\Mooc\Users\Infrastructure\Persistence;

use CodelyTv\Mooc\Users\Domain\exceptions\UserNotFoundException;
use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserEmail;
use CodelyTv\Mooc\Users\Domain\UserId;
use CodelyTv\Mooc\Users\Domain\UserName;
use CodelyTv\Mooc\Users\Domain\UserPassword;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use CodelyTv\Mooc\Users\Infrastructure\Persistence\Eloquent\UserEloquentModel;

class EloquentUserRepository implements UserRepository
{
    public function saveUser(User $user): void
    {
        $model = new UserEloquentModel();
        $model->id = $user->id()->value();
        $model->name = $user->name()->value();
        $model->email = $user->email()->value();
        $model->password = $user->password()->value();
        $model->save();
    }

    public function searchById(UserId $id): User
    {
        $model = UserEloquentModel::find($id->value());

        if (null === $model) {
            throw new UserNotFoundException();
        }

        return new User(
            new UserId($model->id),
            new UserName($model->name),
            new UserEmail($model->duration),
            UserPassword::createPasswordByHash($model->password)
        );
    }
}