<?php

namespace App\Controller\Api\Prom;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Prom\Entity\PromCategory;
use Doctrine\ORM\EntityManagerInterface;

#[Route('api/prom/categories')]
class PromCategoryController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route("", methods: "get")]
    public function index(): Response
    {
        $rep = $this->em->getRepository(PromCategory::class);

        return $this->json([
            'prom_categories' => $rep->findAll(),
        ]);
    }
}