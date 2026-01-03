<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLine;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $productLines = ProductLine::all();
        return view('products.create', compact('productLines'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productCode' => 'required|string|max:15|unique:products',
            'productName' => 'required|string|max:70',
            'productLine' => 'nullable|string|max:50|exists:product_lines,productLine',
            'productScale' => 'nullable|string|max:10',
            'productVendor' => 'nullable|string|max:50',
            'productDescription' => 'nullable|string',
            'quantityInStock' => 'nullable|integer|min:0',
            'buyPrice' => 'nullable|numeric|min:0',
            'MSRP' => 'nullable|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $productLines = ProductLine::all();
        return view('products.edit', compact('product', 'productLines'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'productCode' => 'required|string|max:15|unique:products,productCode,' . $product->productCode . ',productCode',
            'productName' => 'required|string|max:70',
            'productLine' => 'nullable|string|max:50|exists:product_lines,productLine',
            'productScale' => 'nullable|string|max:10',
            'productVendor' => 'nullable|string|max:50',
            'productDescription' => 'nullable|string',
            'quantityInStock' => 'nullable|integer|min:0',
            'buyPrice' => 'nullable|numeric|min:0',
            'MSRP' => 'nullable|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
