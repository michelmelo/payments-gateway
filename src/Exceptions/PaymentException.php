<?php

namespace MichelMelo\PaymentGateway\Exceptions;

use Exception;
use Throwable;
use MichelMelo\PaymentGateway\Helpers\Logger;

/**
 * Exceção personalizada para erros de pagamento.
 */
class PaymentException extends Exception
{
    /**
     * Constructor.
     *
     * @param string $details
     * @param int $status
     * @param Throwable|null $previous
     */
    public function __construct(string $details = '', int $status = 0, ?Throwable $previous = null)
    {
        parent::__construct($details, $status, $previous);

        Logger::log($this->getErrorMessage());
    }

    /**
     * Get Error Message.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return "Payment Gateway Error: {$this->message}";
    }
}
