<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class CardService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData): array
    {
        // Implementação do processamento de pagamento para cartão
        return [
            'status' => 'success',
            'message' => 'Payment processed successfully via Card.',
        ];
    }

    public function getPaymentStatus(string $transactionId): array
    {
        return [
            'status' => 'completed',
            'transactionId' => $transactionId,
        ];
    }
}
