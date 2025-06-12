<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sales_model');
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
        $data['title'] = 'Manajemen Sales';
        $data['sales_persons'] = $this->Sales_model->get_all_sales_persons();

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales/index', $data);
        $this->load->view('Tamplates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Sales Baru';

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales/create', $data);
        $this->load->view('Tamplates/footer');
    }

    public function store() {
        $this->form_validation->set_rules('kode_sales', 'ID Sales Person', 'required|trim|is_unique[sales_persons.kode_sales]');
        $this->form_validation->set_rules('nama_sales', 'Nama Sales Person', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data_insert = [
                'kode_sales' => $this->input->post('kode_sales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];
            if ($this->Sales_model->insert_sales_person($data_insert)) {
                $this->session->set_flashdata('success', 'Sales person berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan sales person.');
            }
            redirect('sales');
        }
    }

    public function edit($id_sales_person) {
        $data['title'] = 'Edit Sales';
        $data['sales_person'] = $this->Sales_model->get_sales_person_by_id($id_sales_person);

        if (!$data['sales_person']) {
            $this->session->set_flashdata('error', 'Sales person tidak ditemukan.');
            redirect('sales');
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales/edit', $data);
        $this->load->view('Tamplates/footer');
    }

    public function update($id_sales_person) {
        $sales_person_lama = $this->Sales_model->get_sales_person_by_id($id_sales_person);
        $kode_sales_rules = 'required|trim';
        if ($this->input->post('kode_sales') != $sales_person_lama->kode_sales) {
            $kode_sales_rules .= '|is_unique[sales_persons.kode_sales]';
        }

        $this->form_validation->set_rules('kode_sales', 'ID Sales Person', $kode_sales_rules);
        $this->form_validation->set_rules('nama_sales', 'Nama Sales Person', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_sales_person);
        } else {
            $data_update = [
                'kode_sales' => $this->input->post('kode_sales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];
            if ($this->Sales_model->update_sales_person($id_sales_person, $data_update)) {
                $this->session->set_flashdata('success', 'Data sales person berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data sales person.');
            }
            redirect('sales');
        }
    }

    public function delete($id_sales_person) {
        if ($this->Sales_model->is_sales_person_in_use($id_sales_person)) {
            $this->session->set_flashdata('error', 'Sales tidak dapat dihapus karena masih ada transaksi');
        } else {
            if ($this->Sales_model->delete_sales_person($id_sales_person)) {
                $this->session->set_flashdata('success', 'Sales person berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus sales person.');
            }
        }
        redirect('sales');
    }
}