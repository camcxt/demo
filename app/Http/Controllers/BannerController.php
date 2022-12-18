<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;

class BannerController extends Controller
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
        //all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all banners
        $banners = Banner::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        return view('admin/banners/show', compact('banners', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/banners/add', compact('categories', 'brands'));
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
            'title' => 'required|unique:banners',
            'content' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'title.required' => 'Title has not been entered',
            'title.unique' => 'Title has been existed',
            'content.required' => 'Content has not been entered',
            'sortOrder.numeric' => 'Sort order is not number',
            'sortOrder.required' => 'Sort order has not been entered'
        ]);

        $imageName = "";
        if ($request->has('imageUrl')) {
            //upload image
            $image = $request->file('imageUrl');
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        } else {
            $imageName = "no-image.png";
        }

        //add data
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imageName,
            'sort_order' => $request->sortOrder,
            'active' => $request->acTive
        ];

        //create brand
        $banner = Banner::create($data);

        session()->flash('messageAdd', $banner->name.' has been added');
        return redirect()->route('indexBanners');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //find banner
        $banner = Banner::find($id);

        //check exist id
        if (!isset($banner->id)) {
            return view('error');
        }

        return view('admin/banners/update', compact('banner', 'categories', 'brands'));
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'title.required' => 'Title has not been entered',
            'content.required' => 'Content has not been entered',
            'sortOrder.numeric' => 'Sort order is not number',
            'sortOrder.required' => 'Sort order has not been entered'
        ]);

        //upload banner
        $imageName = "";
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        } else {
            $imageName = $request->imageOld;;
        }

        //find banner
        $banner = Banner::find($id);

        //upload banner
        $banner->title = $request->title;
        $banner->image_url = $imageName;
        $banner->content = $request->content;
        $banner->active = $request->acTive;
        $banner->sort_order = $request->sortOrder;

        //save banner
        $banner->save();

        session()->flash('messageUpdate', $banner->name.' has been update');
        return redirect()->route('indexBanners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find banner
        $banner = Banner::find($id);

        //check exist id
        if (!isset($banner->id)) {
            return view('error');
        }

        //update banner
        $banner->active = self::STATUS_DELETED;

        //save banner
        $banner->save();

        session()->flash('messageDelete', $banner->name.' has been deleted');
        return redirect()->route('indexBanners');
    }

    public function active(Request $request)
    {
        //find banner
        $banner = Banner::find($request->id);

        //update banner
        $banner->active = $request->status;

        //save banner
        $banner->save();

        echo ($request->status);
    }
}
