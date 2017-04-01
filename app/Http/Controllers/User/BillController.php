<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepositoryInterface as OrderInterface;
use Auth;

class BillController extends Controller
{
    private $orderRepository;

    public function __construct(OrderInterface $orderInterface)
    {
       $this->orderRepository = $orderInterface;
    }

    public function index()
    {
        $orders = $this->orderRepository->findByField('user_id', Auth::user()->id);

        return view('user.bill.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository->findWhere([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        return view('user.bill.detail', compact('order'));
    }
}
