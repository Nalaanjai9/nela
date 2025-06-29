<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/laporan') ?>">Laporan</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Filter Laporan</h3></div>
                <div class="card-body">
                    <?= form_open(base_url('index.php/laporan/per_periode'), ['method' => 'get']); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai:</label>
                                    <input type="date" class="form-control" name="start_date" value="<?= htmlspecialchars(isset($filter_start_date) ? $filter_start_date : '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Akhir:</label>
                                    <input type="date" class="form-control" name="end_date" value="<?= htmlspecialchars(isset($filter_end_date) ? $filter_end_date : '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
                                </div>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <div class="form-group">
                                    <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['export' => 'pdf'])); ?>" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Data Laporan</h3></div>
                <div class="card-body">
                    <table id="datatable-laporan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Sales Person</th>
                                <th>Total Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grand_total_all_orders = 0; ?>
                            <?php if(!empty($report_data)): foreach($report_data as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row->nomor_order, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars(date('d M Y H:i', strtotime($row->tanggal_order)), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_sales, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>Rp <?= number_format($row->total_order, 0, ',', '.'); ?></td>
                                <?php $grand_total_all_orders += $row->total_order; ?>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center">Tidak ada data untuk periode yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <?php if(!empty($report_data)): ?>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Grand Total Semua Order:</th>
                                <th>Rp <?= number_format($grand_total_all_orders, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script> $(function () { /* Jika ada Select2 atau JS lain, inisialisasikan di sini */ }); </script>