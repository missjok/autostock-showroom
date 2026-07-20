<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400">Selamat datang</p>
                <h1 class="text-2xl font-semibold text-gray-900 mt-1"><?php echo e(Auth::user()->name); ?></h1>
                <p class="text-sm text-gray-500 mt-1">
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                        Ringkasan penuh operasional showroom hari ini.
                    <?php else: ?>
                        Ringkasan stok dan transaksi hari ini.
                    <?php endif; ?>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200 rounded-lg overflow-hidden">
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Unit Mobil</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2"><?php echo e($totalProducts); ?></p>
                </div>
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Tipe Mobil</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2"><?php echo e($totalCategories); ?></p>
                </div>
                <div class="bg-white p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400">Dealer</p>
                    <p class="text-4xl font-semibold text-gray-900 mt-2"><?php echo e($totalSuppliers); ?></p>
                </div>

                <?php if(isset($totalNilaiInventaris)): ?>
                    <div class="bg-white p-6">
                        <p class="text-xs uppercase tracking-widest text-gray-400">Nilai Inventaris</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-2">Rp <?php echo e(number_format($totalNilaiInventaris, 0, ',', '.')); ?></p>
                    </div>
                <?php else: ?>
                    <div class="bg-white p-6">
                        <p class="text-xs uppercase tracking-widest text-gray-400">Transaksi Minggu Ini</p>
                        <p class="text-4xl font-semibold text-gray-900 mt-2"><?php echo e(array_sum($chartMasuk) + array_sum($chartKeluar)); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">Status unit mobil</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Tersedia</p>
                            <p class="text-xl font-semibold text-gray-900"><?php echo e($statusCounts['tersedia']); ?></p>
                        </div>
                    </div>
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Booking</p>
                            <p class="text-xl font-semibold text-gray-900"><?php echo e($statusCounts['booking']); ?></p>
                        </div>
                    </div>
                    <div class="bg-white p-5 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 shrink-0"></span>
                        <div>
                            <p class="text-sm text-gray-500">Terjual</p>
                            <p class="text-xl font-semibold text-gray-900"><?php echo e($statusCounts['terjual']); ?></p>
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
                labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
                datasets: [
                    { label: 'Masuk', data: <?php echo json_encode($chartMasuk, 15, 512) ?>, backgroundColor: '#111827', borderRadius: 3 },
                    { label: 'Keluar', data: <?php echo json_encode($chartKeluar, 15, 512) ?>, backgroundColor: '#D1D5DB', borderRadius: 3 }
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gudang-pisang\resources\views/dashboard.blade.php ENDPATH**/ ?>