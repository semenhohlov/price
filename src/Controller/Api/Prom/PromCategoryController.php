<?php

namespace App\Controller\Api\Prom;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Prom\Entity\PromCategory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('api/prom/categories')]
class PromCategoryController extends AbstractController
{
    private EntityManagerInterface $em;
    private EntityRepository $rep;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->rep = $this->em->getRepository(PromCategory::class);
    }
    
    #[Route('', methods: 'get')]
    public function index(): Response
    {
        return $this->json([
            'prom_categories' => $this->rep->findAll(),
        ]);
    }

    #[Route('/{portalId}', methods: 'get')]
    public function item(int $portalId): Response
    {
        $promCategory = $this->rep->findOneBy(['portalId' => $portalId]);
        
        if (!$promCategory) {
            throw new NotFoundHttpException(
                'Prom category with portal id ' . $portalId . ' not found.'
            );
        }

        return $this->json([
            'prom_category' => $promCategory,
        ]);
    }
}