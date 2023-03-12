<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
// ini_set('display_errors', 1);
class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        $this->load->model('project_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "project";

        $data['row'] = $this->project_model->getproject();
        $data['tempo'] = $this->db->get('tempo')->result();        
        // $data['join'] = $this->project_model->joinproject()->result();
        
        $data['statuscicil'] = $this->project_model->statustask()->result();
        // $data['checkdeploy'] = $this->project_model->deploycheck()->result();
        // $data['cekproject'] = $this->project_model->projectcheck()->num_rows();

        // var_dump($data['checkdeploy']);die();
        // if(count($data['statuscicil']) === 0) {
        //     $data['statuscicil'][2] = "Selesai";
        // }else {
        //     $data['statuscicil'];
        // }

        $data['buttonstatus'] = $this->project_model->statustask()->num_rows();
        


        $this->template->load('template', 'project/index', $data);
    }

    public function detail_project() {
    
        // var_dump();die();
        // $data = $this->project_model->headline($id_project);
        $this->template->load('template', 'project/detail_project');
        // $this->load->view('project/detail_project');
        // echo json_encode($data);
    }


    public function create()
    {
        
        $this->project_model->createproject();
        // var_dump($this->project_model->createproject());die();

        redirect('project');
    }


    public function ajax_update() {
        $this->project_model->updateproject();

        echo json_encode(array("response" => true));
    }


    public function ajax_add()
    {

        $nama_project = $this->input->post('nama_project');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $status = $this->input->post('status');
        $tenor = $this->input->post('tenor');
        $sisa_pengerjaan = $this->input->post('sisa_pengerjaan');
        $jatuh_tempo = $this->input->post('jatuh_tempo');
        $cicilan_ke = $this->input->post('cicilan_ke');

        $data = array(
            'nama_project' => $nama_project,
            'tanggal_mulai' => $tanggal_mulai,
            'status' => $status,
            'tenor' => $cicilan_ke,
            'sisa_pengerjaan' => $sisa_pengerjaan,
            'jatuh_tempo' => $jatuh_tempo

        );
        // var_dump($data);die();
        $this->db->insert('project', $data);
        
        $cicilan_ke = $this->input->post('cicilan_ke');
        $jumlah_project = $this->input->post('jumlah_project');
      
        $id = $this->db->insert_id();
        for ($i = 1; $i <= $cicilan_ke; $i++) {
            $dataproject = array(
                'id_project' => $id,
                'cicilan_ke' => $i,
                'nama_project' => $nama_project,
                'status_bayar' => $status,
                'jumlah_project' => $jumlah_project
            );
            $this->db->insert('project_detail', $dataproject);
        }

        echo json_encode(array("status" => true));
    }

    public function ajax_edit()
    {
        $id_project   = $_POST['id'];
        // var_dump($id_project);die();
        
        // $data = $this->project_model->get_by_id($id_project);
        // $data2 = $this->project_model->get_detail_by_id($id_project);
        // $datadeploy = $this->project_model->get_detail_unclear($id_project);
        $data['countproject'] = $this->project_model->projectcount($id_project)->result();
        $data['approval'] = $this->project_model->approvadmin()->result();
        $data['buttonstatus'] = $this->project_model->statustask()->num_rows();
        $data['marks'] = $this->project_model->merger_data($id_project);
        $data['getdata'] = $this->project_model->rowproject($id_project);

        // var_dump($data['getdata']);die();


        $this->load->view("project/detail_project", $data);

        // $data_all = [
        //     'data' => $data,
        //     'data_detail' => $data2,
        //     'data_deploy' => $datadeploy
        // ];



        // echo json_encode($data_all);
    }

}
