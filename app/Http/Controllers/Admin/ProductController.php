<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Tenant\Product;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use UploadTrait;

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = Product::paginate(10);
        return view('tenant.admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('tenant.admin.products.create');
    }

    public function store(ProductRequest $request)
    {

        $product = Product::create($request->validated());

        if($request->hasFile('images')) {
            $images = $this->imageUpload($request->file('images'), 'path');
            $product->images()->createMany($images);
        }

        session()->flash('success', 'Produto inserido com sucesso!');
        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
