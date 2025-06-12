<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/laporan/per_produk') ?>">Laporan Penjualan Produk</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Filter yang Digunakan</h3>
                    <div class="card-tools">
                        <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['export' => 'pdf'])); ?>" class="btn btn-danger btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Export PDF</a>
                        <button type="button" class="btn btn-tool" onclick="window.print();"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Produk:</dt>
                        <dd class="col-sm-10">
                            <?php 
                                if (!empty($filter_id_produk)) {
                                    foreach($produk_list as $p) { // Gunakan $produk_list yang dikirim dari controller hasil
                                        if ($p->id_produk == $filter_id_produk) {
                                            echo htmlspecialchars($p->nama_produk, ENT_QUOTES, 'UTF-8') . " (".htmlspecialchars($p->kode_produk, ENT_QUOTES, 'UTF-8').")";
                                            break;
                                        }
                                    }
                                } else { echo "Semua Produk"; }
                            ?>
                        </dd>
                        <dt class="col-sm-2">Periode Tanggal:</dt>
                        <dd class="col-sm-10"><?= htmlspecialchars(date('d M Y', strtotime($filter_start_date)), ENT_QUOTES, 'UTF-8'); ?> s/d <?= htmlspecialchars(date('d M Y', strtotime($filter_end_date)), ENT_QUOTES, 'UTF-8'); ?></dd>
                    </dl>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Data Laporan</h3></div>
                <div class="card-body">
                    <table id="datatable-laporan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Total Jumlah Terjual</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grand_total_pendapatan = 0; ?>
                            <?php if(!empty($report_data)): foreach($report_data as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row->kode_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->total_jumlah_terjual, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>Rp <?= number_format($row->total_pendapatan_produk, 0, ',', '.'); ?></td>
                                <?php $grand_total_pendapatan += $row->total_pendapatan_produk; ?>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center">Tidak ada data untuk filter yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                         <?php if(!empty($report_data)): ?>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Grand Total Pendapatan:</th>
                                <th>Rp <?= number_format($grand_total_pendapatan, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Select2 tidak diperlukan di halaman hasil -->