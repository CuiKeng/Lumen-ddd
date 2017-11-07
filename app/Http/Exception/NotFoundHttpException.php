<?php

namespace App\Http\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundHttpException extends HttpException
{
    /**
     * NotFoundHttpException constructor.
     *
     * @param  string|null  $message
     * @param  \Exception|null  $previous
     * @param  array  $headers
     * @param  int  $code
     * @return void
     */
    public function __construct($message = null, Exception $previous = null, array $headers = [], $code = 0)
    {
        parent::__construct(404, $message, $previous, $headers, $code);
    }
}