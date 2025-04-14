<?php

namespace MichelMelo\PaymentGateway\Exceptions;

use Exception;

class PaymentException extends Exception
{
    protected $message;

    public function __construct($message = 'An error occurred during payment processing', $code = 0, Exception $previous = null)
    {
        $this->message = $message;
        parent::__construct($this->message, $code, $previous);
    }

    public function getErrorMessage()
    {
        return $this->message;
    }
}
