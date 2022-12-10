<?php

namespace CodelyTv\Tests\Mooc\Users\Infrastructure;

use CodelyTv\Mooc\Users\Domain\exceptions\UserNotFoundException;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use CodelyTv\Tests\Mooc\Users\Application\UserIdMother;
use CodelyTv\Tests\Mooc\Users\Application\UserMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class UserRepositoryTest extends InfrastructureTestCase
{
    private function repository(): UserRepository
    {
        return $this->service(UserRepository::class);
    }

    /** @test */
    public function it_should_save_a_user(): void
    {
        $this->repository()->saveUser(UserMother::random());
    }

    /** @test */
    public function it_should_throw_an_exception_if_we_find_a_not_existent_user(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->repository()->searchById(UserIdMother::random());
    }
}
