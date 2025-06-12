<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrder_model extends CI_Model {

    private $table_orders = 'sales_orders';
    private $pk_orders = 'id_sales_order';
    private $table_items = 'sales_order_items';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function generate_order_number() {
        $date_code = date('Ymd');
        $this->db->like('nomor_order', 'SO-' . $date_code, 'after');
        $this->db->select_max('nomor_order');
        $query = $this->db->get($this->table_orders);
        $last_number_obj = $query->row();

        $last_number_int = 0;
        if ($last_number_obj && $last_number_obj->nomor_order) {
            $parts = explode('-', $last_number_obj->nomor_order);
            $last_number_int = (int)end($parts);
        }
        $next_number = str_pad($last_number_int + 1, 4, '0', STR_PAD_LEFT);
        return 'SO-' . $date_code . '-' . $next_number;
    }

    public function insert_order($order_data, $items_data) {
        $this->db->trans_start();

        // Insert order header
        $this->db->insert($this->table_orders, $order_data);
        $order_id = $this->db->insert_id();

        // Insert order items
        if ($order_id && !empty($items_data)) {
            foreach ($items_data as &$item) { // Pass by reference to modify
                $item['id_sales_order'] = $order_id;
            }
            $this->db->insert_batch($this->table_items, $items_data);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return $order_id;
    }

    public function get_all_orders_with_details() {
        $this->db->select('so.*, p.nama_pelanggan, sp.nama_sales');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'so.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('sales_persons sp', 'so.id_sales_person = sp.id_sales_person', 'left');
        $this->db->order_by('so.tanggal_order', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_order_by_id_with_details($id_sales_order) {
        $this->db->select('so.*, p.nama_pelanggan, p.alamat_pelanggan, p.telepon_pelanggan, sp.nama_sales, sp.kode_sales');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'so.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('sales_persons sp', 'so.id_sales_person = sp.id_sales_person', 'left');
        $this->db->where('so.id_sales_order', $id_sales_order);
        $order = $this->db->get()->row();

        if ($order) {
            $this->db->select('soi.*, pr.nama_produk, pr.kode_produk');
            $this->db->from('sales_order_items soi');
            $this->db->join('produk pr', 'soi.id_produk = pr.id_produk', 'left');
            $this->db->where('soi.id_sales_order', $id_sales_order);
            $order->items = $this->db->get()->result();
        }
        return $order;
    }

    public function get_order_by_id($id_sales_order) {
        return $this->db->get_where($this->table_orders, [$this->pk_orders => $id_sales_order])->row();
    }

    public function update_order_status($id_sales_order, $status) {
        $this->db->where($this->pk_orders, $id_sales_order);
        return $this->db->update($this->table_orders, ['status_order' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    // Anda bisa menambahkan fungsi update dan delete order jika diperlukan
    // public function update_order($id_sales_order, $order_data, $items_data) { ... }
    // public function delete_order($id_sales_order) { ... }

    // Helper untuk mendapatkan data master
    public function get_all_pelanggan() {
        return $this->db->get('pelanggan')->result();
    }
    public function get_all_sales_persons() {
        return $this->db->get('sales_persons')->result();
    }
    public function get_all_active_produk() {
        // Anda mungkin ingin menambahkan filter produk yang aktif atau memiliki stok
        return $this->db->get('produk')->result();
    }

    // --- Metode untuk Laporan ---

    public function get_report_per_sales($id_sales_person = null, $start_date = null, $end_date = null) {
        $this->db->select('so.nomor_order, so.tanggal_order, p.nama_pelanggan, sp.nama_sales, pr.nama_produk, soi.jumlah, soi.harga_saat_order, soi.subtotal, so.status_order');
        $this->db->from('sales_orders so');
        $this->db->join('sales_order_items soi', 'so.id_sales_order = soi.id_sales_order');
        $this->db->join('pelanggan p', 'so.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('sales_persons sp', 'so.id_sales_person = sp.id_sales_person', 'left');
        $this->db->join('produk pr', 'soi.id_produk = pr.id_produk', 'left');

        if ($id_sales_person) {
            $this->db->where('so.id_sales_person', $id_sales_person);
        }
        if ($start_date) {
            $this->db->where('so.tanggal_order >=', $start_date . ' 00:00:00');
        }
        if ($end_date) {
            $this->db->where('so.tanggal_order <=', $end_date . ' 23:59:59');
        }
        $this->db->where_in('so.status_order', ['dikirim', 'selesai']); // Hanya order yang relevan untuk laporan penjualan
        $this->db->order_by('sp.nama_sales', 'ASC');
        $this->db->order_by('so.tanggal_order', 'ASC');
        return $this->db->get()->result();
    }

    public function get_report_per_product($id_produk = null, $start_date = null, $end_date = null) {
        $this->db->select('pr.nama_produk, pr.kode_produk, SUM(soi.jumlah) as total_jumlah_terjual, SUM(soi.subtotal) as total_pendapatan_produk, so.status_order');
        $this->db->from('sales_order_items soi');
        $this->db->join('sales_orders so', 'soi.id_sales_order = so.id_sales_order');
        $this->db->join('produk pr', 'soi.id_produk = pr.id_produk', 'left');

        if ($id_produk) {
            $this->db->where('soi.id_produk', $id_produk);
        }
        if ($start_date) {
            $this->db->where('so.tanggal_order >=', $start_date . ' 00:00:00');
        }
        if ($end_date) {
            $this->db->where('so.tanggal_order <=', $end_date . ' 23:59:59');
        }
        $this->db->where_in('so.status_order', ['dikirim', 'selesai']);
        $this->db->group_by('pr.id_produk, pr.nama_produk, pr.kode_produk');
        $this->db->order_by('pr.nama_produk', 'ASC');
        return $this->db->get()->result();
    }

    public function get_report_per_period($start_date, $end_date) {
        $this->db->select('so.nomor_order, so.tanggal_order, p.nama_pelanggan, sp.nama_sales, SUM(soi.subtotal) as total_order, so.status_order');
        $this->db->from('sales_orders so');
        $this->db->join('sales_order_items soi', 'so.id_sales_order = soi.id_sales_order', 'left'); // left join in case order has no items (should not happen)
        $this->db->join('pelanggan p', 'so.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('sales_persons sp', 'so.id_sales_person = sp.id_sales_person', 'left');
        $this->db->where('so.tanggal_order >=', $start_date . ' 00:00:00');
        $this->db->where('so.tanggal_order <=', $end_date . ' 23:59:59');
        $this->db->where_in('so.status_order', ['dikirim', 'selesai']);
        $this->db->group_by('so.id_sales_order');
        $this->db->order_by('so.tanggal_order', 'ASC');
        return $this->db->get()->result();
    }
}