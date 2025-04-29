<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class Berita_Model extends CI_Model{
    public function get_all_berita(){
        return $this->db->get('berita')->result_array();
    }
    public function insert_berita($data){
        return $this->db->insert('berita',$data);
    }
    public function delete_berita($idberita){
        return $this->db->delete('berita',array('idberita' => $idberita));
    }
    public function get_berita_by_id($idberita){
        return $this->db->get_where('berita',array('idberita' => $idberita))->row_array();
    }
    public function update_berita($id,$data){
        $this->db->where('idberita',$id);
        return $this->db->update('berita',$data);
    }
}