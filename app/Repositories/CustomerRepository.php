<?php

namespace App\Repositories;

use App\Traits\Data;

class CustomerRepository
{
    use Data;

    public function getCustomerData()
    {
        return $this->get(env('CUSTOMERS_ENDPOINT'));
    }
}
