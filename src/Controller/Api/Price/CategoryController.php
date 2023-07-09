<?php

namespace App\Controller\Api\Price;

use App\Price\DTO\CategoryDTO;
use App\Price\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('api/price/suppliers/{supplierId}/categories')]
class CategoryController extends AbstractController
{
    private SerializerInterface $serializer;
    private MessageBusInterface $mb;
    private CategoryService $service;

    public function __construct(
        CategoryService $service,
        SerializerInterface $serializer,
        MessageBusInterface $mb
    )
    {
        $this->service = $service;
        $this->serializer = $serializer;
        $this->mb = $mb;
    }

    #[Route('', methods: 'get')]
    public function index(int $supplierId): Response
    {
        return $this->json([
            'categories' => $this->service->index($supplierId),
        ]);
    }

    #[Route('/{categoryId}', methods: 'get')]
    public function item(int $supplierId, int $categoryId): Response
    {
        return $this->json([
            'category' => $this->service->item($supplierId, $categoryId),
        ]);
    }

    #[Route('', methods: 'post')]
    public function create(Request $request, int $supplierId): Response
    {
        $model = $this->requestToDTO($request->getContent(), CategoryDTO::class);

        return $this->json([
            'category' => $this->service->create($model, $supplierId)
        ], Response::HTTP_CREATED);
    }

    #[Route('/{categoryId}', methods: 'put')]
    public function update(Request $request, int $supplierId, int $categoryId): Response
    {
        $model = $this->requestToDTO($request->getContent(), CategoryDTO::class);

        return $this->json([
            'category' => $this->service->update($model, $supplierId, $categoryId)
        ]);
    }

    #[Route('/{categoryId}', methods: 'delete')]
    public function delete(int $supplierId, int $categoryId): Response
    {
        $this->service->delete($supplierId, $categoryId);

        return $this->json([
            'message' => 'Category with category id ' . $categoryId . ' was deleted.'
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