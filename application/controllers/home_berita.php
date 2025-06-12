<?php
defined('BASEPATH') OR exit('No dirrect script access allowed');

class home_berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeBerita_model');
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    

    public function index()
    {
        $data['berita'] = $this->HomeBerita_model->get_all();
        $this->load->view('layouts/header');
        $this->load->view('home/index', $data);
        $this->load->view('layouts/footer');
    }
    public function detail($id)
{
    $this->load->model('HomeBerita_model');
    $data['berita'] = $this->HomeBerita_model->get_by_id($id);

    if (!$data['berita']) {
        show_404(); 
    }

    $this->load->view('layouts/header');
    $this->load->view('home/detail', $data);
    $this->load->view('layouts/footer');
}
}