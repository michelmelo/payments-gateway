<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class XPayService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData)
    {
        // Implement the logic to process payment via XPay
        // Validate payment data
        // Call XPay API
        // Handle response and return result
    }

    public function refundPayment(string $transactionId, float $amount)
    {
        // Implement the logic to refund payment via XPay
        // Validate transaction ID and amount
        // Call XPay API for refund
        // Handle response and return result
    }

    public function getPaymentStatus(string $transactionId)
    {
        // Implement the logic to get payment status via XPay
        // Call XPay API to retrieve status
        // Handle response and return status
    }
}
