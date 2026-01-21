<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackagingMaterial;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display list of all products
    public function list()
    {
        $allProducts = Product::all();
        return view('pages.product.list', compact('allProducts'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        $packagingMaterials = PackagingMaterial::all();
        return view('pages.product.create', compact('categories', 'packagingMaterials'));
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'product_stock' => 'required|integer|min:0',
            'product_description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'packaging_materials' => 'nullable|array',
            'packaging_materials.*' => 'exists:packaging_materials,id',
            'material_quantities.*' => 'nullable|numeric|min:0',
        ]);

        $product = Product::create([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'stock' => $request->product_stock,
            'description' => $request->product_description,
            'status' => $request->status,
        ]);

        // Attach packaging materials
        if ($request->has('packaging_materials') && !empty($request->packaging_materials)) {
            foreach ($request->packaging_materials as $index => $materialId) {
                $quantity = $request->material_quantities[$index] ?? 0;
                $product->packagingMaterials()->attach($materialId, [
                    'quantity_per_unit' => $quantity
                ]);
            }
        }

        return redirect()->route('products.list')->with('success', 'Product created successfully!');
    }

    // Show single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $category = $product->category()->first();
        $packagingMaterials = $product->packagingMaterials()->get();
        return view('pages.product.show', compact('product', 'category', 'packagingMaterials'));
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $packagingMaterials = PackagingMaterial::all();
        $assignedMaterials = $product->packagingMaterials()->pluck('packaging_material_id')->toArray();
        return view('pages.product.edit', compact('product', 'categories', 'packagingMaterials', 'assignedMaterials'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'product_stock' => 'required|integer|min:0',
            'product_description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'packaging_materials' => 'nullable|array',
            'packaging_materials.*' => 'exists:packaging_materials,id',
            'material_quantities.*' => 'nullable|numeric|min:0',
        ]);

        $product->update([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'stock' => $request->product_stock,
            'description' => $request->product_description,
            'status' => $request->status,
        ]);

        // Sync packaging materials
        $syncData = [];
        if ($request->has('packaging_materials') && !empty($request->packaging_materials)) {
            foreach ($request->packaging_materials as $index => $materialId) {
                $quantity = $request->material_quantities[$index] ?? 0;
                $syncData[$materialId] = ['quantity_per_unit' => $quantity];
            }
        }
        $product->packagingMaterials()->sync($syncData);

        return redirect()->route('products.list')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->packagingMaterials()->detach();
        $product->delete();

        return redirect()->route('products.list')->with('success', 'Product deleted successfully!');
    }
}

