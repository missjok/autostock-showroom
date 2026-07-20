<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Unit Mobil</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #111827;
        }
        h1 {
            font-size: 18px;
            margin-bottom: 0;
        }
        p.subtitle {
            font-size: 11px;
            color: #6B7280;
            margin-top: 4px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #D1D5DB;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #F3F4F6;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            font-size: 11px;
        }
        .status-tersedia { color: #16A34A; font-weight: bold; }
        .status-booking { color: #CA8A04; font-weight: bold; }
        .status-terjual { color: #DC2626; font-weight: bold; }
        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #9CA3AF;
        }
    </style>
</head>
<body>
    <h1>Laporan Unit Mobil</h1>
    <p class="subtitle">Dicetak pada <?php echo e(now()->translatedFormat('d F Y, H:i')); ?> WIB</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Unit</th>
                <th>Merk</th>
                <th>Tahun</th>
                <th>Warna</th>
                <th>Tipe Mobil</th>
                <th>Dealer</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($product->nama_barang); ?></td>
                    <td><?php echo e($product->merk ?? '-'); ?></td>
                    <td><?php echo e($product->tahun ?? '-'); ?></td>
                    <td><?php echo e($product->warna ?? '-'); ?></td>
                    <td><?php echo e($product->category->nama_kategori ?? '-'); ?></td>
                    <td><?php echo e($product->supplier->nama_supplier ?? '-'); ?></td>
                    <td><?php echo e($product->stok); ?></td>
                    <td>Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></td>
                    <td class="status-<?php echo e($product->status); ?>"><?php echo e(ucfirst($product->status)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" style="text-align:center;">Belum ada data unit mobil.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p class="footer">Total unit mobil: <?php echo e($products->count()); ?></p>
</body>
</html><?php /**PATH C:\xampp\htdocs\car-stock\resources\views/products/pdf.blade.php ENDPATH**/ ?>