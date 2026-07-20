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
            <?php echo e(__('Riwayat Transaksi')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($error); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Transaksi Mobil Masuk/Keluar</h3>
                    <a href="<?php echo e(route('stock-movements.create')); ?>"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Transaksi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3">No</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Unit Mobil</th>
                                <th class="p-3">Jenis</th>
                                <th class="p-3">Jumlah</th>
                                <th class="p-3">Keterangan</th>
                                <th class="p-3">Dicatat Oleh</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $stockMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3"><?php echo e($loop->iteration); ?></td>
                                    <td class="p-3"><?php echo e($movement->created_at->format('d/m/Y H:i')); ?></td>
                                    <td class="p-3"><?php echo e($movement->product->nama_barang ?? '-'); ?></td>
                                    <td class="p-3">
                                        <?php if($movement->jenis === 'masuk'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Masuk</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Keluar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3"><?php echo e($movement->jumlah); ?></td>
                                    <td class="p-3"><?php echo e($movement->keterangan ?? '-'); ?></td>
                                    <td class="p-3"><?php echo e($movement->user->name ?? '-'); ?></td>
                                    <td class="p-3 space-x-2">
                                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                            <a href="<?php echo e(route('stock-movements.edit', $movement)); ?>"
                                               class="text-blue-600 hover:underline">Edit</a>

                                            <form action="<?php echo e(route('stock-movements.destroy', $movement)); ?>"
                                                  method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-sm">Tidak ada akses</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="p-3 text-center text-gray-500">
                                        Belum ada data transaksi.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <?php echo e($stockMovements->links()); ?>

                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\car-stock\resources\views/stock-movements/index.blade.php ENDPATH**/ ?>