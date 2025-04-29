<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }
    public function get_user_by_username($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }
}