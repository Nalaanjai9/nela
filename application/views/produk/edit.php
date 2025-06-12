<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Edit Produk'; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li> <!-- Sesuaikan dengan URL dashboard Anda -->
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/produk') ?>">Manajemen Produk</a></li>
                        <li class="breadcrumb-item active"><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Edit Produk'; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8"> <!-- Atur lebar kolom form -->
                    <div class="card card-warning"> <!-- Ganti warna card untuk edit -->
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open('produk/update/' . $produk->id_produk); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode_produk">Kode Produk</label>
                                    <input type="text" class="form-control <?= (form_error('kode_produk')) ? 'is-invalid' : ''; ?>" id="kode_produk" name="kode_produk" placeholder="Masukkan Kode Produk" value="<?= set_value('kode_produk', $produk->kode_produk); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('kode_produk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control <?= (form_error('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" value="<?= set_value('nama_produk', $produk->nama_produk); ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('nama_produk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="harga_produk">Harga Produk</label>
                                    <input type="number" class="form-control <?= (form_error('harga_produk')) ? 'is-invalid' : ''; ?>" id="harga_produk" name="harga_produk" placeholder="Masukkan Harga (Contoh: 50000)" value="<?= set_value('harga_produk', $produk->harga_produk); ?>" min="0">
                                    <div class="invalid-feedback">
                                        <?= form_error('harga_produk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stok_produk">Stok Produk</label>
                                    <input type="number" class="form-control <?= (form_error('stok_produk')) ? 'is-invalid' : ''; ?>" id="stok_produk" name="stok_produk" placeholder="Masukkan Jumlah Stok" value="<?= set_value('stok_produk', $produk->stok_produk); ?>" min="0">
                                    <div class="invalid-feedback">
                                        <?= form_error('stok_produk'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="<?= base_url('index.php/produk'); ?>" class="btn btn-secondary">Batal</a>
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