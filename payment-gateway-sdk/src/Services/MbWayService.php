<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class MbWayService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData): array
    {
        // Implementação do processamento de pagamento para MBWay
        return [
            'status' => 'success',
            'message' => 'Payment processed successfully via MBWay.',
        ];
    }

    public function getPaymentStatus(string $transactionId): array
    {
        // Implementação para obter o status do pagamento
        return [
            'status' => 'completed',
            'transactionId' => $transactionId,
        ];
    }
}
