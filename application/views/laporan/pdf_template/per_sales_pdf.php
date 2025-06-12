<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
        .text-right { text-align: right; }
        .filter-info { margin-bottom: 15px; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

    <div class="filter-info">
        <?php if(!empty($filter_id_sales_person)): ?>
            <?php
                $selected_sales_name = "Semua Sales";
                foreach($sales_persons_list as $sp) {
                    if ($sp->id_sales_person == $filter_id_sales_person) {
                        $selected_sales_name = htmlspecialchars($sp->nama_sales, ENT_QUOTES, 'UTF-8');
                        break;
                    }
                }
            ?>
            <p><strong>Sales Person:</strong> <?= $selected_sales_name; ?></p>
        <?php endif; ?>
        <?php if(!empty($filter_start_date) && !empty($filter_end_date)): ?>
            <p><strong>Periode:</strong> <?= htmlspecialchars(date('d M Y', strtotime($filter_start_date)), ENT_QUOTES, 'UTF-8'); ?> s/d <?= htmlspecialchars(date('d M Y', strtotime($filter_end_date)), ENT_QUOTES, 'UTF-8'); ?></p>
        <?php elseif(!empty($filter_daterange_display)): // Fallback jika masih menggunakan daterange_display dari controller ?>
             <p><strong>Periode:</strong> <?= htmlspecialchars($filter_daterange_display, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php elseif(!empty($filter_daterange)): // Fallback jika masih menggunakan daterange dari controller (sebelumnya) ?>
             <p><strong>Periode:</strong> <?= htmlspecialchars($filter_daterange, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Order</th>
                <th>Tanggal</th>
                <th>Sales Person</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_total_all = 0; if(!empty($report_data)): foreach($report_data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row->nomor_order, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars(date('d M Y', strtotime($row->tanggal_order)), ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->nama_sales, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->nama_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->jumlah, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="text-right"><?= number_format($row->harga_saat_order, 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                <?php $grand_total_all += $row->subtotal; ?>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="8" style="text-align:center;">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
        <?php if(!empty($report_data)): ?>
        <tfoot>
            <tr>
                <th colspan="7" class="text-right">Grand Total:</th>
                <th class="text-right"><?= number_format($grand_total_all, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</body>
</html>