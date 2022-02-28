<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ItemRepository;
use App\Exports\OrdersExport;

use App\Services\OrdersService;
use App\Services\CustomerService;

use Excel;

class ExportOrders extends Command
{
    protected $signature = 'command:export-orders';
    protected $description = 'Export orders for shipping';

    protected $customerRepository;
    protected $orderRepository;
    protected $itemRepository;

    public function __construct()
    {
        parent::__construct();
        $this->customerRepository = new CustomerRepository;
        $this->orderRepository = new OrderRepository;
        $this->itemRepository = new ItemRepository;
    }

    public function handle()
    {
        $customers = collect($this->customerRepository->getCustomerData());
        $orders = collect($this->orderRepository->getOrdersData());
        $items = collect($this->itemRepository->getItemsData());

        $ordersData = [];
        foreach ($orders as $order) {

            $orderService = new OrdersService($order, $items, $customers);
            $orderItems = $orderService->getItems();
            $customer = $orderService->getCustomer();

            $customerService = new CustomerService($customer);
            $shippingAddress = $customerService->getShippingAddress();


            foreach ($orderItems as $item) {
                $ordersData[] = [
                    'orderID' => $order['id'],
                    'orderDate' => $order['createdAt'],
                    'orderItemID' => $item['id'],
                    'orderItemName' => $item['name'],
                    'orderItemQuantity' => $item['quantity'],
                    'customerFirstName' => $customer['firstName'],
                    'customerLastName' => $customer['lastName'],
                    'customerAddress' => $shippingAddress['address'],
                    'customerCity' => $shippingAddress['city'],
                    'customerZipCode' => $shippingAddress['zip'],
                    'customerEmail' => $customer['email'],
                ];
            }

        }

        $ordersExport = new OrdersExport($ordersData, 'Orders');

        $uploadPath = '/orders/'.md5(time()).'.csv';
        if (Excel::store($ordersExport, $uploadPath, 'local')) {
            $this->info('You can find the exported file in : /storage/app/orders');
            return 1;
        }
        $this->error('Something went wrong!');
    }
}
