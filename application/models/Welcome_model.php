<?php
class Welcome_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function view_data(){
        $query=$this->db->query("SELECT *
                                 FROM project");

        // var_dump($query);die();
        return $query->result_array();
    }


    public function get_marks($id_project){

        $query=$this->db->query("SELECT *
                                 FROM project
                                 WHERE id = $id_project");
        return $query->result_array();
    }



}