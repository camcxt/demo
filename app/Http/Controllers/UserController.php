<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;

    public function index()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $users = User::where('active', self::STATUS_ACTIVE)->where('permission', '=', self::STATUS_ACTIVE)->paginate(5);

        return view('admin/user/show', compact('users', 'categories', 'brands'));
    }

    public function create()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/user/add', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:brands',
            'email' => 'required|unique:users|email|string',
            'password' => 'required|min:8',
            'phone' => 'required|numeric'
        ], [
            'name.required' => 'Staff name has not been entered',
            'email.unique' => 'Email has been existed',
            'email.required' => 'Email has not been entered',
            'phone.numeric' => 'Phone is not number',
            'phone.required' => 'Phone has not been entered'
        ]);

        $data = [
            'username' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission' => self::STATUS_ACTIVE,
            'active' => self::STATUS_ACTIVE
        ];

        $staff = User::create($data);

        session()->flash('messageAdd', $staff->username . ' has been added.');
        return redirect()->route('indexUser');
    }

    public function edit($id)
    {
        // Get all Category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get all Brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get Staff
        $staff = User::find($id);

        return view('admin/user/update', compact('brands', 'categories', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'email' => 'required|email|string',
            'phone' => 'required|numeric'
        ], [
            'name.required' => 'Staff name has not been entered',
            'email.required' => 'Email has not been entered',
            'phone.numeric' => 'Phone is not number',
            'phone.required' => 'Phone has not been entered'
        ]);

        // Brand
        $staff = User::find($id);

        //update Brand
        $staff->username = $request->name;
        $staff->phone = $request->phone;
        $staff->email = $request->email;

        //save Brand
        $staff->save();

        session()->flash('messageUpdate', $staff->name . ' has been updated.');
        return redirect()->route('indexUser');
    }

    public function destroy($id)
    {
        $staff = User::find($id);

        //Check exist
        if (!isset($staff->id)) {
            return view('error');
        }

        $staff->delete();
        return redirect()->route('indexUser');
    }
}
