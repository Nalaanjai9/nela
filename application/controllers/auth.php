<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function register(){
        $this->load->view('auth/register');
    }
    public function process_register(){
        $this->form_validation->set_rules('username','username','required|is_unique[users.username]');
        $this->form_validation->set_rules('password','password','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','password','required|matches[password]');
        $this->form_validation->set_rules('role','role','required');
    
        if($this->form_validation->run()==false){
            $this->load->view('auth/register');
        }else{
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];
            if($this->User_model->insert_user($data)){
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Register berhasil, silahkan login</div>');
                redirect('auth/login');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Register gagal, coba lagi</div>');
                redirect('auth/register');
            }
        }
    }
    public function login(){
        $this->load->view('auth/login');
    }
    public function process_login(){
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('password','password','required');
        if($this->form_validation->run()==false){
            $this->load->view('auth/login');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->get_user_by_username($username);
            if($user){
                if(password_verify($password, $user['password'])){
                    $data = [
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'logged_in' => true
                    ];
                    $this->session->set_userdata($data);
                    redirect('berita');
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah</div>');
                    redirect('auth/login');
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username tidak ditemukan</div>');
                redirect('auth/login');
            
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}