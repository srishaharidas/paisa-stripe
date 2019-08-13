<?php

namespace Paisa\Stripe;

use Stripe\ApiResource;

abstract class BaseObject
{
    /** @var ApiResource */
    protected $remoteObject;

    public function __construct(ApiResource $stripeObject)
    {
        $this->remoteObject = $stripeObject;
    }

    public function getId()
    {
        return $this->remoteObject->id;
    }

    public function refresh()
    {
        $this->remoteObject->refresh();
    }
}