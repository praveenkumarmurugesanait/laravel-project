<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products in Blade
    public function index()
        {
            $products = Product::all();
            return view('products.index', compact('products'));
        }

    // Store new product
    public function store(Request $request)
    {
        $product = Product::create($request->only(['name','price','description']));
        return response()->json($product, 201);
    }

    // Show single product
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->only(['name','price','description']));
        return response()->json($product);
    }

    // Delete product
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(null, 204);
    }
}
