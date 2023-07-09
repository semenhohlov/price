<?php

namespace App\Price\Service;

use App\Price\DTO\CategoryDTO;
use App\Price\Entity\Category;
use App\Price\Entity\Supplier;
use App\Prom\Service\PromGroupService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryService
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;
    private SupplierService $supplierService;
    private PromGroupService $promGroupService;

    public function __construct(
        EntityManagerInterface $em,
        SupplierService $supplierService,
        PromGroupService $promGroupService,
    ) 
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Category::class);
        $this->supplierService = $supplierService;
        $this->promGroupService = $promGroupService;
    }

    public function index(int $supplierId): array
    {
        $supplier = $this->supplierService->item($supplierId);

        return $this->repository->findBy([
            'supplier' => $supplierId
        ]);
    }

    public function item(int $supplierId, int $categoryId): Category
    {
        $supplier = $this->supplierService->item($supplierId);

        $category = $this->repository->findOneBy([
            'supplier' => $supplierId,
            'categoryId'=> $categoryId
        ]);

        if (!$category) {
            throw new NotFoundHttpException('Category with category id: ' . $categoryId . ' not found.');
        }

        return $category;
    }

    public function create(CategoryDTO $model, int $supplierId): Category
    {
        $supplier = $this->supplierService->item($supplierId);

        $category = new Category();

        $promGroup = null;

        if (!empty($model->getPromGroupId())) {
            $promGroup = $this->promGroupService->item($model->getPromGroupId());
        }
        
        $category->setCategoryId($model->getCategoryId());
        $category->setParentId($model->getParentId());
        $category->setName($model->getName());
        $category->setSupplier($supplier);
        $category->setPromGroup($promGroup);
        $category->setName($model->getName());
        $category->setIsActive($model->getIsActive());
        $category->setIsRrc($model->getIsRrc());

        $this->save($category);

        return $category;
    }
    
    public function update(CategoryDTO $model, int $supplierId, int $categoryId): Category
    {
        $supplier = $this->supplierService->item($supplierId);
        $category = $this->item($supplier->getId(), $categoryId);
        
        $promGroup = null;

        if (!empty($model->getPromGroupId())) {
            $promGroup = $this->promGroupService->item($model->getPromGroupId());
        }
        
        $category->setPromGroup($promGroup);
        $category->setIsActive($model->getIsActive());
        $category->setIsRrc($model->getIsRrc());

        $this->save($category);

        return $category;
    }

    public function delete(int $supplierId, int $categoryId): bool
    {
        $supplier = $this->supplierService->item($supplierId);

        $category = $this->item($supplier->getId(), $categoryId);

        try {
            $this->em->remove($category);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

        return true;
    }

    public function save(Category $category)
    {
        try {
            $this->em->persist($category);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}