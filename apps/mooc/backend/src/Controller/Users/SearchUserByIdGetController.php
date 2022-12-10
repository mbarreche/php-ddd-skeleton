<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\Users;

use CodelyTv\Mooc\Users\Application\Search\UserSearcher;
use CodelyTv\Mooc\Users\Domain\exceptions\UserNotFoundException;
use CodelyTv\Mooc\Users\Domain\User;
use CodelyTv\Mooc\Users\Domain\UserId;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchUserByIdGetController
{
    private $userFinder;

    public function __construct(UserSearcher $userFinder)
    {
        $this->userFinder = $userFinder;
    }

    public function __invoke(string $id, Request $request)
    {
        try {
            /** @var User|null $user */
            $user = $this->userFinder->__invoke(new UserId($id));
        } catch (InvalidArgumentException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (UserNotFoundException $exception) {
            return new Response('User Not Found', Response::HTTP_NOT_FOUND);
        }

        $response = json_encode([
            'id' => $user->id()->value(),
            'name' => $user->name()->value(),
            'email' => $user->email()->value()
        ]);
        return new Response($response, Response::HTTP_CREATED);
    }
}