<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrdersExport implements FromArray, WithHeadings, ShouldAutoSize, WithStrictNullComparison, WithTitle
{
    protected $ordersData;

    public function __construct($ordersData, $title)
    {
        $this->ordersData = $ordersData;
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return [
            'orderID',
            'orderDate',
            'orderItemID',
            'orderItemName',
            'orderItemQuantity',
            'customerFirstName',
            'customerLastName',
            'customerAddress',
            'customerCity',
            'customerZipCode',
            'customerEmail'
        ];
    }

    public function array() : array
    {

        foreach ($this->ordersData as $row) {
            $data[] = [
                $row['orderID'],
                $row['orderDate'],
                $row['orderItemID'],
                $row['orderItemName'],
                $row['orderItemQuantity'],
                $row['customerFirstName'],
                $row['customerLastName'],
                $row['customerAddress'],
                $row['customerCity'],
                $row['customerZipCode'],
                $row['customerEmail']
            ];
        }

        return $data;
    }
}
