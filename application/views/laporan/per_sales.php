<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <?= form_open(base_url('index.php/laporan/per_sales'), ['method' => 'get']); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sales Person:</label>
                                    <select name="id_sales_person" class="form-control select2" style="width: 100%;">
                                        <option value="">Semua Sales</option>
                                        <?php foreach($sales_persons_list as $sp): ?>
                                            <option value="<?= $sp->id_sales_person; ?>" <?= ($filter_id_sales_person == $sp->id_sales_person) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($sp->nama_sales, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Periode Tanggal:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control float-right" id="daterange-filter" name="daterange" value="<?= htmlspecialchars(isset($filter_daterange) ? $filter_daterange : '', ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
                                    <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['export' => 'pdf'])); ?>" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Laporan</h3>
                </div>
                <div class="card-body">
                    <table id="datatable-laporan" class="table table-bordered table-striped">
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
                            <?php $grand_total_all = 0; ?>
                            <?php if(!empty($report_data)): foreach($report_data as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row->nomor_order, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars(date('d M Y', strtotime($row->tanggal_order)), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_sales, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->nama_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row->jumlah, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>Rp <?= number_format($row->harga_saat_order, 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                                <?php $grand_total_all += $row->subtotal; ?>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="8" class="text-center">Tidak ada data untuk ditampilkan atau filter tanggal belum diatur.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <?php if(!empty($report_data)): ?>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-right">Grand Total:</th>
                                <th>Rp <?= number_format($grand_total_all, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({ theme: 'bootstrap4' });

    //Date range picker
    $('#daterange-filter').daterangepicker({
        opens: 'left',
        autoUpdateInput: false, // Important
         locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#daterange-filter').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#daterange-filter').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Inisialisasi DataTable jika diperlukan (tanpa tombol export default dari DataTable)
    // $('#datatable-laporan').DataTable({
    //   "paging": true,
    //   "lengthChange": true,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
});
</script>