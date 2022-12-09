<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\Users;

use CodelyTv\Mooc\Users\Application\CreateUserRequest;
use CodelyTv\Mooc\Users\Application\UserCreator;
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
            $request->request->get('name'),
            $request->request->get('email'),
            $request->request->get('password')
        );
        $this->creator->__invoke($request);
        return new Response('', Response::HTTP_CREATED);
    }
}