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
    public function get_laporan_berita($tanggal_dari, $tanggal_sampai){
        $this->db->where('tanggal_publish >=', $tanggal_dari);
        $this->db->where('tanggal_publish <=', $tanggal_sampai);
        return $this->db->get('berita')->result();
    }
}