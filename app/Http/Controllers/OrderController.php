<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\seesions;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class OrderController extends Controller
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
    public function index(Request $request)
    {
        // $inputName = "";
        // $inputPhone = "";
        // $inputEmail = "";
        // $query = "";
        // $orders = [];

        // if (isset($request->inputName)) {
        //     $inputName = $request->inputName;
        //     if ($query == "") {
        //         $query .= " " . "customer_name like '%" . $request->inputName . "%'";
        //     } else {
        //         $query .= " AND " . "customer_name like '%" . $request->inputName . "%'";
        //     }
        // }

        // if (isset($request->inputPhone)) {
        //     $inputPhone = $request->inputPhone;
        //     if ($query == "") {
        //         $query .= " " . "customer_phone like '%" . $request->inputPhone . "%'";
        //     } else {
        //         $query .= " AND " . "customer_phone like '%" . $request->inputPhone . "%'";
        //     }
        // }

        // if (isset($request->inputEmail)) {
        //     $inputEmail = $request->inputEmail;
        //     if ($query == "") {
        //         $query .= " " . "customer_email like '%" . $request->inputEmail . "%'";
        //     } else {
        //         $query .= " AND " . "customer_email like '%" . $request->inputEmail . "%'";
        //     }
        // }

        // if (isset($request->btnSearch)) {
        //     if (!isset($request->inputName) && !isset($request->inputPhone) && !isset($request->inputEmail)) {
        //         $orders = Order::orderBy('id', 'DESC')->get();
        //         $this->data = $orders;
        //     } else {
        //         $orders = DB::select('SELECT * FROM orders WhERE ' . $query);
        //         $this->status = $orders;
        //     }
        // } else {
        //     $orders = Order::all();
        //     $this->data = $orders;
        // }
        $dataSearch = [
            'name' => $request->inputName,
            'phone' => $request->inputPhone,
            'email' => $request->inputEmail,
            'status' => 'btnSearch'
        ];
        $orders = $this->search($request->inputName, $request->inputPhone, $request->inputEmail, $request->btnSearch);

        $this->data = $orders;

        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $itemOrder = Order_item::all();

        return view('admin/order/show', compact('categories', 'brands', 'orders', 'itemOrder', 'dataSearch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $totalMoney = 0;
        $quantity = 0;
        $carts = Cart::content();

        $products  = Product::where('active', self::STATUS_ACTIVE)->limit(self::STATUS_DELETED + 1)->get();
        $provinces = Province::all();
        $productBestSell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', '=', self::STATUS_ACTIVE)->orderBy('id', 'DESC')->paginate(self::STATUS_DELETED);

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        if ($carts->isEmpty()) {
            session()->flash('messageCartEmpty', 'Cart is empty!');
            return view('web/cart/show', compact('carts', 'products', 'productBestSell'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
        } else {
            return view('web/order/add', compact('carts', 'products', 'productBestSell', 'provinces'))->with('quantity', $quantity)->with('totalMoney', $totalMoney);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mail::send('/web/orderSucess', ['customerName' => $request->customer_name, 'totalMoney' => $request->total_money,], function ($message) {
            $message->to('bonbon2k1a@gmail.com')->subject('Order');
        }, 'Bạn đã mua sản phẩm tại Shop');

        $tinh = Province::find($request->provinces);
        $huyen = District::find($request->districts);
        $xa = Ward::find($request->wards);
        $address = $request->address;
        $diachi = $address . '-' . $xa->name . '-' . $huyen->name . '-' . $tinh->name;
        $today = Carbon::today();

        $cart = Cart::content();

        $dataOrder = [
            'user_id' => $request->user_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'total_money' => $request->total_money,
            'total_products' => $request->total_products,
            'created_date' => $today,
            'address' => $diachi,
            'status' => "0"
        ];

        $order = Order::create($dataOrder);
        if (isset($order)) {

            if (isset($request->user_id)) {
                $customer = Customer::find($request->user_id);
                $customer->name = $request->customer_name;
                $customer->phone = $request->customer_phone;
                $customer->email = $request->customer_email;
                $customer->save();
            }

            foreach ($cart as $cartItem) {
                $data = [
                    'order_id' => $order->id,
                    'product_id' => $cartItem->id,
                    'product_name' => $cartItem->name,
                    'product_image' => $cartItem->options->image,
                    'product_price' => $cartItem->price,
                    'product_quantity' => $cartItem->qty
                ];
                $orderId = Order_item::create($data);
            }
            Cart::destroy();
        }

        return redirect()->route('orderSuccess');
    }

    public function orderSuccess()
    {

        $idOrder = 0;

        if (isset(Auth::user()->id)) {
            $order = DB::select("SELECT MAX(id) as idOrder FROM orders WHERE customer_email like '%" . Auth::user()->email . "%'");
            foreach ($order as $order) {
                $idOrder = $order->idOrder;
            }
        }

        return view('/web/orderSucess')->with('idOrder', $idOrder);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $totalMoney = 0;
        $quantity = 0;

        $products  = Product::where('active', self::STATUS_ACTIVE)->limit(self::STATUS_DELETED + 1)->get();
        $orders = Order::where('customer_email', 'like', '%' . $email . '%')->orderBy('id', 'DESC')->get();
        $orderItem = Order_item::all();
        //$orderItem = DB::select("SELECT * FROM orders join order_items on orders.id = order_items.order_id WHERE orders.customer_email like '%" . $email . "%'");

        $carts = Cart::content();
        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        return view('/web/order/show', compact('orders', 'orderItem', 'products'))->with('quantity', $quantity)->with('totalMoney', $totalMoney);
    }

    public function showItem($id)
    {
        $totalMoney = 0;
        $quantity = 0;
        $totalMoneyOrder = 0;
        $quantityOrder = 0;

        $products  = Product::where('active', self::STATUS_ACTIVE)->limit(self::STATUS_DELETED + 1)->get();

        $order = Order::find($id);
        $itemOrder = DB::select("SELECT * FROM orders join order_items on orders.id = order_items.order_id WHERE orders.customer_email like '%" . $order->customer_email . "%' and orders.id =" . $order->id);

        $carts = Cart::content();
        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        foreach ($itemOrder as $keyCart => $itemOrderData) {
            $totalMoneyOrder +=  $itemOrderData->product_price * $itemOrderData->product_quantity;
            $quantityOrder += $itemOrderData->product_quantity;
        }

        $productBestSell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', '=', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(2);

        return view('web/order/detail', compact('products', 'order', 'itemOrder', 'productBestSell'))->with('quantity', $quantity)->with('totalMoney', $totalMoney)->with('quantityOrder', $quantityOrder)->with('totalMoneyOrder', $totalMoneyOrder);
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
    public function update($id)
    {
        $order = Order::find($id);
        $order->status = self::STATUS_ACTIVE;
        $order->save();

        return redirect()->route('indexOrder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search($inputName, $inputPhone, $inputEmail, $btnSearch)
    {
        $query = "";
        $orders = [];

        if (isset($inputName)) {
            $this->name = $inputName;
            if ($query == "") {
                $query .= " " . "customer_name like '%" . $inputName . "%'";
            } else {
                $query .= " AND " . "customer_name like '%" . $inputName . "%'";
            }
        }

        if (isset($inputPhone)) {
            $this->phone = $inputPhone;
            if ($query == "") {
                $query .= " " . "customer_phone like '%" . $inputPhone . "%'";
            } else {
                $query .= " AND " . "customer_phone like '%" . $inputPhone . "%'";
            }
        }

        if (isset($inputEmail)) {
            $this->email = $inputEmail;
            if ($query == "") {
                $query .= " " . "customer_email like '%" . $inputEmail . "%'";
            } else {
                $query .= " AND " . "customer_email like '%" . $inputEmail . "%'";
            }
        }

        if (isset($btnSearch)) {
            if (!isset($inputName) && !isset($inputPhone) && !isset($inputEmail)) {
                $orders = Order::orderBy('id', 'DESC')->get();
            } else {
                $orders = DB::select('SELECT * FROM orders WhERE ' . $query);
            }
        } else {
            $orders = Order::all();
        }

        return $orders;
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        $output = "";
        if ($data['action']) {
            if ($data['action'] == 'provinces') {
                $huyen = District::where('province_id', $data['id'])->get();
                $output .= '<option value="">---Select districts---</option>';
                foreach ($huyen as $h) {
                    $output .= '<option value="' . $h->id . '">' . $h->name . '</option>';
                }
            } else {
                $xa = Ward::where('district_id', $data['id'])->get();
                $output .= '<option value="">---Select wards---</option>';
                foreach ($xa as $x) {
                    $output .= '<option value="' . $x->id . '">' . $x->name . '</option>';
                }
            }
            echo $output;
        }
    }

    public function showbyId($id)
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $order = Order::find($id);
        $itemOrder = DB::select("SELECT * FROM orders join order_items on orders.id = order_items.order_id WHERE orders.customer_email like '%" . $order->customer_email . "%' and orders.id =" . $order->id);

        return view('admin/order/detail', compact('categories', 'brands', 'order', 'itemOrder'));
    }

    public function export(Request $request)
    {
        $orders = $this->search($request->name, $request->phone, $request->email, $request->status);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 3;

        $column = 0;

        $styleArrayTitle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $rowColor = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '2ed87a')
            )
        ];

        $sheet->setCellValue("D3", "Name");
        $sheet->setCellValue("E3", "Phone");
        $sheet->setCellValue("F3", "Email");
        $sheet->setCellValue("G3", "Total");
        $sheet->setCellValue("H3", "Amount");
        $sheet->setCellValue("I3", "Date");
        $sheet->setCellValue("J3", "Address");
        foreach ($orders as $item) {
            $i++;

            $column = $i;

            $sheet->setCellValue("D" . $i, $item->customer_name);
            $sheet->setCellValue("E" . $i, $item->customer_phone);
            $sheet->setCellValue("F" . $i, $item->customer_email);
            $sheet->setCellValue("G" . $i, $item->total_money);
            $sheet->setCellValue("H" . $i, $item->total_products);
            $sheet->setCellValue("I" . $i, $item->created_date);
            $sheet->setCellValue("J" . $i, $item->address);
        }

        $sheet->getStyle('D3:J3')->applyFromArray($styleArrayTitle);
        $sheet->getStyle('D4:J' . $column)->applyFromArray($styleArray);

        for ($row = 3; $row <= $column; $row++) {
            if ($row % 2 == 1) {
                $sheet->getStyle('D' . $row . ':J' . $row)->applyFromArray($rowColor);
            }
        }

        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"user_12-9.xlsx\"");
        header("Cache-Control: max-age=0");
        header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
        $writer->save("php://output");
    }
}