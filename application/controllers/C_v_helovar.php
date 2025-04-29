<?php
class C_v_helovar extends CI_Controller{
    function index(){
        $data=array();
        $data["halo"]="Hello World";
        $this->load->view("v_c_v_he lovar", $data);
    }
}