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
                        <li class="breadcrumb-item active"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Semua Order</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('index.php/salesorder/create') ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Buat Order Baru
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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

                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No. Order</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Sales</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($orders)): ?>
                                        <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order->nomor_order, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars(date('d M Y H:i', strtotime($order->tanggal_order)), ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars($order->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars($order->nama_sales, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>Rp <?= number_format($order->total_harga, 2, ',', '.'); ?></td>
                                            <td><span class="badge badge-<?= $order->status_order == 'selesai' ? 'success' : ($order->status_order == 'dibatalkan' ? 'danger' : ($order->status_order == 'dikirim' ? 'info' : 'warning')) ?>"><?= ucfirst(htmlspecialchars($order->status_order, ENT_QUOTES, 'UTF-8')); ?></span></td>
                                            <td>
                                                <a href="<?= base_url('index.php/salesorder/view/' . $order->id_sales_order); ?>" class="btn btn-info btn-xs"><i class="fas fa-eye"></i> View</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="7" class="text-center">Belum ada sales order.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>