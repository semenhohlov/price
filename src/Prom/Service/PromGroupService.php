<?php

namespace App\Prom\Service;

use App\Prom\Entity\PromCategory;
use App\Prom\Entity\PromGroup;
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

    public function create(
        int $groupId,
        string $name,
        ?string $description = null,
        ?string $image = null,
        ?int $parentGroupId = null,
        ?int $portalId = null,
        ?string $portalUrl = null,
        ?string $keywords = null,
        ?string $keywordsUkr = null,
    ): PromGroup
    {
        $promGroup = new PromGroup();

        $promGroup->setGroupId($groupId);
        $promGroup->setName($name);
        $promGroup->setDescription($description);
        $promGroup->setImage($image);
        $promGroup->setParentGroupId($parentGroupId);
        $promGroup->setPortalId($portalId);
        $promGroup->setPortalUrl($portalUrl);
        $promGroup->setKeywords($keywords);
        $promGroup->setKeywordsUkr($keywordsUkr);

        $this->save($promGroup);

        return $promGroup;
    }

    public function update(
        int $id,
        ?string $name,
        ?string $description = null,
        ?string $image = null,
        ?int $parentGroupId = null,
        ?int $portalId = null,
        ?string $portalUrl = null,
        ?string $keywords = null,
        ?string $keywordsUkr = null,
    ): PromGroup
    {
        $promGroup = $this->item($id);

        if ($name) {
            $promGroup->setName($name);
        }

        if ($description) {
            $promGroup->setDescription($description);
        }

        if ($image) {
            $promGroup->setImage($image);
        }

        if ($parentGroupId) {
            $promGroup->setParentGroupId($parentGroupId);
        }

        if ($portalId) {
            $promGroup->setPortalId($portalId);
        }

        if ($portalUrl) {
            $promGroup->setPortalUrl($portalUrl);
        }

        if ($keywords) {
            $promGroup->setKeywords($keywords);
        }

        if ($keywordsUkr) {
            $promGroup->setKeywordsUkr($keywordsUkr);
        }

        $this->save($promGroup);

        return $promGroup;
    }

    public function delete(int $id)
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
    }

    public function activate(int $id, bool $active = true)
    {
        $promGroup = $this->item($id);

        $promGroup->setIsActive($active);

        $this->save($promGroup);
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