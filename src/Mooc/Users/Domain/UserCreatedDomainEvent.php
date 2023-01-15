<?php

namespace CodelyTv\Mooc\Users\Domain;

use CodelyTv\Shared\Domain\Bus\DomainEvent;

class UserCreatedDomainEvent extends DomainEvent
{
    private $name;
    private $password;
    private $email;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function eventName(): string
    {
        return 'user.created';
    }

    public function plainBody(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}