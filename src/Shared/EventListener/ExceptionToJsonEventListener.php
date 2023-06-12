<?php

namespace App\Shared\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionToJsonEventListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $message = [
            'message' => $exception->getMessage(),
        ];

        $response = new JsonResponse();
        $response->setContent(json_encode($message));

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}