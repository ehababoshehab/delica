<?php

namespace App\Services;

class OrdersService
{
    private $order;
    private $items;
    private $customers;

    public function __construct($order, $items, $customers)
    {
        $this->order = $order;
        $this->items = $items;
        $this->customers = $customers;
    }

    public function getItems()
    {
        return $this->items->where('orderId', $this->order['id']);
    }

    public function getCustomer()
    {
        return $this->customers->where('id', $this->order['customerId'])->first();
    }
}
