<?php

namespace App\Price\Service;

use App\Price\DTO\SupplierDTO;
use App\Price\Entity\Supplier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SupplierService
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Supplier::class);
    }

    public function index(): array
    {
        return $this->repository->findAll();
    }

    public function item(int $id): Supplier
    {
        $supplier = $this->repository->findOneBy(['id' => $id]);
        
        if (!$supplier) {
            throw new NotFoundHttpException('Supplier with id: ' . $id . ' not found.');
        }

        return $supplier;
    }

    public function create(SupplierDTO $model): Supplier
    {
        $supplier = new Supplier();

        $supplier->setPrefix($model->getPrefix());
        $supplier->setName($model->getName());
        $supplier->setCompany($model->getCompany());
        $supplier->setUrl($model->getUrl());
        $supplier->setCity($model->getCity());
        $supplier->setIsActive($model->getIsActive());
        $supplier->setDiscount($model->getDiscount());
        $supplier->setDiscountBegin($model->getDiscountBegin());
        $supplier->setDiscountEnd($model->getDiscountEnd());
        $supplier->setFirstLimit($model->getFirstLimit());
        $supplier->setSecondLimit($model->getSecondLimit());
        $supplier->setFirstOverPrice($model->getFirstOverPrice());
        $supplier->setSecondOverPrice($model->getSecondOverPrice());
        $supplier->setThirdOverPrice($model->getThirdOverPrice());
        $supplier->setLabel($model->getLabel());
        $supplier->setPersonalMarks($model->getPersonalMarks());

        $this->save($supplier);

        return $supplier;
    }

    public function update(SupplierDTO $model, int $id): Supplier
    {
        $supplier = $this->item($id);

        $supplier->setPrefix($model->getPrefix());
        $supplier->setName($model->getName());
        $supplier->setCompany($model->getCompany());
        $supplier->setUrl($model->getUrl());
        $supplier->setCity($model->getCity());
        $supplier->setIsActive($model->getIsActive());
        $supplier->setDiscount($model->getDiscount());
        $supplier->setDiscountBegin($model->getDiscountBegin());
        $supplier->setDiscountEnd($model->getDiscountEnd());
        $supplier->setFirstLimit($model->getFirstLimit());
        $supplier->setSecondLimit($model->getSecondLimit());
        $supplier->setFirstOverPrice($model->getFirstOverPrice());
        $supplier->setSecondOverPrice($model->getSecondOverPrice());
        $supplier->setThirdOverPrice($model->getThirdOverPrice());
        $supplier->setLabel($model->getLabel());
        $supplier->setPersonalMarks($model->getPersonalMarks());

        $this->save($supplier);

        return $supplier;
    }

    public function delete(int $id): bool
    {
        $supplier = $this->item($id);

        try {
            $this->em->remove($supplier);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

        return true;
    }

    public function save(Supplier $supplier)
    {
        try {
            $this->em->persist($supplier);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}