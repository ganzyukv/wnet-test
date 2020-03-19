<?php
declare(strict_types=1);

namespace App\Exception;


class NotFoundHttpException extends HttpException
{
    /**
     * @param string     $message  The internal exception message
     */
    public function __construct(string $message = null)
    {
        parent::__construct(404, $message);
    }
}