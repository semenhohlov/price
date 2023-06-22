<?php

namespace App\Controller\Api\Prom;

use App\Prom\DTO\PromGroupActivateDTO;
use App\Prom\DTO\PromGroupDTO;
use App\Prom\Service\PromGroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('api/prom/groups')]
class PromGroupController extends AbstractController
{
    private SerializerInterface $serializer;
    private PromGroupService $service;

    public function __construct(
        PromGroupService $service,
        SerializerInterface $serializer
    )
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }
    
    #[Route('', methods: 'get')]
    public function index(): Response
    {
        return $this->json([
            'prom_groups' => $this->service->index()
        ]);
    }

    #[Route('/{id}', methods: 'get')]
    public function item(int $id): Response
    {
        return $this->json([
            'prom_group' => $this->service->item($id)
        ]);
    }

    #[Route('', methods: 'post')]
    public function create(Request $request): Response
    {
        $model = $this->requestToDTO($request->getContent(), PromGroupDTO::class);

        return $this->json([
            'prom_group' => $this->service->create($model)
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: 'put')]
    public function update(Request $request, int $id): Response
    {
        $model = $this->requestToDTO($request->getContent(), PromGroupDTO::class);

        return $this->json([
            'prom_group' => $this->service->update($model, $id)
        ]);
    }

    #[Route('/{id}', methods: 'delete')]
    public function delete(int $id): Response
    {
        $this->service->delete($id);

        return $this->json([
            'message' => 'Prom group with id ' . $id . ' was deleted.'
        ]);
    }

    #[Route('/{id}/activate', methods: 'post')]
    public function activate(Request $request, int $id): Response
    {
        $model = $this->requestToDTO(
            $request->getContent(), PromGroupActivateDTO::class
        );

        return $this->json([
            'prom_group' => $this->service->activate($id, $model)
        ]);
    }

    private function requestToDTO($content, $classDTO): mixed
    {
        return $this->serializer->deserialize(
            $content,
            $classDTO,
            'json'
        );
    }
}