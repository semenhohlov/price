<?php

namespace App\Shared\Service\Logger;

use App\Shared\Service\Logger\LoggerInterface;
use DateTime;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class LoggerService implements LoggerInterface
{
    private $file = null;

    public function __construct(ContainerBagInterface $params)
    {
        try {
            $this->file = fopen($params->get('app.log_file_path'), 'a');
        } catch (\Exception $e)
        {
            throw new Exception('Logger error: ' . $e->getMessage());
        }
    }

    public function log(string $message): void
    {
        $date = new DateTime('now');

        try {
            fwrite(
                $this->file,
                $date->format('Y-m-d H:i:s') . ' [log]: ' . $message . PHP_EOL
            );
        } catch (\Exception $e)
        {
            throw new Exception('Logger error: ' . $e->getMessage());
        }
    }

    public function error(string $message): void
    {
        $date = new DateTime('now');

        try {
            fwrite(
                $this->file,
                $date->format('Y-m-d H:i:s') . ' [error]: ' . $message . PHP_EOL
            );
        } catch (\Exception $e)
        {
            throw new Exception('Logger error: ' . $e->getMessage());
        }
    }
}