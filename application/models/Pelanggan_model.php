<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    private $table = 'pelanggan';
    private $pk = 'id_pelanggan'; // Primary key

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_pelanggan() {
        $this->db->order_by($this->pk, 'DESC'); // Tampilkan data terbaru dulu
        return $this->db->get($this->table)->result();
    }

    public function get_pelanggan_by_id($id_pelanggan) {
        return $this->db->get_where($this->table, [$this->pk => $id_pelanggan])->row();
    }

    public function insert_pelanggan($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_pelanggan($id_pelanggan, $data) {
        $this->db->where($this->pk, $id_pelanggan);
        return $this->db->update($this->table, $data);
    }

    public function delete_pelanggan($id_pelanggan) {
        $this->db->where($this->pk, $id_pelanggan);
        return $this->db->delete($this->table);
    }
    public function is_pelanggan_in_use($id_pelanggan) {
        // Contoh pemeriksaan di tabel sales_orders
        // Sesuaikan nama tabel dan kolom foreign key jika berbeda
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('sales_orders'); // Ganti 'sales_orders' jika nama tabelnya berbeda
        if ($query->num_rows() > 0) {
            return true; // Pelanggan digunakan
        }
        return false;
    }
}