<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pelanggan_model');
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
        $data['title'] = 'Manajemen Pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_all_pelanggan();

        $this->load->view('Tamplates/header', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('Tamplates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Pelanggan Baru';

        $this->load->view('Tamplates/header', $data);
        $this->load->view('pelanggan/create', $data);
        $this->load->view('Tamplates/footer');
    }

    public function store() {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim');
        $this->form_validation->set_rules('alamat_pelanggan', 'Alamat', 'trim');
        $this->form_validation->set_rules('telepon_pelanggan', 'Nomor Telepon', 'trim|numeric|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->create(); 
        } else {
            $data_insert = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat_pelanggan' => $this->input->post('alamat_pelanggan'),
                'telepon_pelanggan' => $this->input->post('telepon_pelanggan')
            ];
            if ($this->Pelanggan_model->insert_pelanggan($data_insert)) {
                $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pelanggan.');
            }
            redirect('pelanggan');
        }
    }

    public function edit($id_pelanggan) {
        $data['title'] = 'Edit Pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_pelanggan_by_id($id_pelanggan);

        if (!$data['pelanggan']) {
            $this->session->set_flashdata('error', 'Pelanggan tidak ditemukan.');
            redirect('pelanggan');
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('pelanggan/edit', $data);
        $this->load->view('Tamplates/footer');
    }

    public function update($id_pelanggan) {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim');
        $this->form_validation->set_rules('alamat_pelanggan', 'Alamat', 'trim');
        $this->form_validation->set_rules('telepon_pelanggan', 'Nomor Telepon', 'trim|numeric|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_pelanggan); 
        } else {
            $data_update = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat_pelanggan' => $this->input->post('alamat_pelanggan'),
                'telepon_pelanggan' => $this->input->post('telepon_pelanggan')
            ];
            if ($this->Pelanggan_model->update_pelanggan($id_pelanggan, $data_update)) {
                $this->session->set_flashdata('success', 'Data pelanggan berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data pelanggan.');
            }
            redirect('pelanggan');
        }
    }

    public function delete($id_pelanggan) {
        if ($this->Pelanggan_model->is_pelanggan_in_use($id_pelanggan)) {
            $this->session->set_flashdata('error', 'Pelanggan tidak dapat dihapus karena masih ada transaksi.');
        } else {
            if ($this->Pelanggan_model->delete_pelanggan($id_pelanggan)) {
                $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus pelanggan.');
            }
        }
        redirect('pelanggan');
    }
}