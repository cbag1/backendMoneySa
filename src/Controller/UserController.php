<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    // private$userhandler;
    // public function __construct(User $userhandler)
    // {   
    //     $this->userhandler= $userhandler;        
    // }

    // public function __invoke(User $data)  
    // {
    //     // $this->userhandler->handle($data);
    //     dd($data);

    //     // return $data;
    // }
    // /**
    //  * @Route("/user", name="user")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig', [
    //         'controller_name' => 'UserController',
    //     ]);
    // }
}
