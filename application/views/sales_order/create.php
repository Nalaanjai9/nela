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
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/salesorder') ?>">Sales Order</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?= form_open('salesorder/store', ['id' => 'form-sales-order']); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($this->session->flashdata('error_validation')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error Validasi!</strong><br><?= $this->session->flashdata('error_validation'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                     <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header"><h3 class="card-title">Informasi Order</h3></div>
                        <div class="card-body row">
                            <div class="form-group col-md-4">
                                <label for="nomor_order">Nomor Order</label>
                                <input type="text" class="form-control" id="nomor_order" name="nomor_order" value="<?= htmlspecialchars($nomor_order, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggal_order">Tanggal Order</label>
                                <input type="datetime-local" class="form-control <?= (form_error('tanggal_order')) ? 'is-invalid' : ''; ?>" id="tanggal_order" name="tanggal_order" value="<?= set_value('tanggal_order', date('Y-m-d\TH:i')); ?>">
                                <div class="invalid-feedback"><?= form_error('tanggal_order'); ?></div>
                            </div>
                             <div class="form-group col-md-4">
                                <label for="id_sales_person">Sales</label>
                                <select class="form-control select2 <?= (form_error('id_sales_person')) ? 'is-invalid' : ''; ?>" id="id_sales_person" name="id_sales_person" style="width: 100%;">
                                    <option value="">Pilih Sales</option>
                                    <?php foreach ($sales_persons_list as $sp): ?>
                                        <option value="<?= $sp->id_sales_person; ?>" <?= set_select('id_sales_person', $sp->id_sales_person); ?>><?= htmlspecialchars($sp->nama_sales, ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= form_error('id_sales_person'); ?></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_pelanggan">Pelanggan</label>
                                <select class="form-control select2 <?= (form_error('id_pelanggan')) ? 'is-invalid' : ''; ?>" id="id_pelanggan" name="id_pelanggan" style="width: 100%;">
                                    <option value="">Pilih Pelanggan</option>
                                    <?php foreach ($pelanggan_list as $p): ?>
                                        <option value="<?= $p->id_pelanggan; ?>" <?= set_select('id_pelanggan', $p->id_pelanggan); ?>><?= htmlspecialchars($p->nama_pelanggan, ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= form_error('id_pelanggan'); ?></div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="1"><?= set_value('catatan'); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header"><h3 class="card-title">Item Produk</h3></div>
                        <div class="card-body">
                            <table class="table table-bordered" id="table-order-items">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Produk</th>
                                        <th style="width: 15%;">Jumlah</th>
                                        <th style="width: 20%;">Harga Satuan</th>
                                        <th style="width: 20%;">Subtotal</th>
                                        <th style="width: 5%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="order-items-body">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                                        <td><input type="text" class="form-control" id="grand_total_display" readonly><input type="hidden" name="grand_total" id="grand_total"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="button" class="btn btn-success btn-sm mt-2" id="add-item-btn"><i class="fas fa-plus"></i> Tambah Item</button>
                             <input type="hidden" name="items_check" id="items_check_input"> 
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary float-right">Simpan Order</button>
                    <a href="<?= base_url('index.php/salesorder'); ?>" class="btn btn-secondary float-right mr-2">Batal</a>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkList = <?= json_encode($produk_list); ?>;
    const itemsBody = document.getElementById('order-items-body');
    const addItemBtn = document.getElementById('add-item-btn');
    const grandTotalDisplay = document.getElementById('grand_total_display');
    const grandTotalInput = document.getElementById('grand_total');
    const itemsCheckInput = document.getElementById('items_check_input');
    let itemCounter = 0;

    function addOrderItem() {
        itemCounter++;
        const row = itemsBody.insertRow();
        row.innerHTML = `
            <td>
                <select name="produk_id[]" class="form-control produk-select" required>
                    <option value="">Pilih Produk</option>
                    ${produkList.map(p => `<option value="${p.id_produk}" data-harga="${p.harga_produk}">${p.nama_produk} (Stok: ${p.stok_produk})</option>`).join('')}
                </select>
                <input type="hidden" name="harga[]" class="harga-input">
            </td>
            <td><input type="number" name="jumlah[]" class="form-control jumlah-input" min="1" value="1" step="1" required></td>
            <td><input type="text" class="form-control harga-display" readonly></td>
            <td><input type="text" class="form-control subtotal-display" readonly><input type="hidden" name="subtotal[]" class="subtotal-input"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-item-btn"><i class="fas fa-trash"></i></button></td>
        `;
        updateItemsCheck();
    }

    function updateRowCalculations(row) {
        const produkSelect = row.querySelector('.produk-select');
        const jumlahInput = row.querySelector('.jumlah-input');
        const hargaInput = row.querySelector('.harga-input');
        const hargaDisplay = row.querySelector('.harga-display');
        const subtotalDisplay = row.querySelector('.subtotal-display');

        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        const harga = parseFloat(selectedOption.dataset.harga) || 0;
        const jumlah = parseInt(jumlahInput.value) || 0;

        hargaInput.value = harga.toFixed(2);
        hargaDisplay.value = 'Rp ' + harga.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        const subtotal = harga * jumlah;
        subtotalDisplay.value = 'Rp ' + subtotal.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        // Update hidden subtotal input if you need to send raw number
        // For now, the controller will recalculate based on produk_id, jumlah, and harga
        // Or, you can add another hidden input for raw subtotal

        updateGrandTotal();
    }

    function updateGrandTotal() {
        let total = 0;
        itemsBody.querySelectorAll('tr').forEach(row => {
            const produkSelect = row.querySelector('.produk-select');
            const jumlahInput = row.querySelector('.jumlah-input');
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            if (selectedOption && selectedOption.value) {
                 const harga = parseFloat(selectedOption.dataset.harga) || 0;
                 const jumlah = parseInt(jumlahInput.value) || 0;
                 total += harga * jumlah;
            }
        });
        grandTotalDisplay.value = 'Rp ' + total.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        grandTotalInput.value = total.toFixed(2);
    }

    function updateItemsCheck() {
        itemsCheckInput.value = itemsBody.rows.length > 0 ? 'filled' : '';
    }

    addItemBtn.addEventListener('click', addOrderItem);

    itemsBody.addEventListener('change', function(e) {
        if (e.target.classList.contains('produk-select') || e.target.classList.contains('jumlah-input')) {
            updateRowCalculations(e.target.closest('tr'));
        }
    });

    itemsBody.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item-btn')) {
            e.target.closest('tr').remove();
            updateGrandTotal();
            updateItemsCheck();
        }
    });

    // Initialize with one item row
    addOrderItem();

    // Initialize Select2
    $('.select2').select2({ theme: 'bootstrap4' });
});
</script>