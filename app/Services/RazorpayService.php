<?php

namespace App\Services;

use Razorpay\Api\Api;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    // Create order
    public function createOrder($amount, $currency = 'INR')
    {
        $orderData = [
            'amount'   => $amount * 100, // amount in paise
            'currency' => $currency,
            'receipt'  => 'order_rcptid_' . time(),
        ];

        try {
            $order = $this->api->order->create($orderData);
            return $order;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
