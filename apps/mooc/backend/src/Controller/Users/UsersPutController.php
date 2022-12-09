<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\Users;

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
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $this->creator->__invoke($id, $name, $email, $password);
        return new Response('', Response::HTTP_CREATED);
    }
}