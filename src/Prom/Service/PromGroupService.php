<?php

namespace App\Prom\Service;

use App\Prom\DTO\PromGroupActivateDTO;
use App\Prom\DTO\PromGroupDTO;
use App\Prom\Entity\PromCategory;
use App\Prom\Entity\PromGroup;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromGroupService
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(PromGroup::class);
    }

    public function index(): array
    {
        return $this->repository->findAll();
    }

    public function item(int $id): PromGroup
    {
        $promGroup = $this->repository->findOneBy(['id' => $id]);
        
        if (!$promGroup) {
            throw new NotFoundHttpException('Prom group with id: ' . $id . ' not found.');
        }

        return $promGroup;
    }

    public function create(PromGroupDTO $model): PromGroup
    {
        $promGroup = new PromGroup();

        $promGroup->setGroupId($model->getGroupId());
        $promGroup->setName($model->getName());
        $promGroup->setDescription($model->getDescription());
        $promGroup->setImage($model->getImage());
        $promGroup->setParentGroupId($model->getParentGroupId());
        $promGroup->setPortalId($model->getPortalId());
        $promGroup->setPortalUrl($model->getPortalUrl());
        $promGroup->setKeywords($model->getKeywords());
        $promGroup->setKeywordsUkr($model->getKeywordsUkr());

        $promGroup->setCreatedAt(new DateTime('now'));
        $promGroup->setUpdatedAt(new DateTime('now'));

        $this->save($promGroup);

        return $promGroup;
    }

    public function update(PromGroupDTO $model, int $id): PromGroup
    {
        $promGroup = $this->item($id);

        if ($model->getName()) {
            $promGroup->setName($model->getName());
        }
        if ($model->getDescription()) {
            $promGroup->setDescription($model->getDescription());
        }
        if ($model->getImage()) {
            $promGroup->setImage($model->getImage());
        }
        if ($model->getParentGroupId()) {
            $promGroup->setParentGroupId($model->getParentGroupId());
        }
        if ($model->getPortalId()) {
            $promGroup->setPortalId($model->getPortalId());
        }
        if ($model->getPortalUrl()) {
            $promGroup->setPortalUrl($model->getPortalUrl());
        }
        if ($model->getKeywords()) {
            $promGroup->setKeywords($model->getKeywords());
        }
        if ($model->getKeywordsUkr()) {
            $promGroup->setKeywordsUkr($model->getKeywordsUkr());
        }

        $promGroup->setUpdatedAt(new DateTime('now'));

        $this->save($promGroup);

        return $promGroup;
    }

    public function delete(int $id): bool
    {
        $promGroup = $this->item($id);

        try {
            $this->em->remove($promGroup);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

        return true;
    }

    public function activate(int $id, PromGroupActivateDTO $model): PromGroup
    {
        $promGroup = $this->item($id);

        $promGroup->setIsActive($model->getActivate());

        $promGroup->setUpdatedAt(new DateTime('now'));

        $this->save($promGroup);

        return $promGroup;
    }

    private function save(PromGroup $promGroup)
    {
        $parentGroupId = $promGroup->getParentGroupId();

        if ($parentGroupId) {
            if (!$this->repository->findOneBy(['id' => $parentGroupId])) {
                throw new NotFoundHttpException(
                    'Parent group with id ' . $parentGroupId . ' not found.'
                );
            }
        }

        $portalId = $promGroup->getPortalId();

        if ($portalId) {
            $promCategoryRepository = $this->em
                ->getRepository(PromCategory::class);

            if (!$promCategoryRepository->findOneBy(['portalId' => $portalId])) {
                throw new NotFoundHttpException(
                    'Prom category with portal id ' . $portalId . ' not found.'
                );
            }
        }

        try {
            $this->em->persist($promGroup);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}