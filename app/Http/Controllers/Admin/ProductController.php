<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
