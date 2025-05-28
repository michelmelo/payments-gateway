<?php

namespace MichelMelo\PaymentGateway\Helpers;

use MichelMelo\PaymentGateway\Helpers\Logger; // Adicionado
use Symfony\Component\VarDumper\VarDumper; // Certifique-se de que o VarDumper está disponível no projeto

class PaymentWidget
{
    /**
     * Gera o script do widget de pagamento.
     *
     * @param string $transactionID
     * @param string $url
     * @return string
     */
    public static function widget(string $transactionID, string $url = ''): string
    {
        return '<script src="' . $url . '/assets/js/widget.js?id=' . $transactionID . '"></script>';
    }

    /**
     * Gera o formulário de pagamento.
     *
     * @param string $formContext
     * @param string $formConfig
     * @return string
     */
    public static function form(string $formContext, string $formConfig): string
    {
        Logger::log('Payment data: ' . json_encode($formContext));
        Logger::log('Payment data: ' . json_encode($formConfig));

        return "<form class='paymentSPG' spg-context='" . $formContext . "' spg-config='" . $formConfig . "'></form>";
    }

    /**
     * Método para depuração de dados.
     *
     * @param mixed ...$vars
     * @return void
     */
    public static function MmDebug(...$vars): void
    {
        if (! in_array(\PHP_SAPI, ['cli', 'phpdbg'], true) && ! headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        exit(1);
    }
}
