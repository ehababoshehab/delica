<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Http;
use App\Traits\Data;

class ItemRepository
{
    use Data;

    public function getItemsData()
    {
        return $this->get(env('ITEMS_ENDPOINT'));
    }
}
