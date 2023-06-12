<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('', name: 'home', methods: 'GET')]
    public function home(): Response
    {
        return $this->json([
            'message' => 'ok'
        ]);
    }
}