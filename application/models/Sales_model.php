<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    private $table = 'sales_persons';
    private $pk = 'id_sales_person'; // Primary key

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_sales_persons() {
        $this->db->order_by($this->pk, 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get_sales_person_by_id($id_sales_person) {
        return $this->db->get_where($this->table, [$this->pk => $id_sales_person])->row();
    }

    public function insert_sales_person($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_sales_person($id_sales_person, $data) {
        $this->db->where($this->pk, $id_sales_person);
        return $this->db->update($this->table, $data);
    }

    public function delete_sales_person($id_sales_person) {
        $this->db->where($this->pk, $id_sales_person);
        return $this->db->delete($this->table);
    }
    public function is_sales_person_in_use($id_sales_person) {
        // Contoh pemeriksaan di tabel sales_orders
        // Sesuaikan nama tabel dan kolom foreign key jika berbeda
        $this->db->where('id_sales_person', $id_sales_person);
        $query = $this->db->get('sales_orders'); // Ganti 'sales_orders' jika nama tabelnya berbeda

        if ($query->num_rows() > 0) {
            return true; // Sales person digunakan
        }
        return false; // Sales person tidak digunakan
    }
}