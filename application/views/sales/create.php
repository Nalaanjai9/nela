<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Tambah Sales'; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/sales') ?>">Manajemen Sales</a></li>
                        <li class="breadcrumb-item active"><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Tambah Sales'; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Sales</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open('sales/store'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode_sales">ID Sales</label>
                                    <input type="text" class="form-control <?= (form_error('kode_sales')) ? 'is-invalid' : ''; ?>" id="kode_sales" name="kode_sales" placeholder="Masukkan ID Sales (Contoh: SALES001)" value="<?= set_value('kode_sales'); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('kode_sales'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_sales">Nama Sales</label>
                                    <input type="text" class="form-control <?= (form_error('nama_sales')) ? 'is-invalid' : ''; ?>" id="nama_sales" name="nama_sales" placeholder="Masukkan Nama Sales" value="<?= set_value('nama_sales'); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('nama_sales'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('index.php/sales'); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        <?= form_close(); ?>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->