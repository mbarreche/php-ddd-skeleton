<?php

namespace CodelyTv\Mooc\Users\Domain;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function toString(): string
    {
        return json_encode([
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'email' => $this->email()->value(),
            'password' => $this->password()->hashValue()
        ]);
    }
}