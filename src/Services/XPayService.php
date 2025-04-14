<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class XPayService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData): array
    {
        // Implementação do processamento de pagamento para XPay
        return [
            'status'  => 'success',
            'message' => 'Payment processed successfully via XPay.',
        ];
    }

    public function refundPayment(string $transactionId, float $amount)
    {
        // Implement the logic to refund payment via XPay
        // Validate transaction ID and amount
        // Call XPay API for refund
        // Handle response and return result
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
        if (empty($paymentData['xpay_token']) || empty($paymentData['amount'])) {
            throw new PaymentException('Invalid XPay payment data.');
        }

        return true; // Retorna true se os dados forem válidos
    }
}
