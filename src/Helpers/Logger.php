<?php

namespace MichelMelo\PaymentGateway\Helpers;

class Logger
{
    private static $enabled = true; // Controle para ativar/desativar o log
    private static $logFile = __DIR__ . '/../../logs/payment-gateway.log';

    /**
     * Ativa o sistema de log.
     */
    public static function enable(): void
    {
        self::$enabled = true;
    }

    /**
     * Desativa o sistema de log.
     */
    public static function disable(): void
    {
        self::$enabled = false;
    }

    /**
     * Registra uma mensagem no log.
     *
     * @param string $message
     */
    public static function log(string $message): void
    {
        if (! self::$enabled) {
            return;
        }

        $timestamp        = date('Y-m-d H:i:s');
        $formattedMessage = "[{$timestamp}] {$message}\n";

        file_put_contents(self::$logFile, $formattedMessage, FILE_APPEND);
    }
}
