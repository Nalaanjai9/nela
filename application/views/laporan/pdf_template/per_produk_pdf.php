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
        <?php if(!empty($filter_id_produk)): ?>
            <?php
                $selected_produk_name = "Semua Produk";
                foreach($produk_list as $p) { // Asumsi $produk_list dikirim dari controller
                    if ($p->id_produk == $filter_id_produk) {
                        $selected_produk_name = htmlspecialchars($p->nama_produk, ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($p->kode_produk, ENT_QUOTES, 'UTF-8') . ")";
                        break;
                    }
                }
            ?>
            <p><strong>Produk:</strong> <?= $selected_produk_name; ?></p>
        <?php endif; ?>
        <?php if(!empty($filter_start_date) && !empty($filter_end_date)): ?>
            <p><strong>Periode:</strong> <?= htmlspecialchars(date('d M Y', strtotime($filter_start_date)), ENT_QUOTES, 'UTF-8'); ?> s/d <?= htmlspecialchars(date('d M Y', strtotime($filter_end_date)), ENT_QUOTES, 'UTF-8'); ?></p>
        <?php elseif(!empty($filter_daterange_display)): ?>
             <p><strong>Periode:</strong> <?= htmlspecialchars($filter_daterange_display, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Total Jumlah Terjual</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_total_pendapatan = 0; if(!empty($report_data)): foreach($report_data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row->kode_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->nama_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->total_jumlah_terjual, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="text-right">Rp <?= number_format($row->total_pendapatan_produk, 0, ',', '.'); ?></td>
                <?php $grand_total_pendapatan += $row->total_pendapatan_produk; ?>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="4" style="text-align:center;">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
        <?php if(!empty($report_data)): ?>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Grand Total Pendapatan:</th>
                <th class="text-right">Rp <?= number_format($grand_total_pendapatan, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</body>
</html>