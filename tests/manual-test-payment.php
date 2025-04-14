<?php

require __DIR__ . '/../vendor/autoload.php';

use MichelMelo\PaymentGateway\PaymentGateway;
use MichelMelo\PaymentGateway\Helpers\PaymentWidget;

try {
    // Inicialize o SDK
    $paymentGateway = new PaymentGateway(
        'your-bearer-token',
        'your-client-id',
        'your-terminal-id',
        'PURS', // ou 'AUTH'
        'https://api.paymentgateway.com'
    );

    // Dados do cliente
    $customer = [
        'customerInfo' => [
            'customerName'    => 'John Smith',
            'customerEmail'   => 'john@email.com',
            'customerPhone'   => '+351-912345678',
            'shippingAddress' => [
                'street1'  => 'Shipping street1',
                'street2'  => 'Shipping street2',
                'city'     => 'Lisbon',
                'postcode' => '1700-123',
                'country'  => 'PT',
            ],
            'billingAddress' => [
                'street1'  => 'Billing street1',
                'street2'  => 'Billing street2',
                'city'     => 'Lisbon',
                'postcode' => '1700-123',
                'country'  => 'PT',
            ],
        ],
    ];

    // Dados do pagamento
    $data = [
        'amount' => 10.00,
        'currency' => 'EUR',
    ];

    // Processar o pagamento
    $response = $paymentGateway->processPayment('blik', $data, $customer);

    // Gerar o formulário de pagamento
    $form = PaymentWidget::form('checkout', json_encode($response));

    // Gerar o HTML para exibir no navegador
    $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Pagamento</title>
</head>
<body>
    <h1>Teste de Pagamento</h1>
    <p>Exibindo o formulário de pagamento:</p>
    {$form}
</body>
</html>
HTML;

    // Salvar o HTML em um arquivo temporário
    $tempFile = sys_get_temp_dir() . '/payment-test.html';
    file_put_contents($tempFile, $html);

    // Abrir o navegador
    if (PHP_OS_FAMILY === 'Windows') {
        exec("start {$tempFile}");
    } elseif (PHP_OS_FAMILY === 'Darwin') {
        exec("open {$tempFile}");
    } else {
        exec("xdg-open {$tempFile}");
    }

    echo "O formulário de pagamento foi aberto no navegador.\n";

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}