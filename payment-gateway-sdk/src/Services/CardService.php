<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class CardService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData)
    {
        // Implement card payment processing logic here
        // Validate payment data
        // Call external payment gateway API
        // Handle response and return result
    }

    public function refundPayment(string $transactionId, float $amount)
    {
        // Implement refund logic here
        // Call external payment gateway API for refund
        // Handle response and return result
    }

    public function getPaymentStatus(string $transactionId)
    {
        // Implement logic to retrieve payment status
        // Call external payment gateway API to get status
        // Handle response and return status
    }
}
