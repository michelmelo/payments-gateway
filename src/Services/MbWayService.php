<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class MbWayService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData): array
    {
        // Implementação do processamento de pagamento
        return [
            'status' => 'success',
            'transactionId' => '123456789',
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

    public function validatePayment(array $paymentData): void
    {
        // Validação dos dados de pagamento
        if (empty($paymentData['amount']) || empty($paymentData['currency'])) {
            throw new \InvalidArgumentException('Dados de pagamento inválidos.');
        }
    }
}
