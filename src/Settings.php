<?php

namespace Paisa\Stripe;

class Settings
{
    private static $apiKey;

    private static $apiVersion;

    public static $currency = 'usd';

    public static function getParameters()
    {
        return [
            'currency' => self::$currency
        ];
    }

    public static function getOptions()
    {
        return [
            'api_key' => self::$apiKey,
            'stripe_version' => self::$apiVersion,
        ];
    }

    function setCredentials(array $credentials)
    {
        if (array_key_exists('api_key', $credentials)) {
            self::$apiKey = $credentials['api_key'];
        }
    }
}