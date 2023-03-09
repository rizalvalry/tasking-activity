<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    function identitas(){
        return $this->db->query("SELECT * FROM profile ORDER BY id_profile DESC LIMIT 1");
    }

    public function id_exists() {
        // $this->db->where('id_profile', $id);
        // return $this->db->count_all_results('profile') > 0;


        $datadb = array('name_profile'=>$this->db->escape_str($this->input->post('name_profile')),
                                    'address_profile'=>$this->db->escape_str($this->input->post('address_profile')),
                                    'hp_profile'=>$this->db->escape_str($this->input->post('hp_profile')),
                                    'email_profile'=>$this->db->escape_str($this->input->post('email_profile')));

        $this->db->where('id_profile',1);
        $this->db->update('profile',$datadb);
    }


}