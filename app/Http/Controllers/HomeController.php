<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Comment;

class HomeController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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

        return view('home', compact('banners','products','brands','best_sell','new'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function home()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $order = Order_item::groupBy('product_name')->groupBy('product_id')->select('product_name', 'product_id','product_image', Order_item::raw('sum(product_quantity) as total'))->orderBy('total', 'desc')->paginate(3);
        $orderData = Order::orderBy('total_money','DESC')->paginate(5);
        $comment = Comment::orderBy('id','DESC')->paginate(5);
        
        return view('admin/home', compact('categories', 'brands', 'order', 'orderData', 'comment'));
    }

}
