<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class PayByLinkService implements PaymentMethodInterface
{
    public function createPayment(array $paymentData)
    {
        // Logic to create a payment via Pay by Link
        // Validate payment data and initiate payment process
    }

    public function getPaymentStatus(string $paymentId)
    {
        // Logic to retrieve the status of a payment
        // Return the status of the payment based on the payment ID
    }

    public function refundPayment(string $paymentId, float $amount)
    {
        // Logic to process a refund for a payment
        // Validate refund amount and initiate refund process
    }
}
