<?php

namespace Paisa\Stripe\Test\Util;

use Faker\Factory;
use Faker\Generator;
use PHPUnit_Framework_TestCase;
use Stripe\Stripe;

class TestCase extends PHPUnit_Framework_TestCase
{
    /** @var Generator */
    protected $faker;

    public static function setUpBeforeClass()
    {
        Stripe::setApiKey('sk_test_123');
        Stripe::$apiBase = 'http://localhost:12111';
    }

    public function setUp()
    {
        $this->faker = Factory::create();
    }
}