<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:1980|max:' . (date('Y') + 1),
            'warna' => 'nullable|string|max:255',
            'no_polisi' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,terjual,booking',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Unit mobil berhasil ditambahkan.',
            'data' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'supplier']);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_barang' => 'sometimes|required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:1980|max:' . (date('Y') + 1),
            'warna' => 'nullable|string|max:255',
            'no_polisi' => 'nullable|string|max:255',
            'status' => 'sometimes|required|in:tersedia,terjual,booking',
            'category_id' => 'sometimes|required|exists:categories,id',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'stok' => 'sometimes|required|integer|min:0',
            'harga' => 'sometimes|required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Unit mobil berhasil diperbarui.',
            'data' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Unit mobil berhasil dihapus.',
        ]);
    }
}