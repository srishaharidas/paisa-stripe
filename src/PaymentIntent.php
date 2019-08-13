<?php

namespace Paisa\Stripe;

class PaymentIntent extends BaseObject
{
    /** @var \Stripe\PaymentIntent */
    protected $remoteObject;

    public static function fetch($id)
    {
        return new PaymentIntent(\Stripe\PaymentIntent::retrieve($id, Settings::getOptions()));
    }

    public static function create($amount, $params = [], $options = [])
    {
        $params = array_merge(
            Settings::getParameters(),
            [
                'amount' => $amount * 100,
                'payment_method_types' => ['card', 'card_present']
            ],
            $params
        );
        $options = array_merge(Settings::getOptions(), $options);
        return new PaymentIntent(\Stripe\PaymentIntent::create($params, $options));
    }

    public function capture()
    {
        $this->remoteObject->capture();
    }

    public function getPaymentMethod()
    {
        if (isset($this->remoteObject->charges->data[0]->payment_method)) {
            $stripePaymentMethod = new \Stripe\PaymentMethod($this->remoteObject->charges->data[0]->payment_method);
            return new PaymentMethod($stripePaymentMethod);
        }

        return null;
    }

    public function getCharge()
    {
        if ($this->isSucceeded() && isset($this->remoteObject->charges->data[0])) {
            $stripeCharge = \Stripe\Charge::constructFrom($this->remoteObject->charges->data[0], Settings::getOptions());
            $charge = new Charge($stripeCharge);
            return $charge;
        }

        return null;
    }

    public function isSucceeded()
    {
        return $this->remoteObject->status === 'succeeded';
    }
}