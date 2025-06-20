<?php

namespace MichelMelo\PaymentGateway\Exceptions;

if (! class_exists('PrestaShopException')) {
    // Garante compatibilidade fora do ambiente PrestaShop
    class PrestaShopException extends \Exception
    {
    }
}

/**
 * Exceção personalizada para erros de pagamento.
 */
class PaymentException extends PrestaShopException
{
    /**
     * Construtor da exceção de pagamento.
     *
     * @param string $message Mensagem de erro.
     * @param int $code Código do erro.
     * @param \Exception|null $previous Exceção anterior.
     */
    public function __construct($message = 'An error occurred during payment processing', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Retorna a mensagem de erro.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->getMessage();
    }
}
