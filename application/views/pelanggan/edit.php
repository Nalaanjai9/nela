<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Edit Pelanggan'; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/pelanggan') ?>">Manajemen Pelanggan</a></li>
                        <li class="breadcrumb-item active"><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Edit Pelanggan'; ?></li>
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
                    <div class="card card-warning"> <!-- Warna card untuk edit -->
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Pelanggan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open('pelanggan/update/' . $pelanggan->id_pelanggan); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <input type="text" class="form-control <?= (form_error('nama_pelanggan')) ? 'is-invalid' : ''; ?>" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" value="<?= set_value('nama_pelanggan', $pelanggan->nama_pelanggan); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('nama_pelanggan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_pelanggan">Alamat</label>
                                    <textarea class="form-control <?= (form_error('alamat_pelanggan')) ? 'is-invalid' : ''; ?>" id="alamat_pelanggan" name="alamat_pelanggan" rows="3" placeholder="Masukkan Alamat Pelanggan"><?= set_value('alamat_pelanggan', $pelanggan->alamat_pelanggan); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('alamat_pelanggan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telepon_pelanggan">Nomor Telepon</label>
                                    <input type="text" class="form-control <?= (form_error('telepon_pelanggan')) ? 'is-invalid' : ''; ?>" id="telepon_pelanggan" name="telepon_pelanggan" placeholder="Masukkan Nomor Telepon (Contoh: 08123456789)" value="<?= set_value('telepon_pelanggan', $pelanggan->telepon_pelanggan); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('telepon_pelanggan'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="<?= base_url('index.php/pelanggan'); ?>" class="btn btn-secondary">Batal</a>
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