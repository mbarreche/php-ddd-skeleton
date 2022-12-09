<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\UserCreator;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use PHPUnit\Framework\TestCase;

class UserCreatorTest extends TestCase
{
    /** @test */
    public function it_should_create_a_valid_user(): void
    {
        // given
        $request = CreateUserRequestMother::random();
        $user = UserMother::fromRequest($request);
        $repository = $this->createMock(UserRepository::class);
        $repository->method('saveUser')->with($user);

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($request);
    }
}
