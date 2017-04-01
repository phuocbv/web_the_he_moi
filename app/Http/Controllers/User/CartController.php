<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Models\Product;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();
        foreach ($cart as $key => $item) {
            if ($item->options['quantity'] < $item->qty) {
                Cart::instance(Auth::user()->id)->update($item->rowId, ['qty' => $item->options['quantity']]);
            }
        }
        
        return view('user.cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);
        $number = $request->number ? $request->number : 1;
        if ($product) {
            $price = $product->price * (1 - $product->discount / 100);
            Cart::instance(Auth::user()->id)->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $number,
                'price' => $price,
                'options' => [
                    'shop_id' => $product->shop_id,
                    'shop_name' => $product->shop->name,
                    'discount' => $product->discount,
                    'old_price' => $product->price,
                    'quantity' => $product->quantity
                ]
            ]);

            return 'success';  
        }

        return 'not-found';
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            Cart::instance(Auth::user()->id)->remove($request->id);
        }
        $cart = Cart::instance(Auth::user()->id)->content();

        return view('user.cart.cart', compact('cart'));
    }

    public function clearCart()
    {
        Cart::instance(Auth::user()->id)->destroy();

        return redirect()->back();
    }

    public function upQuantity(Request $request)
    {
        if ($request->id) {
            $item = Cart::instance(Auth::user()->id)->get($request->id);
            Cart::instance(Auth::user()->id)->update($request->id, $item->qty + 1);
        }
        $cart = Cart::instance(Auth::user()->id)->content();

        return view('user.cart.cart', compact('cart'));
    }

    public function downQuantity(Request $request)
    {
        if ($request->id) {
            $item = Cart::instance(Auth::user()->id)->get($request->id);
            Cart::instance(Auth::user()->id)->update($request->id, $item->qty - 1);
        }
        $cart = Cart::instance(Auth::user()->id)->content();

        return view('user.cart.cart', compact('cart'));
    }
}
