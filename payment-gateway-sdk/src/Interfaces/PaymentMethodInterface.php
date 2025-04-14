<?php

namespace MichelMelo\PaymentGateway\Interfaces;

interface PaymentMethodInterface
{
    public function processPayment(array $paymentData): array;

    public function validatePayment(array $paymentData): bool;

    public function getPaymentStatus(string $transactionId): array;
}
