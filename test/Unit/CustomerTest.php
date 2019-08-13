<?php

namespace Paisa\Stripe\Test\Unit;

use Paisa\Stripe\Customer;
use Paisa\Stripe\Test\Util\ReflectionHelper;
use Paisa\Stripe\Test\Util\TestCase;

class CustomerTest extends TestCase
{
    public function testCreate()
    {
        $actual = Customer::create([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'description' => $this->faker->sentence,
            'payment_method' => 'pm_test'
        ]);

        $this->assertInstanceOf(Customer::class, $actual);
        $this->assertInstanceOf(\Stripe\Customer::class, ReflectionHelper::getFieldValue($actual, 'remoteObject'));
    }
}
