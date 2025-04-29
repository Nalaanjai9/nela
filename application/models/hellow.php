<?php
class hellow extends CI_Model {
    var $hal='Hello World';
    function katakata(){
        $kalimat=$this->hal. "ini dari model";
        return $kalimat;
    }
}