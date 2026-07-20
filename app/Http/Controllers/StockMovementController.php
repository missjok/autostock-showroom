<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockMovements = StockMovement::with(['product', 'user'])->latest()->paginate(10);
        return view('stock-movements.index', compact('stockMovements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('stock-movements.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        // Simpan transaksi
        StockMovement::create($validated);

        // Update stok produk otomatis
        $product = Product::findOrFail($validated['product_id']);
        if ($validated['jenis'] === 'masuk') {
            $product->increment('stok', $validated['jumlah']);
        } else {
            // Cegah stok minus
            if ($product->stok < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi untuk transaksi keluar.'])->withInput();
            }
            $product->decrement('stok', $validated['jumlah']);

            // Kalau stok jadi 0 setelah dikurangi, otomatis ubah status jadi "terjual"
            if ($product->fresh()->stok == 0) {
                $product->update(['status' => 'terjual']);
            }
        }

        return redirect()->route('stock-movements.index')
            ->with('success', 'Transaksi berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stockMovement)
    {
        return view('stock-movements.show', compact('stockMovement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stockMovement)
    {
        $products = Product::all();
        return view('stock-movements.edit', compact('stockMovement', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockMovement $stockMovement)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $stockMovement->update($validated);

        return redirect()->route('stock-movements.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockMovement $stockMovement)
    {
        $stockMovement->delete();

        return redirect()->route('stock-movements.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}