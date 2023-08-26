<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['store']]);
        $this->middleware('permission:product-edit', ['only' => ['update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        $products = Product::all()->sortBy('product_name');
        $sections = Section::all();
        $prod_num = Product::get()->count();

        return view("products.index", compact('products','sections','prod_num'));
    }

    public function create()
    {
        //
    }

    public function store(StoreProductRequest $request)
    {

        Product::create([
            'product_name' => $request->product_name,
            "description" => $request->description,
            "section_id" => $request->section_id,
        ]);
        session()->flash('created', 'تمت اضافة المنتج  '.$request->product_name.' بنجاح ');

        return redirect()->back();
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(updateProductRequest $request)
    {
        $product = Product::findOrFail($request->id)->first();
        $section = Section::where('section_name',$request->section_name)->pluck('id');

        $product->update([
            'product_name' => $request->product_name,
            "description" => $request->description,
            "section_id" => $section[0],
        ]);

        session()->flash('updated', 'تم تعديل المنتج  '.$request->product_name.' بنجاح ');

        return   redirect()->back();
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();

        session()->flash('deleted', 'تم حدف المنتج  '.$request->product_name.' بنجاح ');
        return   redirect()->back();
    }
}
