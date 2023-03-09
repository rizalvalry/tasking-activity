<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    var $table = 'project';
    var $table2 = 'project_detail';
	var $column_order = array('nama_project','tanggal_mulai', 'sisa_pelunasan'); //set column field database for datatable orderable
	var $column_search = array('nama_project','tanggal_mulai', 'sisa_pelunasan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_project' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    public function getproject() {
        $this->db->select('*');
        $this->db->from('project');
        return $this->db->get();  
      }

	public function joinproject() {

		$this->db->select('*');
		$this->db->from('project_detail');
		$this->db->join('project', 'project.id = project_detail.id_project');
		// $this->db->join('project', 'project.id =' .$id_project);
		
      	return $this->db->get();

	}  

	
	public function projectcheck() {
		$this->db->select('COUNT(*)');
		$this->db->from('project');

		return $this->db->get();
	}


	public function statustask() {
	
		$this->db->select('*');
		$this->db->from('project');
		// $this->db->join('project', 'project.id_project = project_detail.id_project');
		// $this->db->group_by('project_detail.id_project');
		
      	return $this->db->get();		
	}

	public function projecttotal() {

		$this->db->select('cicilan_ke');
		$this->db->from('project_detail');
		
      	return $this->db->get();

	}

	public function projectcount($id_project) {

		$this->db->select('id_detail, id_project, cicilan_ke');
		$this->db->from('project_detail');
		$this->db->where('id_project', $id_project);
		$this->db->where('status_bayar', 'Unfinished');
		
      	return $this->db->get();

	}

	public function approvadmin() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('role_id', 1);
		$this->db->where('is_active', 1);

		return $this->db->get();
	}

      private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id_project)
	{
		$this->db->from($this->table);
		// $this->db->join('project_detail', 'project.id_project = project_detail.id_project');
		// $this->db->where('status_bayar', 'Unfinished');
		$this->db->where('id_project',$id_project);
		
		$query = $this->db->get();

		return $query->row();
	}

	public function get_detail_by_id($id_project)
	{
		$this->db->from($this->table2);
		// $this->db->join('project_detail', 'project.id_project = project_detail.id_project');
		// $this->db->where('status_bayar', 'Unfinished');
		$this->db->where('id_project',$id_project);
		
		$query = $this->db->get();

		return $query->result();
	}


	public function merger_data($id_project)
	{

		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('project_detail', 'project.id = project_detail.id_project');
		$this->db->where('status_bayar', 'Unfinished');
		$this->db->where('id',$id_project);
		
		$query = $this->db->get();

        // var_dump($id_project);die();


		return $query->result_array();
	}

	public function rowproject($id_project) {
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('project_detail', 'project.id = project_detail.id_project');
		$this->db->where('id',$id_project);
		
		return $this->db->get()->row();
	}

	public function get_detail_unclear($id_project)
	{
		$this->db->from($this->table2);
		$this->db->where('id_project',$id_project);
		$this->db->where('status_bayar', 'Unfinished');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function deploycheck() {
		$this->db->select("*")->from("project_detail");
		$this->db->join("project", "project.id = project_detail.id_project");

		$query = $this->db->get();

		return $query;
	}


	function save($table,$data){
	 	$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

    public function create_package($package){
		$result = array();
		foreach ($_POST['nama'] as $key => $val) {
		   $result[] = array(             
			  'nama' => $_POST['nama'][$key],
			  'alamat' => $_POST['alamat'][$key]         
		   );      
		}      
            
            $this->db->insert_batch('package', $result);
        $this->db->trans_complete();
    }

	public function headline($id_project) {
		$this->db->select('*');
		$this->db->from('project_detail');
		$this->db->where('id_project', $id_project);
		$this->db->where('status_bayar', 'Unfinished');

		return $this->db->get();
	}

	public function updateproject() {
		$data = array(
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'nama_project'        => $this->input->post('nama_project'),
			'sisa_pengerjaan'        => $this->input->post('sisa_pengerjaan'),
			'status'        => $this->input->post('status')
			);
		$this->db->where('id_project',$this->input->post('id_project'));
        $this->db->update('project',$data);
	}

	public function createproject() {
		$cicilan = $this->input->post('cicilan_ke');
		$id_project = $this->input->post('id_project');
        $datadb = array(
                'tanggal_bayar' => $this->input->post('tanggal_bayar'),
                'cicilan_ke'    => $this->input->post('cicilan_ke'),
                'status_bayar'  => 'finished',
                'note'          => $this->input->post('note'),
                'assign'        => $this->input->post('assign')
            );

		$this->db->where('id_project',$id_project);
        $this->db->where('cicilan_ke',$cicilan);
        $this->db->update('project_detail',$datadb);
	}


}