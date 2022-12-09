<?php

namespace CodelyTv\Mooc\Users\Domain;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function toString(): string
    {
        return json_encode([
            'id' => $this->id(),
            'name' => $this->name(),
            'email' => $this->email(),
            'password' => password_hash($this->password(), PASSWORD_DEFAULT)
        ]);
    }
}