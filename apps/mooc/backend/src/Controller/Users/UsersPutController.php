<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\Users;

use CodelyTv\Mooc\Users\Application\CreateUserRequest;
use CodelyTv\Mooc\Users\Application\UserCreator;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersPutController
{
    private $creator;

    public function __construct(UserCreator $userCreator)
    {
        $this->creator = $userCreator;
    }

    public function __invoke(string $id, Request $request)
    {
        $request = new CreateUserRequest(
            $id,
            $request->request->get('name') ?: 'username',
            $request->request->get('email') ?: 'email@email.com',
            $request->request->get('password') ?: 'aA1_Bb2_'
        );

        try {
            $this->creator->__invoke($request);
        } catch (InvalidArgumentException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (UniqueConstraintViolationException $e) {
            return new Response('The user is already recorded in the database', Response::HTTP_BAD_REQUEST);
        }
        return new Response('', Response::HTTP_CREATED);
    }
}