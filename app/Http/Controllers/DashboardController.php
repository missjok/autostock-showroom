<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        $statusCounts = [
            'tersedia' => Product::where('status', 'tersedia')->count(),
            'booking' => Product::where('status', 'booking')->count(),
            'terjual' => Product::where('status', 'terjual')->count(),
        ];

        // Data grafik transaksi 7 hari terakhir
        $chartData = StockMovement::select(
                DB::raw('DATE(created_at) as tanggal'),
                'jenis',
                DB::raw('SUM(jumlah) as total')
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('tanggal', 'jenis')
            ->orderBy('tanggal')
            ->get();

        // Susun data grafik jadi format yang gampang dipakai Chart.js
        $labels = [];
        $masukData = [];
        $keluarData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d M');

            $masuk = $chartData->firstWhere(fn($item) => $item->tanggal == $date && $item->jenis == 'masuk');
            $keluar = $chartData->firstWhere(fn($item) => $item->tanggal == $date && $item->jenis == 'keluar');

            $masukData[] = $masuk ? $masuk->total : 0;
            $keluarData[] = $keluar ? $keluar->total : 0;
        }

        $data = [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalSuppliers' => $totalSuppliers,
            'statusCounts' => $statusCounts,
            'chartLabels' => $labels,
            'chartMasuk' => $masukData,
            'chartKeluar' => $keluarData,
        ];

        // Data tambahan khusus admin
        if (Auth::user()->hasRole('admin')) {
            $data['totalNilaiInventaris'] = Product::sum(DB::raw('harga * stok'));
        }

        return view('dashboard', $data);
    }
}