<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carts = Cart::where('product_id',$request->product_id )->where('user_id', $request->user_id)->first();;
        
        if ( !empty($carts) ) {
            $newQuantity = $carts->quantity + $request->quantity;
            $carts->quantity = $newQuantity;
            $carts->save();
        }else {
            $data = [
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image
            ];
        
            Cart::create($data);
        }
       
        return redirect()->route('showCart',Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $totalMoney = 0;
        $quantity = 0;
        $products = [];
        if ( isset($request->search) ) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('name', 'like', '%'.$request->search.'%')->orderBy('sort_order', 'ASC')->paginate(2);       
        }else {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('sort_order','=', 1)->orderBy('sort_order', 'ASC')->get(); 
        }
        $productBestSell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', '=', 1)->orderBy('sort_order', 'ASC')->paginate(2); 
        $carts = Cart::where('user_id', $id)->get();
        foreach ( $carts as $keyCart => $cartData ) {
            $totalMoney +=  floatval($cartData['product_price']) *  floatval($cartData['quantity']);
            $quantity = $keyCart + 1;
        }

        return view('web/cart/show',compact('carts', 'products', 'productBestSell'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cong($id)
    {
        $cart = Cart::find($id);
        $quantity = $cart->quantity + 1 ;
        $cart->quantity = $quantity;
        $cart->save();

        return redirect()->route('showCart',Auth::user()->id);
    }

    public function tru($id)
    {
        $cart = Cart::find($id);
        $quantity = $cart->quantity - 1 ;
        $cart->quantity = $quantity;
        $cart->save();
        
        return redirect()->route('showCart',Auth::user()->id);
    }

    public function update(Request $request, $id)
    {
        if( isset($request->update_cart) )
        {
            $carts = Cart::whereIn('id', $request->idc)->get();

            foreach ( $carts as $cartData ) {
                $cartUpdate = Cart::find($cartData->id);
                $cartUpdate->quantity = $request->quantity[$cartData->id];
                $cartUpdate->save();
            }
            
            return redirect()->route('showCart', Auth::user()->id);
        }else {
            $totalMoney = 0;
            $quantity = 0;
            $products = []; 

            if ( isset($request->search) ) {
                $products = Product::where('active', self::STATUS_ACTIVE)->where('name','like','%'.$request->search.'%')->orderBy('sort_order', 'ASC')->paginate(2);       
            }else {
                $products = Product::where('active', self::STATUS_ACTIVE)->where('sort_order','=', 1)->orderBy('sort_order', 'ASC')->get(); 
            }
            
            $provinces = Province::all();
            $productBestSell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell','=', 1)->orderBy('sort_order', 'ASC')->paginate(2); 
            $carts = Cart::whereIn('id', $request->idc)->where('user_id', $id)->get();
            foreach ( $carts as $key => $cartData ) {
                $totalMoney +=  floatval($cartData['product_price']) *  floatval($cartData['quantity']);
                $quantity += $carts->qty;
            }
            
            return view('web/order/add',compact('carts','products','productBestSell','provinces'))->with('quantity',$quantity)->with('totalMoney',$totalMoney);
        }
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        $output = "";
        if( $data['action'] ) {
            if( $data['action'] == 'provinces' ) {
                $huyen = District::where('province_id',$data['id'])->get();
                $output.='<option value="">---Chọn Huyện---</option>';
                foreach ($huyen as $h){
                    $output.='<option value="'.$h->id.'">'.$h->name.'</option>';
                }
            }else {
                $xa = Ward::where('district_id',$data['id'])->get();
                $output.='<option value="">---Chọn Xã---</option>';
                foreach ($xa as $x){
                    $output.='<option value="'.$x->id.'">'.$x->name.'</option>';
                }
            }
            echo $output;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        
        return redirect()->route('showCart',Auth::user()->id);
    }
}
