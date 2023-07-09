<?php

namespace App\Controller\Api\Price;

use App\Price\DTO\SupplierDTO;
use App\Price\Service\SupplierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('api/price/suppliers')]
class SupplierController extends AbstractController
{
    private SerializerInterface $serializer;
    private MessageBusInterface $mb;
    private SupplierService $service;

    public function __construct(
        SupplierService $service,
        SerializerInterface $serializer,
        MessageBusInterface $mb
    )
    {
        $this->service = $service;
        $this->serializer = $serializer;
        $this->mb = $mb;
    }

    #[Route('', methods: 'get')]
    public function index(): Response
    {
        return $this->json([
            'suppliers' => $this->service->index()
        ]);
    }

    #[Route('/{id}', methods: 'get')]
    public function item(int $id): Response
    {
        return $this->json([
            'supplier' => $this->service->item($id)
        ]);
    }

    #[Route('', methods: 'post')]
    public function create(Request $request): Response
    {
        $model = $this->requestToDTO($request->getContent(), SupplierDTO::class);

        return $this->json([
            'supplier' => $this->service->create($model)
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: 'put')]
    public function update(Request $request, int $id): Response
    {
        $model = $this->requestToDTO($request->getContent(), SupplierDTO::class);

        return $this->json([
            'supplier' => $this->service->update($model, $id)
        ]);
    }

    #[Route('/{id}', methods: 'delete')]
    public function delete(int $id): Response
    {
        $this->service->delete($id);

        return $this->json([
            'message' => 'Supplier with id ' . $id . ' was deleted.'
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