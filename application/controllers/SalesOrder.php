<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SalesOrder_model');
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        date_default_timezone_set('Asia/Jakarta'); 


        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') !== 'Sales') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Daftar Order';
        $data['orders'] = $this->SalesOrder_model->get_all_orders_with_details();

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales_order/index', $data);
        $this->load->view('Tamplates/footer');
    }

    public function create() {
        $data['title'] = 'Buat Order Baru';
        $data['nomor_order'] = $this->SalesOrder_model->generate_order_number();
        $data['pelanggan_list'] = $this->SalesOrder_model->get_all_pelanggan();
        $data['sales_persons_list'] = $this->SalesOrder_model->get_all_sales_persons();
        $data['produk_list'] = $this->SalesOrder_model->get_all_active_produk(); 

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales_order/create', $data);
        $this->load->view('Tamplates/footer');
    }

    public function store() {
        $this->form_validation->set_rules('nomor_order', 'Nomor Order', 'required|trim|is_unique[sales_orders.nomor_order]');
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required|integer');
        $this->form_validation->set_rules('id_sales_person', 'Sales Person', 'required|integer');
        $this->form_validation->set_rules('tanggal_order', 'Tanggal Order', 'required');
        if (empty($this->input->post('produk_id'))) {
            $this->form_validation->set_rules('items_check', 'Item Produk', 'required', ['required' => 'Minimal harus ada 1 produk dalam order.']);
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_validation', validation_errors());
            $this->create();
        } else {
            $order_data = [
                'nomor_order' => $this->input->post('nomor_order'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_sales_person' => $this->input->post('id_sales_person'),
                'tanggal_order' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_order'))),
                'total_harga' => $this->input->post('grand_total'),
                'status_order' => 'draft', 
                'catatan' => $this->input->post('catatan')
            ];

            $items_data = [];
            $produk_ids = $this->input->post('produk_id');
            $jumlahs = $this->input->post('jumlah');
            $hargas = $this->input->post('harga');

            if (!empty($produk_ids)) {
                for ($i = 0; $i < count($produk_ids); $i++) {
                    if (!empty($produk_ids[$i]) && !empty($jumlahs[$i]) && $jumlahs[$i] > 0) {
                        $items_data[] = [
                            'id_produk' => $produk_ids[$i],
                            'jumlah' => (int)$jumlahs[$i], 
                            'harga_saat_order' => (float)$hargas[$i], 
                            'subtotal' => (int)$jumlahs[$i] * (float)$hargas[$i] 
                        ];
                    }
                }
            }

            if (empty($items_data)) {
                 $this->session->set_flashdata('error', 'Gagal membuat order. Tidak ada item produk yang valid.');
                 redirect('salesorder/create');
                 return;
            }

            $order_id = $this->SalesOrder_model->insert_order($order_data, $items_data);

            if ($order_id) {
                foreach ($items_data as $item) {
                    $this->Produk_model->kurangi_stok($item['id_produk'], $item['jumlah']);
                }
                $this->session->set_flashdata('success', 'Sales order berhasil dibuat dengan nomor: ' . $order_data['nomor_order']);
                redirect('salesorder/view/' . $order_id);
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat sales order.');
                $this->create();
            }
        }
    }

    public function view($id_sales_order) {
        $data['title'] = 'Detail Order';
        $data['order'] = $this->SalesOrder_model->get_order_by_id_with_details($id_sales_order);

        if (!$data['order']) {
            $this->session->set_flashdata('error', 'Order tidak ditemukan.');
            redirect('salesorder');
        }

        $this->load->view('Tamplates/header', $data);
        $this->load->view('sales_order/view', $data);
        $this->load->view('Tamplates/footer');
    }

    public function get_produk_detail_json($id_produk) {
        header('Content-Type: application/json');
        $produk = $this->Produk_model->get_produk_by_id($id_produk);
        if ($produk) {
            echo json_encode(['success' => true, 'harga' => $produk->harga_produk, 'stok' => $produk->stok_produk, 'nama' => $produk->nama_produk]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan.']);
        }
    }

    public function update_status($id_sales_order, $status) {
        $allowed_status = ['draft', 'dikirim', 'selesai', 'dibatalkan'];
        if (!in_array($status, $allowed_status)) {
            $this->session->set_flashdata('error', 'Status order tidak valid.');
            redirect('salesorder/view/' . $id_sales_order);
            return;
        }

        if ($this->SalesOrder_model->update_order_status($id_sales_order, $status)) {
            $this->session->set_flashdata('success', 'Status order berhasil diperbarui menjadi ' . ucfirst($status) . '.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status order.');
        }
        redirect('salesorder/view/' . $id_sales_order);
    }
}