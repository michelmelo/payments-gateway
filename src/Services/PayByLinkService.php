<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class PayByLinkService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData): array
    {
        // Implementação do processamento de pagamento para Pay By Link
        return [
            'status'  => 'success',
            'message' => 'Payment processed successfully via Pay By Link.',
        ];
    }

    public function getPaymentStatus(string $transactionId): array
    {
        // Implementação para obter o status do pagamento
        return [
            'status'        => 'completed',
            'transactionId' => $transactionId,
        ];
    }

    public function validatePayment(array $paymentData): bool
    {
        // Validação dos dados de pagamento
        if (empty($paymentData['link_id']) || empty($paymentData['amount'])) {
            throw new PaymentException('Invalid Pay By Link payment data.');
        }

        return true; // Retorna true se os dados forem válidos
    }
}
