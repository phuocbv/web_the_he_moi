<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Auth;
use Cart;
use App\Models\Receiver;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function model()
    {
        return Order::class;
    }

    public function createStripeCustomer($data) {
        $customer = \Stripe\Customer::create([                
            'source' => $data['stripeToken'],
            'email' => $data['email'],
            'metadata' => [
                'Name' => $data['name'],
                'Phone' => $data['phone']
            ]
        ]);

        return $customer->id;
    }

    public function createStripeCharge($amount, $customerId) {
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'customer' => $customerId,
            'metadata' => [
                'product_name' => 'shopee'
            ]
        ]);
    }

    public function saveReceiver($data) {
        $receiver = Receiver::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        return $receiver->id;
    }

    public function saveOrder($receiverId) {
        $order = Order::create([
            'quantity_item' => Cart::instance(Auth::user()->id)->count(),
            'total_discount' => 0,
            'total_price' => ((int) round(Cart::instance(Auth::user()->id)->subtotal(0, 0, ''))),
            'status' => 0,
            'user_id' => Auth::user()->id,
            'receiver_id' => $receiverId
        ]);

        return $order->id;
    }

    public function saveOrderDetail($orderId) {
        $cart = Cart::instance(Auth::user()->id)->content();

        foreach ($cart as $key => $item) {
            OrderDetail::create([
                'product_id' => $item->id,
                'quantity_item' => $item->qty,
                'price' => $item->price,
                'order_id' => $orderId 
            ]);
            
            $product = Product::find($item->id);
            if ($product) {
                $product->quantity -= $item->qty;
                if ($product->quantity > 0) {
                    $product->status = 1;                    
                } else {
                    $product->status = 0;
                }
                $product->save();
            }            
        }
    }
}
