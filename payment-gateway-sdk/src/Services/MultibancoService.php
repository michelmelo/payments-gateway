<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class MultibancoService implements PaymentMethodInterface
{
    public function createPayment(array $paymentData)
    {
        // Implement the logic to create a Multibanco payment
        // Validate payment data
        // Call the payment gateway API
        // Return the response
    }

    public function getPaymentStatus(string $paymentId)
    {
        // Implement the logic to retrieve the status of a Multibanco payment
        // Call the payment gateway API
        // Return the payment status
    }

    public function refundPayment(string $paymentId, float $amount)
    {
        // Implement the logic to refund a Multibanco payment
        // Validate refund amount
        // Call the payment gateway API
        // Return the response
    }
}
