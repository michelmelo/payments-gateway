<?php

namespace MichelMelo\PaymentGateway\Interfaces;

interface PaymentMethodInterface
{
    /**
     * Processes a payment with the provided payment data.
     *
     * @param array $paymentData An associative array containing payment information required to process the payment.
     * @return array An array containing the result of the payment processing, such as status, transaction ID, and any relevant messages.
     */
    public function processPayment(array $paymentData): array;

    /**
     * Validates the provided payment data.
     *
     * @param array $paymentData An associative array containing payment information to be validated.
     * @return bool Returns true if the payment data is valid, false otherwise.
     */
    public function validatePayment(array $paymentData): bool;

    /**
     * Retrieves the payment status for a given transaction.
     *
     * @param string $transactionId The unique identifier of the transaction to check.
     * @param string $bearerToken The bearer token used for authentication.
     * @param string $clientId The client identifier associated with the request.
     * @return array An associative array containing the payment status details.
     */
    public function getPaymentStatus(string $transactionId, string $bearerToken, string $clientId): array;

    /**
     * Requests a refund for a given transaction.
     *
     * @param string $transactionId The unique identifier of the original transaction.
     * @param float $amountValue The amount to be refunded.
     * @param string $amountCurrency The currency of the refund.
     * @param array $customerInfo An associative array with customer and additional parameters.
     * @return array An associative array containing the refund result.
     */
    public function refundPayment(string $transactionId, float $amountValue, string $amountCurrency, array $customerInfo = []): array;
}
