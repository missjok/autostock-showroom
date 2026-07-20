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
            <?php echo e(__('Tipe Mobil')); ?>

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

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Tipe Mobil</h3>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                        <a href="<?php echo e(route('categories.create')); ?>"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            + Tambah Tipe Mobil
                        </a>
                    <?php endif; ?>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Tipe Mobil</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3"><?php echo e($loop->iteration); ?></td>
                                <td class="p-3"><?php echo e($category->nama_kategori); ?></td>
                                <td class="p-3"><?php echo e($category->deskripsi ?? '-'); ?></td>
                                <td class="p-3 space-x-2">
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                        <a href="<?php echo e(route('categories.edit', $category)); ?>"
                                           class="text-blue-600 hover:underline">Edit</a>

                                        <form action="<?php echo e(route('categories.destroy', $category)); ?>"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                                <td colspan="4" class="p-3 text-center text-gray-500">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="mt-4">
                    <?php echo e($categories->links()); ?>

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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\car-stock\resources\views/categories/index.blade.php ENDPATH**/ ?>