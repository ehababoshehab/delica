<?php

namespace App\Services;

class CustomerService
{
    private $customer;

    const SHIPPING_ADDRESS = 'shipping';

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function getShippingAddress()
    {
        $shippingAddress = [];
        foreach ($this->customer['addresses'] as $addr) {
            if ($addr['type'] == CustomerService::SHIPPING_ADDRESS) {
                $shippingAddress['address'] = $addr['address'];
                $shippingAddress['city'] = $addr['city'];
                $shippingAddress['zip'] = $addr['zip'];
            }
        }
        return $shippingAddress;
    }
}
