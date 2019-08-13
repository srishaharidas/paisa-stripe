<?php

namespace Paisa\Stripe;

class Customer extends BaseObject
{
    /** @var \Stripe\Customer */
    protected $remoteObject;

    public static function create($params)
    {
//        $allowedKeys = ['description', 'email', 'name', 'payment_method'];
//        $presentKeys = array_keys($params);
//        $diff = array_diff_key($presentKeys, $allowedKeys);
//        if (!empty($diff)) {
//            throw new \Exception('Unexpected params ' . implode(', ', $diff));
//        };

        if (isset($params['payment_method']) && $params['payment_method'] instanceof PaymentMethod) {
            $params['payment_method'] = $params['payment_method']->getId();
        }

        return new Customer(\Stripe\Customer::create($params, Settings::getOptions()));
    }

    public function charge($amount, $paymentMethod, $options = [])
    {
        if ($paymentMethod instanceof PaymentMethod) {
            $paymentMethod = $paymentMethod->getId();
        }

        $params = array_merge(
            Settings::getParameters(),
            [
                'customer' => $this->getId(),
                'payment_method' => $paymentMethod,
                'confirm' => true,
                'off_session' => true
            ]
        );
        $paymentIntent = PaymentIntent::create($amount * 100, $params, $options);
        return $paymentIntent->getCharge();
    }
}