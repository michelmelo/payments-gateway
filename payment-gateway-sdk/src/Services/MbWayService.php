<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class MbWayService implements PaymentMethodInterface
{
    public function processPayment(array $paymentData)
    {
        // Implement the logic to process payment via MBWay
        // Validate payment data
        // Call MBWay API
        // Handle response and return result
    }

    public function refundPayment(string $transactionId)
    {
        // Implement the logic to refund a payment via MBWay
        // Call MBWay API for refund
        // Handle response and return result
    }

    public function getPaymentStatus(string $transactionId)
    {
        // Implement the logic to get the status of a payment via MBWay
        // Call MBWay API to retrieve status
        // Handle response and return status
    }
}
