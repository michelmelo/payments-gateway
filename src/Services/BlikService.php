<?php

namespace PaymentGateway\Services;

use PaymentGateway\Exceptions\PaymentException;
use PaymentGateway\Interfaces\PaymentMethodInterface;

class BlikService implements PaymentMethodInterface
{
    protected $paymentType;
    protected $paymentMethod = 'blik';
    protected $amount_value;
    protected $order_id;
    protected $amount_currency;
    protected $transactionID = null;

    private $apiEndpoint = '/api/v1/payments';

    public function processPayment(array $paymentData): array
    {
        $this->validatePaymentData($paymentData);

        $requestBody = [
            'paymentType'   => $this->paymentType,
            'paymentMethod' => $this->paymentMethod,
            'amount'        => [
                'value'    => $this->amount_value,
                'currency' => $this->amount_currency,
            ],
            'orderId' => $this->order_id,
        ];

        $response = $this->sendRequest('POST', $this->apiEndpoint, $requestBody);

        if ($response['status'] !== 'success') {
            throw new PaymentException('Failed to process Blik payment: ' . $response['message']);
        }

        $this->transactionID = $response['transactionId'];

        return $response;
    }

    public function refundPayment(string $transactionId, float $amountValue, string $amountCurrency, array $customerInfo = []): array
    {
        $endpoint = $this->apiEndpoint . '/' . $transactionId . '/refund';

        $requestBody = [
            'transactionId' => $transactionId,
            'amount'        => [
                'value'    => $amountValue,
                'currency' => $amountCurrency,
            ],
            'customerInfo' => $customerInfo,
        ];

        $response = $this->sendRequest('POST', $endpoint, $requestBody);

        if ($response['status'] !== 'success') {
            throw new PaymentException('Failed to refund Blik payment: ' . $response['message']);
        }

        return $response;
    }

    public function getPaymentStatus(string $transactionId): array
    {
        $endpoint = $this->apiEndpoint . '/' . $transactionId . '/status';

        $response = $this->sendRequest('GET', $endpoint);

        if ($response['status'] !== 'success') {
            throw new PaymentException('Failed to get Blik payment status: ' . $response['message']);
        }

        return $response;
    }

    private function validatePaymentData(array $paymentData): void
    {
        if (empty($paymentData['paymentType']) || empty($paymentData['amount_value']) || empty($paymentData['amount_currency']) || empty($paymentData['order_id'])) {
            throw new PaymentException('Invalid payment data provided.');
        }

        $this->paymentType     = $paymentData['paymentType'];
        $this->amount_value    = $paymentData['amount_value'];
        $this->amount_currency = $paymentData['amount_currency'];
        $this->order_id        = $paymentData['order_id'];
    }

    private function sendRequest(string $method, string $endpoint, array $body = []): array
    {
        // Simulate an HTTP request (you can replace this with Guzzle or another HTTP client)
        $url = 'https://api.example.com' . $endpoint;

        // Example of sending JSON request and receiving JSON response
        $response = [
            'status'        => 'success',
            'transactionId' => '123456789',
            'message'       => 'Payment processed successfully',
        ];

        return $response;
    }
}
