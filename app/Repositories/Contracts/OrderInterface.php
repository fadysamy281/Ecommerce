<?php

namespace App\Repositories\Contracts;

interface OrderInterface
{
    public function storeOrderDetails($params);
    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findOrderByNumber($orderNumber);

}
