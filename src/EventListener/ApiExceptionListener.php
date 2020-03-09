<?php

namespace App\EventListener;

use App\Factory\NormalizerFactory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\ApiResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Checks if there was Exception during API request and generates JSON error response
 */
final class ApiExceptionListener
{
    /**
     * @var NormalizerFactory
     */
    private $normalizerFactory;

    /**
     * ExceptionListener constructor.
     *
     * @param NormalizerFactory $normalizerFactory
     */
    public function __construct(NormalizerFactory $normalizerFactory)
    {
        $this->normalizerFactory = $normalizerFactory;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

//        if (in_array('application/json', $request->getAcceptableContentTypes()) && strpos($request->getRequestUri(), '/api/') === true) {
        if (strpos($request->getRequestUri(), '/api/') !== false) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }

    /**
     * Creates the ApiResponse from any Exception
     *
     * @param \Exception $exception
     *
     * @return ApiResponse
     */
    private function createApiResponse(\Throwable $exception)
    {
        $normalizer = $this->normalizerFactory->getNormalizer($exception);
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
            $message = $exception->getMessage();
        } else {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Internal server error';
        }

        try {
            $errors = $normalizer ? $normalizer->normalize($exception) : [];
        } catch (\Throwable $e) {
            $errors = [];
        }

        return new ApiResponse($message, null, $errors, $statusCode);
    }
}