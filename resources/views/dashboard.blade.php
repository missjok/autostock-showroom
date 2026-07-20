<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400">Selamat datang</p>
                <h1 class="text-2xl font-semibold text-gray-900 mt-1">{{ Auth::user()->name }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    @role('admin')
                        Ringkasan penuh operasional showroom hari ini.
                    @else
                        Ringkasan stok dan transaksi hari ini.
                    @endrole
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200 rounded-lg overflow-hidden">
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Unit Mobil</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Tipe Mobil</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2">{{ $totalCategories }}</p>
                </div>
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Dealer</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2">{{ $totalSuppliers }}</p>
                </div>

                @if (isset($totalNilaiInventaris))
                    <div class="bg-white p-6">
                        <p class="text-xs uppercase tracking-widest text-gray-400">Nilai Inventaris</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-2">Rp {{ number_format($totalNilaiInventaris, 0, ',', '.') }}</p>
                    </div>
                @else
                    <div class="bg-white p-6">
                        <p class="text-xs uppercase tracking-widest text-gray-400">Transaksi Minggu Ini</p>
                        <p class="text-4xl font-semibold text-gray-900 mt-2">{{ array_sum($chartMasuk) + array_sum($chartKeluar) }}</p>
                    </div>
                @endif
            </div>

            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">Status unit mobil</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Tersedia</p>
                            <p class="text-xl font-semibold text-gray-900">{{ $statusCounts['tersedia'] }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Booking</p>
                            <p class="text-xl font-semibold text-gray-900">{{ $statusCounts['booking'] }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Terjual</p>
                            <p class="text-xl font-semibold text-gray-900">{{ $statusCounts['terjual'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-4">Transaksi masuk / keluar — 7 hari terakhir</p>
                <canvas id="stockChart" height="90"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    { label: 'Masuk', data: @json($chartMasuk), backgroundColor: '#111827', borderRadius: 3 },
                    { label: 'Keluar', data: @json($chartKeluar), backgroundColor: '#D1D5DB', borderRadius: 3 }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { labels: { color: '#6B7280' } } },
                scales: {
                    x: { ticks: { color: '#9CA3AF' }, grid: { display: false } },
                    y: { beginAtZero: true, ticks: { stepSize: 1, color: '#9CA3AF' }, grid: { color: '#F3F4F6' } }
                }
            }
        });
    </script>
</x-app-layout>