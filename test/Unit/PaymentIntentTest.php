<?php

namespace Paisa\Stripe\Test\Unit;

use Paisa\Stripe\PaymentIntent;
use Paisa\Stripe\PaymentMethod;
use Paisa\Stripe\Test\Util\ReflectionHelper;
use Paisa\Stripe\Test\Util\TestCase;

class PaymentIntentTest extends TestCase
{
    public function testFetch()
    {
        $actual = PaymentIntent::fetch('pi_test');

        $this->assertInstanceOf(PaymentIntent::class, $actual, 'should be a PaymentIntent instance');
        $this->assertInstanceOf(
            \Stripe\PaymentIntent::class,
            ReflectionHelper::getFieldValue($actual, 'remoteObject'),
            'should contain a Stripe Payment Intent object'
        );
    }

    public function testCreate()
    {
        $actual = PaymentIntent::create(1234, 'usd');

        $this->assertInstanceOf(PaymentIntent::class, $actual, 'should be a PaymentIntent instance');
        $this->assertInstanceOf(
            \Stripe\PaymentIntent::class,
            ReflectionHelper::getFieldValue($actual, 'remoteObject'),
            'should contain a Stripe Payment Intent object'
        );
    }

    public function testCapture()
    {
        $stripeIntent = \Stripe\PaymentIntent::create(['amount' => 1234, 'currency' => 'usd']);
        $intent = new PaymentIntent($stripeIntent);

        $intent->capture();
    }

    public function testGetPaymentMethod()
    {
        $paymentIntent = PaymentIntent::fetch('pi_test');

        $actual = $paymentIntent->getPaymentMethod();

        $this->assertInstanceOf(PaymentMethod::class, $actual);
        $this->assertInstanceOf(\Stripe\PaymentMethod::class, ReflectionHelper::getFieldValue($actual, 'remoteObject'));
    }
}
