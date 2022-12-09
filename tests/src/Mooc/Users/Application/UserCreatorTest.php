<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\UserCreator;
use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use PHPUnit\Framework\TestCase;

class UserCreatorTest extends TestCase
{
    /** @test */
    public function it_should_create_a_valid_user(): void
    {
        // given
        $id = 'some-id';
        $name = 'some-name';
        $email = 'valid@email.com';
        $password = 'some-password';

        $course = new User($id, $name, $email, $password);
        $repository = $this->createMock(UserRepository::class);
        $repository->method('saveUser')->with($course);

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($id, $name, $email, $password);
    }
}
