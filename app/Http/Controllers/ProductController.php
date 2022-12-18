<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product_image;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;
    const Add = "Add";
    const NoAdd = "NoAdd";
    const PER_SEARCH = 3;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productName = "";
        $productCategory = self::STATUS_INACTIVE;
        $productBrand = self::STATUS_INACTIVE;
        $productBestSell = self::STATUS_DELETED;
        $productNew = self::STATUS_DELETED;
        $query = "";
        $products = [];
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        if (isset($request->brand)) {
            $productBrand = $request->brand;
            if ($query == "") {
                $query .= " " . "brand_id =" . $request->brand;
            } else {
                $query .= " AND " . "brand_id =" . $request->brand;
            }
        }

        if (isset($request->searchInput)) {
            $productName = $request->searchInput;
            if ($query == "") {
                $query .= " " . "name like '%" . $request->searchInput . "%'";
            } else {
                $query .= " AND " . "name like '%" . $request->searchInput . "%'";
            }
        }

        if (isset($request->category)) {
            $productCategory = $request->category;
            if ($query == "") {
                $query .= " " . "category_id =" . $request->category;
            } else {
                $query .= " AND " . "category_id =" . $request->category;
            }
        }

        if (isset($request->isNew)) {
            $productNew = $request->isNew;
            if ($query == "") {
                $query .= " " . "is_new =" . $request->isNew;
            } else {
                $query .= " AND " . "is_new =" . $request->isNew;
            }
        }
        if (isset($request->bestSell)) {
            $productBestSell = $request->bestSell;
            if ($query == "") {
                $query .= " " . "is_best_sell =" . $request->bestSell;
            } else {
                $query .= " AND " . "is_best_sell =" . $request->bestSell;
            }
        }

        if (isset($request->btnSearch)) {
            if (!isset($request->brand) && !isset($request->searchInput) && !isset($request->category) && !isset($request->isNew) && !isset($request->bestSell)) {
                $products = Product::orderBy('id', 'DESC')->where('active', '<', self::STATUS_DELETED)->paginate(self::PER_PAGE);
            } else {
                $products = DB::select('SELECT * FROM products WhERE ' . $query . ' AND active < ' . self::STATUS_DELETED . ' limit ' . self::PER_PAGE);
            }
        } else {
            $products = Product::orderBy('id', 'DESC')->where('active', '<', self::STATUS_DELETED)->paginate(self::PER_PAGE);
        }

        return view('admin/product/show', compact('products', 'categories', 'brands'))->with('name', $productName)->with('productCategory', $productCategory)->with('productBrand', $productBrand)->with('productBestSell', $productBestSell)->with('productNew', $productNew);
    }

    public function shop()
    {
        $totalMoney = 0;
        $quantity = 0;

        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        $products = Product::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE_FRONT);

        return view('web/product/show_all', compact('products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/product/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oldPrice = 0;
        if (isset($request->oldPrice)) {
            $oldPrice = $request->oldPrice;
        } else {
            $oldPrice = $request->price + 1;
        }

        $request->validate([
            'category' => 'required',
            'brand' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required|numeric|max: ' . $oldPrice,
            'description' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'category.required' => 'Categoy has not been entered',
            'name.required' => 'Product name has been existed',
            'name.unique' => 'Product name has been existed',
            'brand.required' => 'Brand has not been entered',
            'sortOrder.numeric' => 'Sort order is not number',
            'price.required' => 'Price has not been entered',
            'price.numeric' => 'Price is not number',
            'price.max' => 'The new price must be less than the old price',
            'description.required' => 'Description has not been entered',
            'sortOrder.required' => 'Sort order has not been entered'
        ]);

        $imageName = "";
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
        } else {
            $imageName = "no-image.png";
        }

        $data = [
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'image' =>  $imageName,
            'price' => $request->price,
            'old_price' => $request->oldPrice,
            'description' => $request->description,
            'tags' => $request->tags,
            'is_best_sell' => $request->bestSell,
            'is_new' => $request->isNew,
            'sort_order' => $request->sortOrder,
            'active' => $request->acTive,
            'amount' => $request->amount
        ];

        $product = Product::create($data);

        session()->flash('messageAdd', $product->name . ' has been added.');
        return redirect()->route('indexProduct');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // show front-end 
    public function show(Request $request, $id)
    {
        $totalMoney = 0;
        $quantity = 0;

        //check exist user
        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        //all comment
        $comments = Comment::where('product_id', $id)->orderBy('id', 'DESC')->paginate(5);

        //product
        $product = Product::findorfail($id);

        // session()->pull('productReviewData');

        //add list review
        $status = "";
        if (session()->has('productReviewData')) {
            foreach (array_reverse(session()->get('productReviewData')) as $key => $data) {
                if ($key < 3) {
                    if ($data->id == $product->id) {
                        $status = self::NoAdd;
                        break;
                    } else {
                        $status = self::Add;
                    }
                } else {
                    $status = self::Add;
                }
            }
        } else {
            $status = self::Add;
        }

        if ($status == self::Add) {
            session()->push('productReviewData', $product);
        }

        $products = [];

        if (isset($request->search)) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('name', 'like', '%' . $request->search . '%')->orderBy('sort_order', 'ASC')->paginate(3);
        } else {
            $products = Product::where('active', '<', self::STATUS_DELETED)->where('sort_order', '=', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        }

        //product by tag
        $productTag = Product::where('active', self::STATUS_ACTIVE)->where('brand_id', $product->brand_id)->orderBy('sort_order', 'ASC')->get();

        // dd($productTag);
        //image product by id
        $productImg = Product_image::where('active', self::STATUS_ACTIVE)->where('product_id', '=', $product->id)->orderBy('sort_order', 'ASC')->paginate(3);

        return view('web/product/show', compact('products', 'product', 'productTag', 'productImg', 'comments'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function showbyBrand($id)
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $products = Product::where('active', '<', self::STATUS_DELETED)->where('brand_id', $id)->orderBy('sort_order', 'ASC')->paginate(2);

        return view('admin/product/show', compact('products', 'categories', 'brands'));
    }

    public function showbyCate($id)
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $products = Product::where('active', '<', self::STATUS_DELETED)->where('category_id', $id)->orderBy('sort_order', 'ASC')->paginate(2);

        return view('admin/product/show', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // All categories (without deleted records)
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        // Brands
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        // Products
        $product = Product::find($id);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        // Selected category
        $category = Category::find($product->category_id);

        // Selected brand
        $brand = Brand::find($product->brand_id);

        return view('admin/product/update', compact('categories', 'brands', 'product', 'category', 'brand'));
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
        $oldPrice = 0;
        if (isset($request->oldPrice)) {
            $oldPrice = $request->oldPrice;
        } else {
            $oldPrice = $request->price + 1;
        }

        $request->validate([
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric|max: ' . $oldPrice,
            'name' => 'required',
            'description' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'category.required' => 'Categoy has not been entered',
            'name.required' => 'Product name has been existed',
            'brand.required' => 'Brand has not been entered',
            'sortOrder.numeric' => 'Sort order is not number',
            'price.required' => 'Price has not been entered',
            'price.numeric' => 'Price is not number',
            'price.max' => 'The new price must be less than the old price',
            'description.required' => 'Description has not been entered',
            'sortOrder.required' => 'Sort order has not been entered'
        ]);

        // upload image
        $imageName = "";
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
        } else {
            $imageName = $request->imageOld;
        }

        // Update product
        $products = Product::find($id);
        $products->category_id  = $request->category;
        $products->brand_id  = $request->brand;
        $products->image = $imageName;
        $products->price = $request->price;
        $products->old_price = $request->oldPrice;
        $products->description = $request->description;
        $products->tags = $request->tags;
        $products->is_best_sell = $request->bestSell;
        $products->is_new = $request->isNew;
        $products->active = $request->acTive;
        $products->sort_order = $request->sortOrder;
        $products->amount = $request->amount;

        //save products
        $products->save();

        session()->flash('messageUpdate', $products->name . ' has been updated.');

        return redirect()->route('indexProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find product
        $product = Product::find($id);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        //update product
        $product->active = self::STATUS_DELETED;

        //save product
        $product->save();

        session()->flash('messageDelete', $product->name . ' has been deleted.');
        return redirect()->route('indexProduct');
    }

    public function showbyTag($tag)
    {
        $totalMoney = 0;
        $quantity = 0;

        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        $products = Product::where('active', self::STATUS_ACTIVE)->where('tags', 'like', '%' . $tag . '%')->orderBy('sort_order', 'ASC')->paginate(12);

        return view('web/product/show_all', compact('products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function showbyView($status)
    {
        $totalMoney = 0;
        $quantity = 0;

        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        $products = [];

        if ($status == 1) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE_FRONT);
        } elseif ($status == 2) {
            if (!empty(session()->get('productReviewData'))) {
                $products = array_reverse(session()->get('productReviewData'));
            }
        } elseif ($status == 3) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('is_new', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE_FRONT);
        }

        return view('web/product/show_all', compact('products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function active(Request $request)
    {
        //find product
        $product = Product::find($request->id);

        //update product
        $product->active = $request->status;

        //save product
        $product->save();

        echo ($request->status);
    }

    public function searchName(Request $request)
    {
        if (!isset($request->searchInput)) {
            $products = Product::where('active', self::STATUS_ACTIVE)->limit(self::PER_SEARCH)->get();
        } else {
            $products = Product::where('name', 'like', '%' . $request->searchInput . '%')->where('active', self::STATUS_ACTIVE)->limit(self::PER_SEARCH)->get();
        }

        $output = "";

        foreach ($products as $productData) {
            if ($productData->old_price != 0) {
                $output .= '<div class="thubmnail-recent">
                    <img style="width: 30%;" src="/phone/public/images/' . $productData->image . '" class="recent-thumb" alt="">
                    <h2 style="width: 70;"><a href="' . route('showProduct', $productData->id) . '">' . $productData->name . '</a></h2>
                    <div class="product-sidebar-price">
                        <ins>$' . number_format($productData->price) . '</ins> <del>$' . number_format($productData->old_price) . '</del>
                    </div>
                </div>';
            } else {
                $output .= '<div class="thubmnail-recent">
                <img style="width: 30%;" src="/phone/public/images/' . $productData->image . '" class="recent-thumb" alt="">
                <h2 style="width: 70;"><a href="' . route('showProduct', $productData->id) . '">' . $productData->name . '</a></h2>
                <div class="product-sidebar-price">
                    <ins>$' . number_format($productData->price) . '</ins>
                </div>
            </div>';
            }
        }

        echo $output;
    }
}