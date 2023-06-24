<?php

namespace App\Prom\Message;

use App\Prom\Entity\PromGroup;
use App\Prom\Message\SyncPromGroups;
use App\Prom\Service\PromGroupService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Shared\Service\Logger\LoggerInterface;
use DateTime;

#[AsMessageHandler]
class SyncPromGroupsHandler
{
    private HttpClientInterface $client;
    private LoggerInterface $logger;
    private PromGroupService $service;

    public function __construct(
        HttpClientInterface $client,
        LoggerInterface $logger,
        PromGroupService $service
    )
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->service = $service;
    }

    public function __invoke(SyncPromGroups $message)
    {
        $this->logger->log('Prom groups sync starts');
        $token = $message->getToken();

        $date = new DateTime('now');

        $fetchedGroupsCount = 0;
        $createdGroupsCount = 0;
        $updatedGroupsCount = 0;

        $groups = $this->fetchGroups($token);

        while (count($groups) > 0) {
            $fetchedGroupsCount += count($groups);

            foreach ($groups as $group) {
                $promGroup = null;

                try {
                    $promGroup = $this->service->getByGroupId($group->id);
                    ++$updatedGroupsCount;
                } catch (\Exception $e) {

                }

                if (!$promGroup) {
                    $promGroup = new PromGroup();
                    ++$createdGroupsCount;
                }

                $promGroup->setGroupId($group->id);
                $promGroup->setName($group->name);
                $promGroup->setDescription($group->description);
                $promGroup->setImage($group->image);
                $promGroup->setParentGroupId($group->parent_group_id);

                $this->service->save($promGroup);
            }
            
            $lastId = $groups[count($groups) - 1]->id;

            $groups = $this->fetchGroups($token, $lastId);
        }

        // mark all old groups as unactive
        $this->service->markUnactive($date->format('Y-m-d H:i:s'));

        $this->logger->log('Created new prom groups ' . $createdGroupsCount);
        $this->logger->log('Updated prom groups ' . $updatedGroupsCount);
        $this->logger->log('Prom groups sync ends');
    }

    private function fetchGroups(?string $token = null, ?int $lastId = null): array
    {
        $last = null;

        $groups = [];

        if ($lastId) {
            $last = '&last_id=' . $lastId;
        }

        try {
            $response = $this->client->request(
                'GET',
                'https://my.prom.ua/api/v1/groups/list?last_id=105650270&limit=100' . $last,
                ['headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]]
            );
    
            $content = $response->getContent();
    
            $groups = json_decode($content)->groups;
        } catch (\Exception $e) {
            $this->logger->error('fetchGroups ' . $e->getMessage());
        }

        return $groups;
    }
}