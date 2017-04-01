<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function createStripeCustomer($data);

    public function createStripeCharge($amount, $customerId);

    public function saveReceiver($data);

    public function saveOrder($receiverId);

    public function saveOrderDetail($orderId);
}
