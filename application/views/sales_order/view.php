<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>: <?= htmlspecialchars($order->nomor_order, ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/salesorder') ?>">Order</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header"><h3 class="card-title">Informasi Order</h3></div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Nomor Order</dt>
                                <dd class="col-sm-8">: <?= htmlspecialchars($order->nomor_order, ENT_QUOTES, 'UTF-8'); ?></dd>
                                <dt class="col-sm-4">Tanggal Order</dt>
                                <dd class="col-sm-8">: <?= htmlspecialchars(date('d M Y H:i', strtotime($order->tanggal_order)), ENT_QUOTES, 'UTF-8'); ?></dd>
                                <dt class="col-sm-4">Sales Person</dt>
                                <dd class="col-sm-8">: <?= htmlspecialchars($order->nama_sales, ENT_QUOTES, 'UTF-8'); ?> (<?= htmlspecialchars($order->kode_sales, ENT_QUOTES, 'UTF-8'); ?>)</dd>
                                <dt class="col-sm-4">Status Order</dt>
                                <dd class="col-sm-8">: <span class="badge badge-<?= $order->status_order == 'selesai' ? 'success' : ($order->status_order == 'dibatalkan' ? 'danger' : ($order->status_order == 'dikirim' ? 'info' : 'warning')) ?>"><?= ucfirst(htmlspecialchars($order->status_order, ENT_QUOTES, 'UTF-8')); ?></span></dd>
                                <dt class="col-sm-4">Catatan</dt>
                                <dd class="col-sm-8">: <?= !empty($order->catatan) ? nl2br(htmlspecialchars($order->catatan, ENT_QUOTES, 'UTF-8')) : '-'; ?></dd>
                            </dl>
                        </div>
                    </div>
                     <div class="card card-info">
                        <div class="card-header"><h3 class="card-title">Informasi Pelanggan</h3></div>
                        <div class="card-body">
                             <dl class="row">
                                <dt class="col-sm-4">Nama Pelanggan</dt>
                                <dd class="col-sm-8">: <?= htmlspecialchars($order->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></dd>
                                <dt class="col-sm-4">Alamat</dt>
                                <dd class="col-sm-8">: <?= nl2br(htmlspecialchars($order->alamat_pelanggan, ENT_QUOTES, 'UTF-8')); ?></dd>
                                <dt class="col-sm-4">Telepon</dt>
                                <dd class="col-sm-8">: <?= htmlspecialchars($order->telepon_pelanggan, ENT_QUOTES, 'UTF-8'); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-secondary">
                        <div class="card-header"><h3 class="card-title">Ubah Status Order</h3></div>
                        <div class="card-body">
                            <p>Status saat ini: <strong><?= ucfirst(htmlspecialchars($order->status_order, ENT_QUOTES, 'UTF-8')); ?></strong></p>
                            <?php if($order->status_order != 'selesai' && $order->status_order != 'dibatalkan'): ?>
                            <div class="btn-group">
                                <?php if($order->status_order == 'draft'): ?>
                                <a href="<?= base_url('index.php/salesorder/update_status/'.$order->id_sales_order.'/dikirim'); ?>" class="btn btn-info" onclick="return confirm('Anda yakin ingin mengubah status menjadi Dikirim?')">Tandai Dikirim</a>
                                <?php endif; ?>
                                <?php if($order->status_order == 'dikirim' || $order->status_order == 'draft'): ?>
                                <a href="<?= base_url('index.php/salesorder/update_status/'.$order->id_sales_order.'/selesai'); ?>" class="btn btn-success" onclick="return confirm('Anda yakin ingin mengubah status menjadi Selesai?')">Tandai Selesai</a>
                                <?php endif; ?>
                                <a href="<?= base_url('index.php/salesorder/update_status/'.$order->id_sales_order.'/dibatalkan'); ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin mengubah status menjadi Dibatalkan?')">Tandai Dibatalkan</a>
                            </div>
                            <?php else: ?>
                                <p>Order sudah <?= $order->status_order == 'selesai' ? 'selesai' : 'dibatalkan'; ?>.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Item Produk Dipesan</h3></div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga Saat Order</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; $grand_total_items = 0; ?>
                                    <?php foreach($order->items as $item): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($item->kode_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($item->nama_produk, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($item->jumlah, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>Rp <?= number_format($item->harga_saat_order, 2, ',', '.'); ?></td>
                                        <td>Rp <?= number_format($item->subtotal, 2, ',', '.'); ?></td>
                                    </tr>
                                    <?php $grand_total_items += $item->subtotal; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total Harga Order:</th>
                                        <th>Rp <?= number_format($order->total_harga, 2, ',', '.'); ?></th>
                                    </tr>
                                     <tr>
                                        <th colspan="5" class="text-right">Total Pendapatan:</th>
                                        <th>Rp <?= number_format($grand_total_items, 2, ',', '.'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <a href="<?= base_url('index.php/salesorder'); ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Order</a>
        </div>
    </section>
</div>