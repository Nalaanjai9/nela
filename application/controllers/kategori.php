<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class kategori extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Kategori_Model');
        $this->load->library('session');

    }
    public function index(){
        $data['kategori_berita']=$this->Kategori_Model->get_all_kategori();
        $this->load->view('Tamplates/header');
        $this->load->view('kategori/index' ,$data);
        $this->load->view('Tamplates/footer');
    }
    public function tambah(){
        $data['berita']=$this->Kategori_Model->get_all_kategori();
        $this->load->view('Tamplates/header');
        $this->load->view('kategori/form_berita',$data);
        $this->load->view('Tamplates/footer');
    }
    public function insert(){
        $kategori = $this->input->post('kategori');

        $data = array(
            'kategori' => $kategori
        );
        $result=$this->Kategori_Model->insert_kategori($data);

        if($result){
            $this->session->set_flashdata('success','Kategori berhasil disimpan');
            redirect('kategori');
        }
        else{
            $this->session->set_flashdata('error','Kategori gagal disimpan');
            redirect('kategori');
        }
    }
    public function hapus($idkategori){
        $this->Kategori_Model->delete_kategori($idkategori);
        redirect('kategori');
    }
    public function edit ($idkategori){
        $data['kategori_berita'] = $this->Kategori_Model->get_kategori_by_id($idkategori);
        $this->load->view('Tamplates/header');
        $this->load->view('kategori/edit_berita', $data);
        $this->load->view('Tamplates/footer');
    }
    public function update($id){
        $this ->form_validation->set_rules('kategori', 'kategori', 'required');
        if ($this -> form_validation -> run() == FALSE) {
            $this->index($id);
        } else {
            $data =[
                'kategori' => $this->input->post('kategori')
            ];
            $this ->Kategori_Model->update_kategori($id, $data);
            $this->session->set_flashdata('success','Berita berhasil diubah');
            redirect('Kategori');
        }

    }
}