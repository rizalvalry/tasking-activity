<?php
class Client_model extends CI_Model{

function getClient() {
    $this->db->select('*');
    $this->db->from('client');
    return $this->db->get();  // Produces: SELECT title, content, date FROM mytable
  }

}