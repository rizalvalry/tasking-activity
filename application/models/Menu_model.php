<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getProject()
    {
        $this->db->select('COUNT(*)');
		$this->db->from('project');
		
      	return $this->db->get();
    }

    public function getTImeline() {
        $this->db->select('COUNT(*)');
		$this->db->from('project_detail');
        $this->db->where('status_bayar', 'finished');
		
      	return $this->db->count_all_results();
    }
}
