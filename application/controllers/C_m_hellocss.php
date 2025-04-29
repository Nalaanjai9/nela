<?php
class C_m_hellocss extends CI_Controller{
    function index(){
        $this->load->model("hellow");
        $data=array();
        $data['hal']=$this->hellow->katakata();
        $this->load->view("v_c_v_hellovarcss",$data);
    }
}