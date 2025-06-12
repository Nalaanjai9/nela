<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') !== 'Admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Manajemen Produk';
        $data['produk'] = $this->Produk_model->get_all_produk();

        $this->load->view('Tamplates/header', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('Tamplates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Produk Baru';

        $this->load->view('Tamplates/header', $data);
        $this->load->view('produk/create', $data);
        $this->load->view('Tamplates/footer');
    }

    public function store() {
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|trim|is_unique[produk.kode_produk]');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('stok_produk', 'Stok Produk', 'required|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form create dengan pesan error
            $this->create();
        } else {
            // Jika validasi berhasil, lanjutkan proses penyimpanan data
            $data_insert = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga_produk' => $this->input->post('harga_produk'),
                'stok_produk' => $this->input->post('stok_produk')
            ];
            if ($this->Produk_model->insert_produk($data_insert)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan produk.');
            }
            redirect('produk');
        } // Akhir dari blok else
    }

    public function edit($id_produk) {
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        if (!$data['produk']) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            redirect('produk');
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('produk/edit', $data);
        $this->load->view('Tamplates/footer');
    }

    public function update($id_produk) {
        $produk_lama = $this->Produk_model->get_produk_by_id($id_produk);
        $kode_produk_rules = 'required|trim';
        if ($this->input->post('kode_produk') != $produk_lama->kode_produk) {
            $kode_produk_rules .= '|is_unique[produk.kode_produk]';
        }

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', $kode_produk_rules);
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('stok_produk', 'Stok Produk', 'required|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_produk); 
        } else {
            $data_update = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga_produk' => $this->input->post('harga_produk'),
                'stok_produk' => $this->input->post('stok_produk')
            ];
            if ($this->Produk_model->update_produk($id_produk, $data_update)) {
                $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui produk.');
            }
            redirect('produk');
        }
    }

    public function delete($id_produk) {
        if ($this->Produk_model->is_produk_in_use($id_produk)) {
            $this->session->set_flashdata('error', 'Produk masih digunakan dalam transaksi.');
        }else{
            if ($this->Produk_model->delete_produk($id_produk)) {
                $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus produk.');
            }
        }
        redirect('produk');
    }
}