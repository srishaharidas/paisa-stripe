<?php

namespace Paisa\Stripe;

class PaymentMethod extends BaseObject
{
    /** @var \Stripe\PaymentMethod */
    protected $remoteObject;
}