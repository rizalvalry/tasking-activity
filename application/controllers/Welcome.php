<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        // $this->load->model('project_model');
		$this->load->model('welcome_model','welcome');
    }

	public function index()
	{
		$this->data['view_data']= $this->welcome->view_data();
		// var_dump($this->data['view_data']);die();
        $this->load->view('welcome_message', $this->data, FALSE);
	}

	public function getmarks()
    {
        $id_project   = $_POST['id'];
        // var_dump($id_project);die();

        $data['marks']  = $this->welcome->get_marks($id_project);
		// var_dump($data['marks']);die();
        $this->load->view("modal", $data);
    }
}
