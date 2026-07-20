<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Export daftar unit mobil ke PDF.
     */
    public function exportPdf()
    {
        $products = Product::with(['category', 'supplier'])->get();
        $pdf = Pdf::loadView('products.pdf', compact('products'));
        return $pdf->download('laporan-unit-mobil-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
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

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Unit mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
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

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Unit mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Unit mobil berhasil dihapus.');
    }
}