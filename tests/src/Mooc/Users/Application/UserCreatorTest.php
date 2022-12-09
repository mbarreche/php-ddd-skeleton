<?php

namespace CodelyTv\Tests\Mooc\Users\Application;

use CodelyTv\Mooc\Users\Application\UserCreator;
use CodelyTv\Mooc\Users\Domain\UserRepository;
use InvalidArgumentException;
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

    /** @test */
    public function it_is_not_possible_a_very_short_user_name(): void
    {
        // then
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('<CodelyTv\Mooc\Users\Domain\UserName> does not allow the value <>.');

        // given
        $request = CreateUserRequestMother::create(
            UserIdMother::random()->value(),
            '',
            UserEmailMother::random()->value(),
            UserPasswordMother::random()->value()
        );
        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->never())
            ->method('saveUser');

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($request);
    }

    public function invalidPasswordsProvider(): array
    {
        return [
            'it is missed an upper case letter' => ['_abc_123_', 'The password is invalid. It must contain an upper case character'],
            'it is missed a lower case letter' => ['_ABC_123_', 'The password is invalid. It must contain a lower case character'],
            'it is missed a number' => ['_ABC_abc_', 'The password is invalid. It must contain a number'],
            'it is missed a symbol character' => ['ABC123abc', 'The password is invalid. It must contain a symbol (not a letter nor a number)'],
            'There are not an enough number of characters' => ['Aa1_Bb2', 'The password has an invalid length. It must be greater than 8 characters']
        ];
    }

    /**
     * @test
     * @dataProvider invalidPasswordsProvider
     */
    public function it_is_not_possible_a_invalid_password(string $password, string $errorMessage): void
    {
        // then
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($errorMessage);

        // given
        $request = CreateUserRequestMother::create(
            UserIdMother::random()->value(),
            UserNameMother::random()->value(),
            UserEmailMother::random()->value(),
            $password
        );
        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->never())
            ->method('saveUser');

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($request);
    }

    /**
     * @test
     */
    public function it_is_not_possible_an_invalid_id(): void
    {
        // then
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('<CodelyTv\Mooc\Users\Domain\UserId> does not allow the value <123>.');

        // given
        $request = CreateUserRequestMother::create(
            '123',
            UserNameMother::random()->value(),
            UserEmailMother::random()->value(),
            UserPasswordMother::random()->value()
        );
        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->never())
            ->method('saveUser');

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($request);
    }

    /**
     * @test
     */
    public function it_is_not_possible_an_invalid_email(): void
    {
        // then
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('<CodelyTv\Mooc\Users\Domain\UserEmail> does not allow the value <abc>.');

        // given
        $request = CreateUserRequestMother::create(
            UserIdMother::random()->value(),
            UserNameMother::random()->value(),
            'abc',
            UserPasswordMother::random()->value()
        );
        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->never())
            ->method('saveUser');

        // when
        $creator = new UserCreator($repository);
        $creator->__invoke($request);
    }
}
