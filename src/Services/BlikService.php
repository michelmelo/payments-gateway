<?php

namespace PaymentGateway\Services;

use PaymentGateway\Exceptions\PaymentException;
use PaymentGateway\Interfaces\PaymentMethodInterface;

class BlikService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData)
    {
        // Implement the logic to process Blik payments
        // Validate payment data
        // Call the Blik payment API
        // Handle response and return result
    }

    public function refundPayment(string $transactionId)
    {
        // Implement the logic to refund a Blik payment
        // Call the Blik refund API
        // Handle response and return result
    }

    public function getPaymentStatus(string $transactionId)
    {
        // Implement the logic to get the status of a Blik payment
        // Call the Blik status API
        // Handle response and return result
    }
}
