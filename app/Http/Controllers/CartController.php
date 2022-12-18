<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class CartController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;

    public function save_cart(Request $request)
    {
        $newAmount = 0;
        $product = Product::find($request->product_id);
        if ($product->amount < $request->quantity) {
            session()->flash('messageAmount', 'Quantity exceeds the allowable limit');
        } else {
            $dataCart = [
                'id' => $request->product_id,
                'qty' => $request->quantity,
                'name' => $request->product_name,
                'price' => $request->product_price,
                'weight' => '12',
                'options' => ['image' => $request->product_image]
            ];

            $newAmount = $product->amount - $request->quantity;

            $product->amount = $newAmount;

            $product->save();

            Cart::add($dataCart);
        }
        return redirect()->route('show_Cart');
    }

    public function show_cart(Request $request)
    {
        $totalMoney = 0;
        $quantity = 0;
        $products = [];
        if (isset($request->search)) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('name', 'like', '%' . $request->search . '%')->orderBy('sort_order', 'ASC')->paginate(3);
        } else {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('sort_order', '=', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        }
        $productBestSell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', '=', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(2);

        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        return view('web/cart/show', compact('carts', 'products', 'productBestSell'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function show()
    {
        $carts = Cart::content();
        return response()->json(['carts' => $carts]);
    }

    public function delete_cart($rowId)
    {
        $newAmount = 0;

        $cart = Cart::get($rowId);

        $product = Product::find($cart->id);

        $newAmount = $product->amount + $cart->qty;

        $product->amount = $newAmount;

        $product->save();

        Cart::remove($rowId);

        $carts = Cart::content();

        return response()->json(['carts' => $carts]);
    }

    // update nhiều bản ghi
    public function update_quantity(Request $request)
    {
        $products = Product::all();
        $newAmount = 0;
        $messError = "";

        foreach ($products as $productData) {
            foreach ($request->data as $cartData) {
                $cart = Cart::get($cartData['key']);
                if ($productData->id == $cartData['productId']) {
                    if ($cartData['quantity'] < $cartData['value']) {
                        if (($cartData['value'] - $cartData['quantity']) > $productData->amount) {
                            $messError = "Quantity exceeds the allowable limit";
                        } else {
                            Cart::update($cartData['key'], $cartData['value']);
                            $product = Product::find($productData->id);
                            $newAmount = $product->amount - ($cartData['value'] - $cartData['quantity']);
                            $product->amount = $newAmount;
                            $product->save();
                        }
                    } else {
                        Cart::update($cartData['key'], $cartData['value']);
                        $product = Product::find($productData->id);
                        $newAmount = $product->amount +  ($cartData['quantity'] - $cartData['value']);
                        $product->amount = $newAmount;
                        $product->save();
                    }
                }
            }
        }

        $carts = Cart::content();

        return response()->json(['carts' => $carts, 'messError' => $messError]);
    }

    // update số lượng
    public function quantityUpdate(Request $request)
    {
        $newQuantity = 0;
        $newAmount = 0;
        $messError = "";

        $cart = Cart::get($request->rowId);
        $product = Product::find($cart->id);

        if (isset($cart)) {
            if ($request->status == "minusCart") {
                $newQuantity = $cart->qty - 1;
                $newAmount = $product->amount + 1;
            } else {
                if (1 > $product->amount) {
                    $newQuantity = $cart->qty;
                    $newAmount = $product->amount;
                    $messError = "Quantity exceeds the allowable limit";
                } else {
                    $newQuantity = $cart->qty + 1;
                    $newAmount = $product->amount - 1;
                }
            }
            Cart::update($request->rowId, $newQuantity);
        }

        $product->amount = $newAmount;
        $product->save();

        $carts = Cart::content();

        return response()->json(['carts' => $carts, 'messError' => $messError]);
    }
}