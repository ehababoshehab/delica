<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Http;
use App\Traits\Data;

class OrderRepository
{
    use Data;

    public function getOrdersData()
    {
        return $this->get(env('ORDERS_ENDPOINT'));
    }
}
