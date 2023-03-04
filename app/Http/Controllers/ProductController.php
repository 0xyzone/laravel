<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlename = "Products";
        $products = Product::paginate(5, ['*'], 'products');
        // Show products page
        if(Auth::guest()){
            return redirect(route('viewLogin'));
        }
        return view('dashboard.products', compact('titlename', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titlename = 'Add Product';
        // Show create product page
        if(Auth::guest()){
            return redirect(route('viewLogin'));
        }
        return view('dashboard.createProduct', compact('titlename'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store Products
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('products', 'name')],
            'price' => 'required'
        ]);

        Product::create($formFields);

        return redirect(route('products'))->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $titlename = 'Edit Product';
        if(Auth::guest()){
            return redirect(route('viewLogin'));
        }
        return view('dashboard.editProduct', compact('product', 'titlename'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('products', 'name')->ignore($product->id)],
            'price' => 'required'
        ]);

        $product->update($formFields);

        return redirect(route('products'))->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products'))->with('success', 'Product deleted successfully');
    }
}
