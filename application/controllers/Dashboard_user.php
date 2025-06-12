<?php
defined('BASEPATH')OR exit('No direct script acsess allowed');

class Dashboard_user extends CI_Controller{
    public function index(){
        $data['content']= '<h1> welcome to adminlte 3 in codeigniter</h1>';
        $this->load->view('Tamplates/header');
        $this->load->view('dashboard_user', $data);
        $this->load->view('Tamplates/footer');
    }
}