<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Helpers\Logger;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class BlikService implements PaymentMethodInterface
{
    protected $payment_type;
    protected $paymentMethod = 'blik';
    protected $value;
    protected $order_id;
    protected $currency;
    protected $transactionID = null;

    private $apiEndpoint = '/api/v1/payments';

    public function processPayment(array $paymentData): array
    {
        // Valida os dados de pagamento
        //$this->validatePaymentData($paymentData);

        // Monta o corpo da requisição
        $body = [
            'merchant' => [
                'terminalId'            => $this->TerminalID,
                'channel'               => 'web',
                'merchantTransactionId' => $this->merchantTransactionId,
            ],
            'transaction' => [
                'transactionTimestamp' => date("Y-m-d\TH:i:s.v\Z"),
                'description'          => "{$this->transactionDescription} {$this->merchantTransactionId} terminalId={$this->TerminalID}",
                'moto'                 => false,
                'payment_type'          => $this->payment_type,
                'paymentMethod'        => $this->paymentMethod,
                'amount'               => [
                    'value'    => $this->value,
                    'currency' => $this->currency,
                ],
            ],
        ];

        // Monta os cabeçalhos da requisição
        $headers = [
            'User-Agent'      => $this->UserAgent,
            'Accept'          => 'application/json',
            'Content-Type'    => 'application/json',
            'Authorization'   => 'Bearer ' . $this->BearerToken,
            'X-IBM-Client-Id' => $this->APIClientID,
        ];

        try {
            // Envia a requisição para o endpoint
            $response = $this->sendRequest('POST', $this->apiEndpoint, [
                'headers' => $headers,
                'body'    => json_encode($body),
            ]);

            if ($response['status'] !== 'success') {
                throw new PaymentException('Failed to process Blik payment: ' . $response['message']);
            }

            $this->transactionID = $response['transactionId'];

            return $response;
        } catch (\Exception $e) {
            throw new PaymentException('An error occurred while processing the Blik payment: ' . $e->getMessage());
        }
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
        // Implementação para obter o status do pagamento
        return [
            'status'        => 'completed',
            'transactionId' => $transactionId,
        ];
    }

    public function validatePayment(array $paymentData): bool
    {
        // Validação dos dados de pagamento
        if (empty($paymentData['blik_code']) || empty($paymentData['amount'])) {
            throw new PaymentException('Invalid Blik payment data.');
        }

        return true; // Retorna true se os dados forem válidos
    }

    private function validatePaymentData(array $paymentData): void
    {
        if (empty($paymentData['payment_type']) || empty($paymentData['value']) || empty($paymentData['currency']) || empty($paymentData['order_id'])) {
            throw new PaymentException('Invalid payment data provided.');
        }

        $this->payment_type     = $paymentData['payment_type'];
        $this->value    = $paymentData['value'];
        $this->currency = $paymentData['currency'];
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
