<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function strpos;

/**
 * Checks if there was HttpException during API request and generates JSON error response
 */
final class HTTPExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (! ($exception instanceof HttpException) || strpos($event->getRequest()->getRequestUri(), '/api/') === false) {
            return;
        }

        // TODO - better use 'fail' status as this exception tells about wrong input from user
        $response = new JsonResponse(['status' => 'error', 'message' => $exception->getMessage()]);
        $response->setStatusCode($exception->getStatusCode());
        $event->setResponse($response);
    }
}