<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SalesOrder_model');
        $this->load->model('Sales_model');
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        date_default_timezone_set('Asia/Jakarta');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') !== 'Manager') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            redirect('dashboard');
        }
    }

    public function index() {
        redirect('laporan/per_sales');
    }

    public function per_sales() {
        $data['title'] = 'Filter Laporan Penjualan Sales';
        $data['sales_persons_list'] = $this->Sales_model->get_all_sales_persons(); 
        $data['filter_id_sales_person'] = $this->input->get('id_sales_person');
        $data['filter_start_date'] = $this->input->get('start_date');
        $data['filter_end_date'] = $this->input->get('end_date');

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/form_per_sales', $data);
        $this->load->view('Tamplates/footer');
    }


    public function hasil_per_sales() {
        $data['title'] = 'Hasil Laporan Penjualan Sales';
        $data['sales_persons_list'] = $this->Sales_model->get_all_sales_persons(); 
        $data['report_data'] = [];


        $id_sales_person = $this->input->get('id_sales_person');
        $daterange = $this->input->get('daterange');
        $start_date = null;
        $end_date = null;

        
        $start_date_input = $this->input->get('start_date');
        $end_date_input = $this->input->get('end_date');

        if (empty($start_date_input) || empty($end_date_input)) {
            $start_date_input = date('Y-m-d'); 
            $end_date_input = date('Y-m-d');   
        }

        $data['report_data'] = $this->SalesOrder_model->get_report_per_sales($id_sales_person, $start_date_input, $end_date_input);
       
        $data['filter_id_sales_person'] = $id_sales_person;
        $data['filter_start_date'] = $start_date_input; 
        $data['filter_end_date'] = $end_date_input;   

        if ($this->input->get('export') === 'pdf') {
            $this->_export_to_pdf('laporan/pdf_template/per_sales_pdf', $data, 'Laporan_Penjualan_per_Sales.pdf');
            return;
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/hasil_per_sales', $data); 
        $this->load->view('Tamplates/footer');
    }

    public function per_produk() {
        $data['title'] = 'Filter Laporan Penjualan Produk';
        $data['produk_list'] = $this->Produk_model->get_all_produk(); 
        $data['filter_id_produk'] = $this->input->get('id_produk');
        $data['filter_start_date'] = $this->input->get('start_date');
        $data['filter_end_date'] = $this->input->get('end_date');

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/form_per_produk', $data);
        $this->load->view('Tamplates/footer');
    }

    public function hasil_per_produk() {
        $data['title'] = 'Hasil Laporan Penjualan Produk';
        $data['produk_list'] = $this->Produk_model->get_all_produk();
        $data['report_data'] = [];

        $id_produk = $this->input->get('id_produk');
        $start_date_input = $this->input->get('start_date');
        $end_date_input = $this->input->get('end_date');


        if (empty($start_date_input) || empty($end_date_input)) {
            $start_date_input = date('Y-m-d');
            $end_date_input = date('Y-m-d');
        }

        $data['report_data'] = $this->SalesOrder_model->get_report_per_product($id_produk, $start_date_input, $end_date_input);

        $data['filter_id_produk'] = $id_produk;
        $data['filter_start_date'] = $start_date_input;
        $data['filter_end_date'] = $end_date_input;
        $data['filter_daterange_display'] = (!empty($start_date_input) && !empty($end_date_input)) ? date('d/m/Y', strtotime($start_date_input)) . ' - ' . date('d/m/Y', strtotime($end_date_input)) : '';

        if ($this->input->get('export') === 'pdf') {
             $this->_export_to_pdf('laporan/pdf_template/per_produk_pdf', $data, 'Laporan_Penjualan_per_Produk.pdf');
            return;
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/hasil_per_produk', $data);
        $this->load->view('Tamplates/footer');
    }


    public function per_periode() {
        $data['title'] = 'Filter Laporan Penjualan Periode';
        $data['filter_start_date'] = $this->input->get('start_date');
        $data['filter_end_date'] = $this->input->get('end_date');

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/form_per_periode', $data);
        $this->load->view('Tamplates/footer');
    }


    public function hasil_per_periode() {
        $data['title'] = 'Hasil Laporan Penjualan Periode';
        $data['report_data'] = [];
        $start_date_input = $this->input->get('start_date');
        $end_date_input = $this->input->get('end_date');

        if (empty($start_date_input) || empty($end_date_input)) {
            $start_date_input = date('Y-m-d'); 
            $end_date_input = date('Y-m-d');   
        }

        $data['report_data'] = $this->SalesOrder_model->get_report_per_period($start_date_input, $end_date_input);
        
        $data['filter_start_date'] = $start_date_input;
        $data['filter_end_date'] = $end_date_input;
        $data['filter_daterange_display'] = date('d/m/Y', strtotime($start_date_input)) . ' - ' . date('d/m/Y', strtotime($end_date_input));

        if ($this->input->get('export') === 'pdf') {
            $this->_export_to_pdf('laporan/pdf_template/per_periode_pdf', $data, 'Laporan_Penjualan_per_Periode.pdf');
            return;
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('laporan/hasil_per_periode', $data);
        $this->load->view('Tamplates/footer');
    }

    private function _export_to_pdf($view_path, $data, $filename = 'Laporan.pdf') {
        $this->load->view($view_path, $data);
        echo "<script>window.print();</script>";

    }
}