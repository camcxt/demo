<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Banner;
use Gloudemans\Shoppingcart\Facades\Cart;

class Product_imageController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cate = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $products = Product::find($id);
        $image = Product_image::where('active', self::STATUS_ACTIVE)->where('product_id', $id)->orderBy('sort_order', 'ASC')->get();
        
        return view('admin/img_product/add', compact('products', 'image', 'cate', 'band'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([  
            'sortOrder' => 'required|numeric' ,
            'imageUrl' => 'required'
        ], [
            'sortOrder.required' => 'Sort order has not been entered',
            'sortOrder.numeric' => 'Sort order is not number',
            'imageUrl.required' => 'Image has not been entered',
        ]);
        $image = $request->file('imageUrl');
        $imageName= $image->getClientOriginalName();
        $image->move('images',  $imageName);
            
        $data=[
            'product_id' => $request->productId,
            'image_url' => $imageName,
            'sort_order'=> $request->sortOrder,
            'active'=> self::STATUS_ACTIVE
        ];
     
        $productImage = Product_image::create($data);
       
        session()->flash('messageAdd', $productImage->image_url. ' has been added.');
        return redirect()->route('showImage', $request->productId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $product = Product::find($id);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        $images = Product_image::where('active', self::STATUS_ACTIVE)->where('product_id', $id)->orderBy('sort_order', 'ASC')->get();       
        
        return view('admin/img_product/show', compact('images', 'product', 'categories', 'brands'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$idp)
    {
        $image = Product_image::find($id);
        $image->active = self::STATUS_DELETED;
        $image->save();

        session()->flash('messageAdd', $image->name. ' has been added.');
        return redirect()->route('showImage', $idp);
    }

    public function home()
    {
        $totalMoney = 0;
        $quantity = 0;

        $carts = Cart::content();
        
        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        $banners = Banner::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();  
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $best_sell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        $new = Product::where('active', self::STATUS_ACTIVE)->where('is_new', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        $products = Product::where('active', self::STATUS_ACTIVE)->where('is_new', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get(); 
    
        return view('welcome', compact('banners', 'products', 'brands', 'best_sell', 'new'))->with('totalMoney', $totalMoney)->with('quantity', $quantity); 
  }
  
}