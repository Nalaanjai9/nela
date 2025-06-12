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
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/laporan/per_sales') ?>">Laporan Penjualan Sales</a></li>
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
                    <form action="<?= base_url('index.php/laporan/hasil_per_sales'); ?>" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sales Person:</label>
                                    <select name="id_sales_person" class="form-control select2" style="width: 100%;">
                                        <option value="">Semua Sales</option>
                                        <?php foreach($sales_persons_list as $sp): ?>
                                            <option value="<?= $sp->id_sales_person; ?>" <?= (isset($filter_id_sales_person) && $filter_id_sales_person == $sp->id_sales_person) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($sp->nama_sales, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Mulai:</label>
                                <input type="date" class="form-control" name="start_date" value="<?= htmlspecialchars(isset($filter_start_date) ? $filter_start_date :'', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Akhir:</label>
                                <input type="date" class="form-control" name="end_date" value="<?= htmlspecialchars(isset($filter_end_date) ? $filter_end_date :'', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan Laporan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({ theme: 'bootstrap4' });
});
</script>